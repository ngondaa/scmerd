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

    public function handle(): void
    {
        User::query()
            ->whereNotNull('email')
            ->orderBy('id')
            ->cursor()
            ->each(function (User $user): void {
                Mail::to($user->email)->send(new AttendanceConfirmation($user));
            });
    }
}
