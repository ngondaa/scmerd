<?php

use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

uses(WithFaker::class);

beforeEach(function () {
    config()->set('services.turnstile.secret', 'test-secret');
    config()->set('app.url', 'http://localhost');
});

it('defaults registration to proof submission', function () {
    expect(AppSetting::get('registration_mode', 'gateway'))->toBe('manual');
});

it('renders an invoice and proof payment form for the selected package', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('registration.proof', [
            'package' => 'standard',
            'certificate_name' => 'Test User',
        ]));

    $response->assertOk()
        ->assertSee('Invoice')
        ->assertSee('R650')
        ->assertSee('Bank transfer');
});

it('rejects manual proof upload when turnstile is missing', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('registration.proof.store'), [
            'package' => 'standard',
            'proof' => UploadedFile::fake()->image('proof.png'),
        ])
        ->assertSessionHasErrors('cf-turnstile-response');
});

it('accepts valid turnstile submissions for manual proof upload', function () {
    Http::fake([
        'https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response([
            'success' => true,
            'action' => 'payment_proof_upload',
            'hostname' => 'localhost',
        ], 200),
    ]);

    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('registration.proof.store'), [
            'package' => 'standard',
            'proof' => UploadedFile::fake()->image('proof.png'),
            'cf-turnstile-response' => 'valid-token',
        ]);

    $response->assertRedirect(route('dashboard'));
});
