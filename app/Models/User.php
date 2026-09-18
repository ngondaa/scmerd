<?php

namespace App\Models;

use App\Mail\PaymentApproved;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

#[Fillable([
    'name',
    'email',
    'google_id',
    'password',
    'registration_package',
    'certificate_name',
    'ecsa_accredited',
    'ecsa_number',
    'student_id',
    'registration_paid_at',
    'is_reviewer',
    'is_payment_reviewer',
    'is_admin',
    'payment_proof_path',
    'payment_proof_original_name',
    'payment_invoice_number',
    'payment_proof_analysis',
    'registration_status',
])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'ecsa_accredited' => 'boolean',
            'registration_paid_at' => 'datetime',
            'is_reviewer' => 'boolean',
            'is_payment_reviewer' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function assignedSubmissions(): BelongsToMany
    {
        return $this->belongsToMany(Submission::class, 'submission_reviewer')
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'payment-review') {
            return (bool) ($this->is_admin || $this->is_payment_reviewer);
        }

        return (bool) $this->is_admin;
    }

    public function needsPaymentReview(): bool
    {
        return filled($this->payment_proof_path)
            && in_array($this->registration_status, ['pending', 'pending_review'], true);
    }

    public function approvePayment(): void
    {
        if ($this->registration_status === 'paid') {
            return;
        }

        $this->update([
            'registration_paid_at' => now(),
            'registration_status' => 'paid',
        ]);

        Mail::to($this->email)
            ->bcc(config('registration.payment.notification_recipients'))
            ->queue(new PaymentApproved($this->fresh()));
    }

    public function rejectPayment(): void
    {
        $this->update([
            'registration_status' => 'rejected',
            'registration_paid_at' => null,
        ]);
    }

    /**
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeNeedsPaymentReview($query)
    {
        return $query
            ->whereNotNull('payment_proof_path')
            ->whereIn('registration_status', ['pending', 'pending_review']);
    }
}
