<?php

namespace App\Models;

use App\Mail\AbstractSubmitted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Mail;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'author',
        'track',
        'stage',
        'keywords',
        'abstract',
        'status',
        'submitted_at',
        'attachment_path',
        'attachment_name',
        'comments',
        'rebuttal',
    ];

    protected $casts = [
        'comments' => 'array',
        'submitted_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::created(function (Submission $submission): void {
            if (! $submission->user?->email) {
                return;
            }

            Mail::to($submission->user->email)
                ->bcc(config('registration.payment.notification_recipients'))
                ->queue(new AbstractSubmitted($submission));
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function reviewers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'submission_reviewer')
            ->withPivot('assigned_at')
            ->withTimestamps();
    }
}
