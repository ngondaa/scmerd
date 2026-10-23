<?php

use App\Jobs\ProofAnalysisJob;
use App\Mail\PaymentApproved;
use App\Mail\PaymentProofRejected;
use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

it('approves and rejects payment via user model helpers', function () {
    Mail::fake();
    $user = User::factory()->create([
        'registration_status' => 'pending',
        'payment_proof_path' => 'payment_proofs/proof.png',
        'registration_paid_at' => null,
    ]);

    $user->approvePayment();

    expect($user->fresh()->registration_status)->toBe('paid')
        ->and($user->fresh()->registration_paid_at)->not->toBeNull();

    Mail::assertQueued(PaymentApproved::class, fn (PaymentApproved $mail): bool => $mail->hasTo($user->email));

    $user->rejectPayment();

    expect($user->fresh()->registration_status)->toBe('rejected')
        ->and($user->fresh()->registration_paid_at)->toBeNull();

    Mail::assertQueued(PaymentProofRejected::class, fn (PaymentProofRejected $mail): bool => $mail->hasTo($user->email));
});

it('deletes a payment proof without deleting the registrant', function () {
    Storage::fake('public');
    Storage::disk('public')->put('payment_proofs/proof.png', 'proof contents');

    $user = User::factory()->create([
        'payment_proof_path' => 'payment_proofs/proof.png',
        'payment_proof_original_name' => 'proof.png',
        'payment_proof_analysis' => 'queued',
        'registration_status' => 'paid',
        'registration_paid_at' => now(),
    ]);

    $user->deletePaymentProof();

    expect(User::find($user->id))->not->toBeNull()
        ->and($user->fresh()->payment_proof_path)->toBeNull()
        ->and($user->fresh()->payment_proof_original_name)->toBeNull()
        ->and($user->fresh()->payment_proof_analysis)->toBeNull()
        ->and($user->fresh()->registration_status)->toBe('unpaid')
        ->and($user->fresh()->registration_paid_at)->toBeNull();

    Storage::disk('public')->assertMissing('payment_proofs/proof.png');
});

it('scopes users that need payment review including pending_review', function () {
    User::factory()->create([
        'registration_status' => 'pending',
        'payment_proof_path' => 'payment_proofs/a.png',
    ]);
    User::factory()->create([
        'registration_status' => 'pending_review',
        'payment_proof_path' => 'payment_proofs/b.png',
    ]);
    User::factory()->create([
        'registration_status' => 'paid',
        'payment_proof_path' => 'payment_proofs/c.png',
        'registration_paid_at' => now(),
    ]);
    User::factory()->create([
        'registration_status' => 'pending',
        'payment_proof_path' => null,
    ]);

    expect(User::query()->needsPaymentReview()->count())->toBe(2);
});

it('flags an OCR amount match for manual review rather than unlocking submission automatically', function () {
    putenv('PROOF_ANALYSIS_FAKE_OCR=R650');
    $_ENV['PROOF_ANALYSIS_FAKE_OCR'] = 'R650';

    Storage::fake('public');

    $user = User::factory()->create([
        'registration_package' => 'standard',
        'registration_status' => 'pending',
        'payment_proof_path' => 'payment_proofs/proof1.png',
    ]);

    Storage::disk('public')->put('payment_proofs/proof1.png', 'FAKE_OCR:R650');

    (new ProofAnalysisJob($user->id))->handle();

    expect($user->fresh()->registration_status)->toBe('pending_review')
        ->and($user->fresh()->registration_paid_at)->toBeNull();
});

it('keeps blade admin verify-payment approve reject working', function () {
    Storage::fake('public');
    Bus::fake();
    AppSetting::set('registration_open', '1');

    $user = User::factory()->create();
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($user)->post(route('registration.proof.store'), [
        'package' => 'standard',
        'certificate_name' => 'Test User',
        'proof' => UploadedFile::fake()->image('payment-proof.png'),
    ])->assertRedirect(route('dashboard'));

    $this->actingAs($admin)->post(route('admin.users.verify-payment', $user), [
        'action' => 'approve',
    ])->assertSessionHas('status');

    expect($user->fresh()->registration_status)->toBe('paid');

    $this->actingAs($admin)->post(route('admin.users.verify-payment', $user), [
        'action' => 'reject',
    ])->assertSessionHas('status');

    expect($user->fresh()->registration_status)->toBe('rejected')
        ->and($user->fresh()->registration_paid_at)->toBeNull();
});
