<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get(route('login'));

    $response->assertOk();
});

test('password login redirects to Google sign-in', function () {
    $this->post(route('login.store'), [
        'email' => 'delegate@example.com',
        'password' => 'password',
    ])->assertRedirect(route('auth.google.redirect', absolute: false));
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('home'));

    $this->assertGuest();
});
