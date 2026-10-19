<?php

use App\Mail\RegistrationReminder;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('sends registration reminders only to unpaid registrants', function () {
    Mail::fake();

    $unpaidUser = User::factory()->create(['registration_status' => 'unpaid']);
    $pendingUser = User::factory()->create(['registration_status' => 'pending']);
    $paidUser = User::factory()->create(['registration_status' => 'paid']);

    $this->artisan('app:send-registration-reminders')
        ->expectsOutput('Sent 2 registration reminder(s).')
        ->assertSuccessful();

    Mail::assertSent(RegistrationReminder::class, 2);
    Mail::assertSent(RegistrationReminder::class, fn (RegistrationReminder $mail): bool => $mail->hasTo($unpaidUser->email));
    Mail::assertSent(RegistrationReminder::class, fn (RegistrationReminder $mail): bool => $mail->hasTo($pendingUser->email));
    Mail::assertNotSent(RegistrationReminder::class, fn (RegistrationReminder $mail): bool => $mail->hasTo($paidUser->email));
});
