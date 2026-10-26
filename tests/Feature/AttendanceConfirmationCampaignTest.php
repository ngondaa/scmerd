<?php

use App\Mail\AttendanceConfirmation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

it('lets an administrator preview and send the attendance confirmation campaign', function () {
    Mail::fake();
    $admin = User::factory()->create(['is_admin' => true]);
    $recipient = User::factory()->create();

    $this->actingAs($admin)
        ->get(route('admin.attendance-campaign.preview'))
        ->assertOk()
        ->assertSee('2')
        ->assertSee('user accounts')
        ->assertSee('gala dinner');

    $this->actingAs($admin)
        ->post(route('admin.attendance-campaign.send'))
        ->assertRedirect(route('admin.attendance-campaign.preview'));

    Mail::assertQueued(AttendanceConfirmation::class, 2);
    Mail::assertQueued(AttendanceConfirmation::class, fn (AttendanceConfirmation $mail): bool => $mail->hasTo($recipient->email));
});

it('records a gala dinner response and confirms conference attendance', function () {
    $user = User::factory()->create();
    $url = URL::temporarySignedRoute(
        'attendance-confirmations.store',
        now()->addDay(),
        ['user' => $user, 'response' => 'gala-dinner'],
    );

    $this->get($url)
        ->assertRedirect(route('home'));

    expect($user->fresh()->attendance_confirmed_at)->not->toBeNull()
        ->and($user->fresh()->gala_dinner_confirmed_at)->not->toBeNull();
});

it('records a conference-only response without confirming gala dinner attendance', function () {
    $user = User::factory()->create();
    $url = URL::temporarySignedRoute(
        'attendance-confirmations.store',
        now()->addDay(),
        ['user' => $user, 'response' => 'attending'],
    );

    $this->get($url)->assertRedirect(route('home'));

    expect($user->fresh()->attendance_confirmed_at)->not->toBeNull()
        ->and($user->fresh()->gala_dinner_confirmed_at)->toBeNull();
});
