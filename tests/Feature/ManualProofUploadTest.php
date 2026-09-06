<?php

use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
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
    $user = User::factory()->create();
    $proof = UploadedFile::fake()->image('proof.png');

    $this->actingAs($user)
        ->post(route('registration.proof.store'), [
            'proof' => $proof,
            'package' => 'standard',
            'certificate_name' => 'Test User',
        ])
        ->assertRedirect(route('dashboard'));

    expect($user->fresh()->registration_status)->toBe('pending');
    Storage::disk('public')->assertExists('payment_proofs/'.$proof->hashName());
});

it('requires a student number for the student package', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('registration.proof.store'), [
            'proof' => UploadedFile::fake()->image('proof.png'),
            'package' => 'student',
            'certificate_name' => 'Test User',
        ])
        ->assertSessionHasErrors('student_id');
});
