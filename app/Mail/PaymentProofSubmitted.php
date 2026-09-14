<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentProofSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice '.$this->user->payment_invoice_number.' — payment proof for '.$this->user->name,
            replyTo: [new Address($this->user->email, $this->user->name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-proof-submitted',
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        if (! filled($this->user->payment_proof_path)) {
            return [];
        }

        return [
            Attachment::fromStorageDisk('public', $this->user->payment_proof_path)
                ->as($this->user->payment_proof_original_name ?: basename($this->user->payment_proof_path)),
        ];
    }
}
