<?php

use App\Mail\AbstractSubmitted;
use App\Mail\PaymentApproved;
use App\Mail\ReviewCommentPosted;
use App\Models\Review;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('sends payment confirmation to the attendee and privately copies conference administrators', function () {
    Mail::fake();
    $user = User::factory()->create([
        'registration_status' => 'pending',
        'payment_proof_path' => 'payment_proofs/proof.png',
    ]);

    $user->approvePayment();

    Mail::assertQueued(PaymentApproved::class, fn (PaymentApproved $mail): bool => $mail->hasTo($user->email)
        && $mail->hasBcc('carey@saimeche.org.za')
        && $mail->hasBcc('ngondaa@yahoo.com'));
});

it('sends abstract submissions to the author and privately copies conference administrators', function () {
    Mail::fake();
    $user = User::factory()->create();

    Submission::create([
        'user_id' => $user->id,
        'title' => 'Thermal Systems Research',
        'author' => $user->name,
        'track' => 'Abstract Submission',
        'abstract' => 'A test abstract.',
        'status' => 'Under Initial Review',
        'submitted_at' => now(),
    ]);

    Mail::assertQueued(AbstractSubmitted::class, fn (AbstractSubmitted $mail): bool => $mail->hasTo($user->email)
        && $mail->hasBcc('carey@saimeche.org.za')
        && $mail->hasBcc('ngondaa@yahoo.com'));
});

it('sends review comments to the author and privately copies conference administrators', function () {
    Mail::fake();
    $author = User::factory()->create();
    $reviewer = User::factory()->create(['is_reviewer' => true]);
    $submission = Submission::withoutEvents(fn () => Submission::create([
        'user_id' => $author->id,
        'title' => 'Thermal Systems Research',
        'author' => $author->name,
        'track' => 'Abstract Submission',
        'abstract' => 'A test abstract.',
        'status' => 'Under Initial Review',
        'submitted_at' => now(),
    ]));

    Review::create([
        'submission_id' => $submission->id,
        'user_id' => $reviewer->id,
        'comment' => 'Please clarify the research method.',
    ]);

    Mail::assertQueued(ReviewCommentPosted::class, fn (ReviewCommentPosted $mail): bool => $mail->hasTo($author->email)
        && $mail->hasBcc('carey@saimeche.org.za')
        && $mail->hasBcc('ngondaa@yahoo.com'));
});
