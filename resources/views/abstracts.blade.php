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
            $badgeClass = match(strtolower($submission['status'] ?? '')) {
                'under review'  => 'cp-badge-review',
                'rebuttal open' => 'cp-badge-rebuttal',
                'accepted'      => 'cp-badge-accepted',
                default         => 'cp-badge-pending',
            };
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
                @foreach (['Abstract submitted', 'Under review', 'Rebuttal', 'Decision'] as $step)
                    <div class="cp-step">{{ $step }}</div>
                @endforeach
            </div>

            <h3 class="cp-section-title">Abstract</h3>
            <p class="cp-text">{{ $submission['abstract'] }}</p>

            <h3 class="cp-section-title">Review process &amp; comments</h3>
            <ul class="cp-list">
                @foreach ($submission['comments'] as $comment)
                    <li>{{ $comment }}</li>
                @endforeach
            </ul>
            <p class="cp-meta-text">Submitted: {{ $submission['submitted_at'] }}</p>

            <div class="cp-actions">
                @if (!empty($submission['attachment_path']))
                    <a href="{{ route('downloads.attachment', $submission['id']) }}" class="cp-btn-link">Download attachment</a>
                @endif
                <a href="{{ route('rebuttals') }}" class="cp-btn-link">Open rebuttal</a>
            </div>
        </div>
    @endforeach
@endif

@include('partials.portal.close')

</x-layouts::app>
