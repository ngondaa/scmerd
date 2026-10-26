<?php

namespace App\Jobs;

use App\Mail\AttendanceConfirmation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAttendanceConfirmationCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public bool $acceptedAuthorsOnly = false) {}

    public function handle(): void
    {
        $users = User::query()
            ->whereNotNull('email')
            ->orderBy('id');

        if ($this->acceptedAuthorsOnly) {
            $users->whereHas('submissions', fn ($query) => $query->where('status', 'Accepted'));
        }

        $users
            ->cursor()
            ->each(function (User $user): void {
                Mail::to($user->email)->send(new AttendanceConfirmation($user, $this->acceptedAuthorsOnly));
            });
    }
}
