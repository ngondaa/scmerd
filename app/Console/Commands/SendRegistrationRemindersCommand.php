<?php

namespace App\Console\Commands;

use App\Mail\RegistrationReminder;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRegistrationRemindersCommand extends Command
{
    protected $signature = 'app:send-registration-reminders';

    protected $description = 'Send a registration-completion reminder to every registrant who is not paid.';

    public function handle(): int
    {
        $sent = 0;

        User::query()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->where(function ($query): void {
                $query->whereNull('registration_status')
                    ->orWhere('registration_status', '!=', 'paid');
            })
            ->orderBy('id')
            ->lazyById()
            ->each(function (User $user) use (&$sent): void {
                Mail::to($user)->send(new RegistrationReminder($user));
                $sent++;
            });

        $this->info("Sent {$sent} registration reminder(s).");

        return self::SUCCESS;
    }
}
