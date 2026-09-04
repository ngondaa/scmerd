<?php

use App\Jobs\ProofAnalysisJob;
use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

it('approves when OCR finds exact package amount', function () {
    putenv('PROOF_ANALYSIS_FAKE_OCR=R650');
    $_ENV['PROOF_ANALYSIS_FAKE_OCR'] = 'R650';

    $user = User::factory()->create([
        'registration_package' => 'standard',
        'payment_proof_path' => 'payment_proofs/proof1.png',
    ]);

    Storage::disk('public')->put('payment_proofs/proof1.png', 'FAKE_OCR:R650');

    // sanity checks: ensure our fake storage contains the test payload
    $this->assertTrue(Storage::disk('public')->exists('payment_proofs/proof1.png'));
    $this->assertEquals('FAKE_OCR:R650', Storage::disk('public')->get('payment_proofs/proof1.png'));

    // Use analyzeText directly for deterministic unit testing
    $expected = config('registration.packages.standard.amount');
    $result = \App\Jobs\ProofAnalysisJob::analyzeText('R650', $expected);

    expect($result['status'])->toBe('approved');
});

it('marks pending_review when amounts mismatch', function () {
    putenv('PROOF_ANALYSIS_FAKE_OCR=R600');
    $_ENV['PROOF_ANALYSIS_FAKE_OCR'] = 'R600';

    $user = User::factory()->create([
        'registration_package' => 'standard',
        'payment_proof_path' => 'payment_proofs/proof2.png',
    ]);

    Storage::disk('public')->put('payment_proofs/proof2.png', 'FAKE_OCR:R600');

    $expected = config('registration.packages.standard.amount');
    $result = \App\Jobs\ProofAnalysisJob::analyzeText('R600', $expected);

    expect($result['status'])->toBe('manual_review');
    expect($result['best']['cents'])->not->toBe(config('registration.packages.standard.amount'));
});

it('stores file and dispatches job on upload', function () {
    Bus::fake();

    AppSetting::set('registration_mode', 'manual');
    AppSetting::set('registration_open', '1');

    $user = User::factory()->create();

    $file = UploadedFile::fake()->image('proof.png');

    $this->actingAs($user)
        ->post(route('registration.proof.store'), [
            'proof' => $file,
            'package' => 'standard',
        ])
        ->assertRedirect(route('dashboard'));

    Storage::disk('public')->assertExists('payment_proofs/'.$file->hashName());

    // We assert the file was stored and the job was dispatched.
    Bus::assertDispatched(ProofAnalysisJob::class, function ($job) use ($user) {
        return $job->userId === $user->id;
    });
});

it('handles non-numeric OCR gracefully', function () {
    $expected = config('registration.packages.standard.amount');
    $result = \App\Jobs\ProofAnalysisJob::analyzeText('Payment received — thank you', $expected);

    expect($result['status'])->toBe('manual_review');
    expect($result['candidates'])->toBeArray()->toHaveCount(0);
});

it('picks best candidate among multiple amounts', function () {
    $expected = config('registration.packages.standard.amount');
    $text = 'Transfer reference: R950 or R650.00 confirmed';
    $result = \App\Jobs\ProofAnalysisJob::analyzeText($text, $expected);

    expect($result['status'])->toBe('approved');
    expect($result['best']['cents'])->toBe($expected);
});

it('handles different currency formats and plain numbers', function () {
    $expected = config('registration.packages.standard.amount');
    $text = 'Payment $650.00 via bank transfer';
    $result = \App\Jobs\ProofAnalysisJob::analyzeText($text, $expected);

    expect($result['status'])->toBe('approved');
});
