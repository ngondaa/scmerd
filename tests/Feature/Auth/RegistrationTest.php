<?php

use Laravel\Fortify\Features;
use App\Models\User;
use App\Notifications\QueuedVerifyEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
});

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    Notification::fake();
    Queue::fake();

    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'password' => 'ValidPassword1!',
        'password_confirmation' => 'ValidPassword1!',
    ]);

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('verification.notice', absolute: false));

    $this->assertAuthenticated();

    Notification::assertSentTo(
        \App\Models\User::where('email', 'test@example.com')->firstOrFail(),
        QueuedVerifyEmail::class,
    );
});

test('registration still reaches the verification notice when email delivery is queued', function () {
    Queue::fake();

    $this->post(route('register.store'), [
        'name' => 'Queued Delegate',
        'email' => 'queued@example.com',
        'password' => 'ValidPassword1!',
        'password_confirmation' => 'ValidPassword1!',
    ])->assertRedirect(route('verification.notice', absolute: false));

    Queue::assertPushed(\Illuminate\Notifications\SendQueuedNotifications::class);
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
