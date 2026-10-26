<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class AttendanceConfirmation extends Mailable
{
    use SerializesModels;

    public function __construct(public User $user, public bool $acceptedAbstractAuthor = false) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->acceptedAbstractAuthor
                ? 'Your accepted abstract - please confirm attendance'
                : 'Please confirm your Central Branch Conference attendance',
        );
    }

    public function content(): Content
    {
        $data = [
            'acceptedAbstractAuthor' => $this->acceptedAbstractAuthor,
        ];

        if (! $this->acceptedAbstractAuthor) {
            $data += [
                'attendanceUrl' => $this->confirmationUrl('attending'),
                'galaDinnerUrl' => $this->confirmationUrl('gala-dinner'),
            ];
        }

        return new Content(
            view: 'emails.attendance-confirmation',
            with: $data,
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
