<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
