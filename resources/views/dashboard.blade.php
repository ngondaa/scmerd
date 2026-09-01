<x-layouts::app :title="__('Dashboard')">

@include('partials.portal.open')

<div class="cp-hero cp-hero--row">
    <div>
        <p class="cp-kicker">Author portal</p>
        <h1 class="cp-hello">Dashboard</h1>
        <p class="cp-hello-sub">Manage submissions and track your conference progress.</p>
    </div>
    <div class="cp-big-stats">
        <div>
            <div class="cp-big-num">{{ $stats['total'] ?? 0 }}</div>
            <div class="cp-big-label">Total</div>
        </div>
        <div>
            <div class="cp-big-num">{{ $stats['accepted'] ?? 0 }}</div>
            <div class="cp-big-label">Accepted</div>
        </div>
    </div>
</div>

<div class="cp-main-grid">
    <div class="cp-card">
        <h2 class="cp-card-title">Portal modules</h2>
        <p class="cp-card-desc">Navigate the author workflow.</p>
        <div class="cp-module-grid">
            <a href="{{ route('submit') }}" class="cp-mod-card">
                <div class="cp-mod-title">Submit abstract</div>
                <div class="cp-mod-desc">Upload and manage</div>
            </a>
            <a href="{{ route('abstracts') }}" class="cp-mod-card">
                <div class="cp-mod-title">Submissions</div>
                <div class="cp-mod-desc">Track status</div>
            </a>
            <a href="{{ route('rebuttals') }}" class="cp-mod-card">
                <div class="cp-mod-title">Rebuttals</div>
                <div class="cp-mod-desc">Respond to reviews</div>
            </a>
            <a href="{{ route('downloads') }}" class="cp-mod-card">
                <div class="cp-mod-title">Downloads</div>
                <div class="cp-mod-desc">Export data</div>
            </a>
        </div>
    </div>

    <div class="cp-card">
        <h2 class="cp-card-title">Recent submissions</h2>
        <p class="cp-card-desc">Your latest abstract activity.</p>

        @if (empty($submissions))
            <p class="cp-summary" style="margin-top:20px;">No submissions yet.</p>
        @else
            <div style="margin-top:20px;">
                @foreach (array_slice($submissions, 0, 5) as $submission)
                    @php
                        $status = strtolower($submission['status'] ?? '');
                        $badge = match($status) {
                            'under review' => 'cp-badge-review',
                            'rebuttal open' => 'cp-badge-rebuttal',
                            'accepted' => 'cp-badge-accepted',
                            default => 'cp-badge-pending'
                        };
                    @endphp
                    <div class="cp-sub-row">
                        <div class="cp-item-title">{{ $submission['title'] }}</div>
                        <span class="cp-badge {{ $badge }}">{{ $submission['status'] }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="cp-bottom-row">
    <div class="cp-card">
        <h2 class="cp-card-title">Summary</h2>
        <p class="cp-summary" style="margin-top:16px;">
            {{ $stats['under_review'] ?? 0 }} under review ·
            {{ $stats['rebuttal_open'] ?? 0 }} rebuttals ·
            {{ $stats['rejected'] ?? 0 }} rejected
        </p>
    </div>

    <div class="cp-card-dark">
        <h2 class="cp-card-title">Quick actions</h2>
        <p class="cp-card-desc">Common author tasks.</p>
        <div class="cp-qa-list">
            <a href="{{ route('submit') }}" class="cp-qa-item">
                <span>
                    <div class="cp-qa-title">New submission</div>
                    <div class="cp-qa-sub">Start a new abstract</div>
                </span>
                <span class="cp-qa-chev">&rsaquo;</span>
            </a>
            <a href="{{ route('rebuttals') }}" class="cp-qa-item">
                <span>
                    <div class="cp-qa-title">Rebuttals</div>
                    <div class="cp-qa-sub">Respond to reviewer comments</div>
                </span>
                <span class="cp-qa-chev">&rsaquo;</span>
            </a>
            <a href="{{ route('downloads') }}" class="cp-qa-item">
                <span>
                    <div class="cp-qa-title">Download CSV</div>
                    <div class="cp-qa-sub">Export submission records</div>
                </span>
                <span class="cp-qa-chev">&rsaquo;</span>
            </a>
        </div>
    </div>
</div>

@include('partials.portal.close')

</x-layouts::app>
