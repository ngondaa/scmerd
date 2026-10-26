<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class AttendanceConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Please confirm your Central Branch Conference attendance',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.attendance-confirmation',
            with: [
                'attendanceUrl' => $this->confirmationUrl('attending'),
                'galaDinnerUrl' => $this->confirmationUrl('gala-dinner'),
            ],
        );
    }

    private function confirmationUrl(string $response): string
    {
        return URL::temporarySignedRoute(
            'attendance-confirmations.store',
            now()->addDays(90),
            ['user' => $this->user, 'response' => $response],
        );
    }
}
