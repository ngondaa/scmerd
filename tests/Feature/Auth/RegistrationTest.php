<?php

use Laravel\Fortify\Features;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
});

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    Notification::fake();

    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('verification.notice', absolute: false));

    $this->assertAuthenticated();

    Notification::assertSentTo(
        \App\Models\User::where('email', 'test@example.com')->firstOrFail(),
        VerifyEmail::class,
    );
});

test('an existing email gives the user a direct path to log in or reset their password', function () {
    User::factory()->create(['email' => 'existing@example.com']);

    $this->followingRedirects()
        ->post(route('register.store'), [
            'name' => 'Existing Delegate',
            'email' => 'existing@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
        ->assertSee('This address already has an account.')
        ->assertSee('Log in instead')
        ->assertSee(route('login', ['email' => 'existing@example.com']))
        ->assertSee(route('password.request', ['email' => 'existing@example.com']));
});
