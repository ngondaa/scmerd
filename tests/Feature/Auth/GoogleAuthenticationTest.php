<?php

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as GoogleUser;

test('users can start Google sign-in', function () {
    Socialite::fake('google');

    $this->get(route('auth.google.redirect'))
        ->assertRedirect();
});

test('Google sign-in creates and authenticates a user', function () {
    Socialite::fake('google', GoogleUser::fake([
        'id' => 'google-user-123',
        'name' => 'Google Delegate',
        'email' => 'google.delegate@example.com',
    ]));

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('dashboard', absolute: false));

    $user = User::where('email', 'google.delegate@example.com')->firstOrFail();

    expect($user->google_id)->toBe('google-user-123');
    $this->assertAuthenticatedAs($user);
});

test('Google sign-in links an existing account with the same email address', function () {
    $existingUser = User::factory()->create([
        'email' => 'existing.google@example.com',
        'google_id' => null,
    ]);

    Socialite::fake('google', GoogleUser::fake([
        'id' => 'google-user-456',
        'name' => 'Existing Delegate',
        'email' => $existingUser->email,
    ]));

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('dashboard', absolute: false));

    expect($existingUser->fresh()->google_id)->toBe('google-user-456');
    $this->assertAuthenticatedAs($existingUser);
});
