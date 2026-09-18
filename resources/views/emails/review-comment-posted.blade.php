<h1>There is an update on your abstract</h1>

<p>Hello {{ $review->submission->user->name }},</p>

<p>A reviewer has added a comment to <strong>{{ $review->submission->title }}</strong>.</p>

<blockquote>{{ $review->comment }}</blockquote>

@if ($review->status)
    <p><strong>Submission status:</strong> {{ $review->status }}</p>
@endif

<p>Please sign in to the conference portal to review the update.</p>
