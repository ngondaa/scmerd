<?php

use App\Models\User;
use Laravel\Fortify\Features;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
});

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'password' => 'ValidPassword1!',
        'password_confirmation' => 'ValidPassword1!',
    ]);

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('an existing email is rejected during registration', function () {
    User::factory()->create(['email' => 'existing@example.com']);

    $this->post(route('register.store'), [
        'name' => 'Existing Delegate',
        'email' => 'existing@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertSessionHasErrors('email');
});
