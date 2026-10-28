<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AcceptedAbstractProgramme extends Mailable
{
    use SerializesModels;

    public function __construct(public User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Conference programme and presenter preparation - 30 October 2026',
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.accepted-abstract-programme');
    }

    /** @return array<int, Attachment> */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('downloads/2026-saimeche-postgraduate-conference-programme.pdf'))
                ->as('2026 SAIMechE Postgraduate Conference Programme.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
