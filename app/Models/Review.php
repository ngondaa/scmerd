<?php

namespace App\Models;

use App\Mail\ReviewCommentPosted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'user_id',
        'comment',
        'status',
        'scores',
    ];

    protected $casts = [
        'scores' => 'array',
    ];

    protected static function booted(): void
    {
        static::created(function (Review $review): void {
            $submission = $review->submission;

            if (! $submission?->user?->email) {
                return;
            }

            Mail::to($submission->user->email)
                ->bcc(config('registration.payment.notification_recipients'))
                ->queue(new ReviewCommentPosted($review));
        });
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
