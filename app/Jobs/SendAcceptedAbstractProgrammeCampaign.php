<?php

namespace App\Jobs;

use App\Mail\AcceptedAbstractProgramme;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAcceptedAbstractProgrammeCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        User::query()
            ->whereNotNull('email')
            ->whereHas('submissions', fn ($query) => $query->where('status', 'Accepted'))
            ->orderBy('id')
            ->cursor()
            ->each(fn (User $user) => Mail::to($user->email)->send(new AcceptedAbstractProgramme($user)));
    }
}
