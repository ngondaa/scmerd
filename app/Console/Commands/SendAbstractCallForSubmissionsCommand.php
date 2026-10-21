<?php

namespace App\Console\Commands;

use App\Mail\AbstractCallForSubmissions;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAbstractCallForSubmissionsCommand extends Command
{
    protected $signature = 'app:send-abstract-call {--send : Deliver the email. Without this option, only show the recipient count.}';

    protected $description = 'Email every site user with the call for abstracts and the Word template.';

    public function handle(): int
    {
        $recipients = User::query()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->orderBy('id');

        $recipientCount = (clone $recipients)->count();

        if (! $this->option('send')) {
            $this->warn("Dry run: {$recipientCount} user(s) would receive the abstract call email.");
            $this->line('Run again with --send to deliver the emails.');

            return self::SUCCESS;
        }

        $sent = 0;

        $recipients
            ->lazyById()
            ->each(function (User $user) use (&$sent): void {
                Mail::to($user)->send(new AbstractCallForSubmissions($user));
                $sent++;
            });

        $this->info("Sent {$sent} abstract call email(s).");

        return self::SUCCESS;
    }
}
