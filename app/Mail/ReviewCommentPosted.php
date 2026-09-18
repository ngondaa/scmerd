<?php

namespace App\Mail;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReviewCommentPosted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Review $review) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New review comment — '.$this->review->submission->title,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.review-comment-posted');
    }
}
