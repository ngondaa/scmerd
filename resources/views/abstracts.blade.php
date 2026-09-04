<x-layouts::app :title="__('Abstracts')">

@include('partials.portal.open')

<div class="cp-hero">
    <p class="cp-kicker">Review</p>
    <h1 class="cp-hello">Abstract review</h1>
    <p class="cp-hello-sub">Track each abstract's review process and reviewer comments.</p>
</div>

@if (session('status'))
    <div class="cp-status-alert">{{ session('status') }}</div>
@endif

@if (count($submissions) === 0)
    <div class="cp-empty">
        <p class="cp-empty-text">No abstracts submitted yet.</p>
        <a href="{{ route('submit') }}" class="cp-btn-link">Submit your first abstract</a>
    </div>
@else
    @foreach ($submissions as $submission)
        @php
            $status = is_array($submission) ? strtolower($submission['status'] ?? '') : strtolower($submission->status ?? '');

            if (str_contains($status, 'initial') || str_contains($status, 'under')) {
                $badgeClass = 'cp-badge-review';
            } elseif (str_contains($status, 'rebuttal')) {
                $badgeClass = 'cp-badge-rebuttal';
            } elseif (str_contains($status, 'accept')) {
                $badgeClass = 'cp-badge-accepted';
            } else {
                $badgeClass = 'cp-badge-pending';
            }
        @endphp
        <div class="cp-card cp-card--inset">
            <div class="cp-card-head">
                <div>
                    <h2 class="cp-sub-title">{{ $submission['title'] }}</h2>
                    <p class="cp-sub-meta">Author: {{ $submission['author'] }} · Track: {{ $submission['track'] }}</p>
                </div>
                <span class="cp-badge {{ $badgeClass }}">{{ $submission['status'] }}</span>
            </div>

            <h3 class="cp-section-title">Submission lifecycle</h3>
            <div class="cp-lifecycle">
                @php
                    $current = $status;
                @endphp
                <div class="cp-step cp-step--done">Abstract submitted</div>
                <div class="cp-step {{ (str_contains($current, 'initial') || str_contains($current, 'under')) ? 'cp-step--active' : '' }}">Under review</div>
                <div class="cp-step {{ str_contains($current, 'rebuttal') ? 'cp-step--active' : '' }}">Rebuttal</div>
                <div class="cp-step {{ (str_contains($current, 'accept') || str_contains($current, 'reject')) ? 'cp-step--active' : '' }}">Decision</div>
            </div>

            <h3 class="cp-section-title">Abstract</h3>
            <p class="cp-text">{{ $submission['abstract'] }}</p>

            <h3 class="cp-section-title">Review process &amp; comments</h3>
            <ul class="cp-list">
                @php
                    $comments = is_array($submission) ? ($submission['comments'] ?? []) : ($submission->comments ?? []);
                @endphp
                @forelse ($comments as $comment)
                    @if (is_array($comment) || is_object($comment))
                        <li>
                            <strong>{{ $comment['author'] ?? $comment->author ?? 'Reviewer' }}</strong>: {{ $comment['message'] ?? $comment->message ?? '' }}
                            @if (!empty($comment['at'] ?? $comment->at ?? ''))
                                <div class="cp-meta-text">{{ $comment['at'] ?? $comment->at }}</div>
                            @endif
                        </li>
                    @else
                        <li>{{ $comment }}</li>
                    @endif
                @empty
                    <li>No comments yet.</li>
                @endforelse
            </ul>
            <p class="cp-meta-text">Submitted: {{ $submission['submitted_at'] }}</p>

            <div class="cp-actions">
                @php
                    $id = is_array($submission) ? ($submission['id'] ?? null) : ($submission->id ?? null);
                    $attachment = is_array($submission) ? ($submission['attachment_path'] ?? null) : ($submission->attachment_path ?? null);
                @endphp
                @if (!empty($attachment) && $id)
                    <a href="{{ route('downloads.attachment', $id) }}" class="cp-btn-link">Download attachment</a>
                @endif
                <a href="{{ route('rebuttals') }}" class="cp-btn-link">Open rebuttal</a>
            </div>
        </div>
    @endforeach
@endif

@include('partials.portal.close')

</x-layouts::app>
