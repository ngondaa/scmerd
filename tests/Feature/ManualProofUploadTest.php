<?php

use App\Models\AppSetting;
use App\Models\User;
use App\Mail\PaymentProofSubmitted;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    AppSetting::set('registration_open', '1');
});

it('renders bank-transfer instructions for the selected package', function () {
    $response = $this->actingAs(User::factory()->create())
        ->get(route('registration.proof', ['package' => 'standard']));

    $response->assertOk()
        ->assertSee('Bank transfer details')
        ->assertSee('R650');
});

it('requires a verified email address before registration can begin', function () {
    $response = $this->actingAs(User::factory()->unverified()->create())
        ->get(route('registration.proof', ['package' => 'standard']));

    $response->assertRedirect(route('verification.notice'));
});

it('accepts a proof upload without a bot-check challenge', function () {
    Bus::fake();
    Mail::fake();
    $user = User::factory()->create();
    $proof = UploadedFile::fake()->image('proof.png');

    $this->actingAs($user)
        ->post(route('registration.proof.store'), [
            'proof' => $proof,
            'package' => 'standard',
            'certificate_name' => 'Test User',
        ])
        ->assertRedirect(route('dashboard'));

    expect($user->fresh()->registration_status)->toBe('pending')
        ->and($user->fresh()->payment_invoice_number)->toMatch('/^SCMERD-\\d{4}-\\d{6}$/')
        ->and($user->fresh()->payment_proof_original_name)->toBe('proof.png');
    Storage::disk('public')->assertExists('payment_proofs/'.$proof->hashName());
    Mail::assertQueued(PaymentProofSubmitted::class, function (PaymentProofSubmitted $mail) use ($user): bool {
        return $mail->hasTo('carey@saimeche.org.za')
            && $mail->hasTo('ngondaa@yahoo.com')
            && $mail->user->is($user)
            && $mail->user->payment_invoice_number === $user->fresh()->payment_invoice_number;
    });
});

it('accepts a Word document as proof of payment', function () {
    Bus::fake();
    Mail::fake();
    $user = User::factory()->create();
    $proof = UploadedFile::fake()->create('proof.docx', 200, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

    $this->actingAs($user)
        ->post(route('registration.proof.store'), [
            'proof' => $proof,
            'package' => 'standard',
            'certificate_name' => 'Test User',
        ])
        ->assertRedirect(route('dashboard'));

    Storage::disk('public')->assertExists('payment_proofs/'.$proof->hashName());
    Mail::assertQueued(PaymentProofSubmitted::class);
});

it('accepts the just attend package without a student number', function () {
    Bus::fake();
    Mail::fake();
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('registration.proof.store'), [
            'proof' => UploadedFile::fake()->image('proof.png'),
            'package' => 'just_attend',
            'certificate_name' => 'Test User',
        ])
        ->assertRedirect(route('dashboard'));

    expect($user->fresh()->registration_package)->toBe('just_attend')
        ->and($user->fresh()->student_id)->toBeNull();
});
