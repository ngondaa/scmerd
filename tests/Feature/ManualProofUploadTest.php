<?php

use App\Mail\PaymentProofSubmitted;
use App\Models\AppSetting;
use App\Models\User;
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

it('allows an account without a verified-email timestamp to begin registration', function () {
    $response = $this->actingAs(User::factory()->unverified()->create())
        ->get(route('registration.proof', ['package' => 'standard']));

    $response->assertOk();
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

it('confirms the just attend package with only a certificate name and ID number', function () {
    Bus::fake();
    Mail::fake();
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('registration.proof.store'), [
            'package' => 'just_attend',
            'certificate_name' => 'Test User',
            'student_id' => 'ID-1234567',
        ])
        ->assertRedirect(route('dashboard'));

    expect($user->fresh()->registration_package)->toBe('just_attend')
        ->and($user->fresh()->student_id)->toBe('ID-1234567')
        ->and($user->fresh()->registration_status)->toBe('paid')
        ->and($user->fresh()->registration_paid_at)->not->toBeNull()
        ->and($user->fresh()->payment_proof_path)->toBeNull();
    Mail::assertNothingQueued();
    Bus::assertNothingDispatched();
});
