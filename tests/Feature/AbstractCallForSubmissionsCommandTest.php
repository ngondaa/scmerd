<?php

use App\Mail\AbstractCallForSubmissions;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('shows the recipient count without sending the abstract call email', function () {
    Mail::fake();

    User::factory()->count(2)->create();

    $this->artisan('app:send-abstract-call')
        ->expectsOutput('Dry run: 2 user(s) would receive the abstract call email.')
        ->expectsOutput('Run again with --send to deliver the emails.')
        ->assertSuccessful();

    Mail::assertNothingSent();
});

it('sends the abstract call email to every site user when explicitly requested', function () {
    Mail::fake();

    $firstUser = User::factory()->create();
    $secondUser = User::factory()->create();

    $this->artisan('app:send-abstract-call --send')
        ->expectsOutput('Sent 2 abstract call email(s).')
        ->assertSuccessful();

    Mail::assertSent(AbstractCallForSubmissions::class, 2);
    Mail::assertSent(AbstractCallForSubmissions::class, fn (AbstractCallForSubmissions $mail): bool => $mail->hasTo($firstUser->email));
    Mail::assertSent(AbstractCallForSubmissions::class, fn (AbstractCallForSubmissions $mail): bool => $mail->hasTo($secondUser->email));
});
