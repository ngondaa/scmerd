<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Sends verification mail outside the registration HTTP request.
 *
 * A mail transport failure must not prevent a newly-created delegate from
 * reaching the verification notice.
 */
class QueuedVerifyEmail extends VerifyEmail implements ShouldQueue
{
    use Queueable;
}
