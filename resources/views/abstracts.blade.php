<x-layouts::app :title="__('Abstracts')">
<style>
    .cp-shell { background: #f0f0f5; border-radius: 20px; padding: 16px; font-family: var(--font-sans, ui-sans-serif, system-ui, sans-serif); max-width: 1000px; margin: 0 auto; }
    .cp-hero { margin-bottom: 24px; padding: 0 4px; }
    .cp-hello { font-size: 28px; font-weight: 500; color: #1a1a2e; letter-spacing: -0.02em; line-height: 1.15; }
    .cp-hello-sub { font-size: 13px; color: #888; margin-top: 4px; }
    .cp-card { background: #fff; border-radius: 16px; padding: 20px; margin-bottom: 16px; }
    .cp-card-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; margin-bottom: 16px; }
    .cp-sub-title { font-size: 18px; font-weight: 500; color: #1a1a2e; }
    .cp-sub-meta { font-size: 13px; color: #888; margin-top: 4px; }
    .cp-badge { font-size: 11px; padding: 4px 10px; border-radius: 99px; white-space: nowrap; letter-spacing: 0.03em; font-weight: 500; }
    .cp-badge-review { background: #EEEDFE; color: #3C3489; }
    .cp-badge-rebuttal { background: #E6F1FB; color: #0C447C; }
    .cp-badge-accepted { background: #EAF3DE; color: #27500A; }
    .cp-badge-pending { background: #e0e0ee; color: #555; }
    .cp-section-title { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #888; margin-bottom: 12px; }
    .cp-lifecycle { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-bottom: 20px; }
    @media (max-width: 600px) { .cp-lifecycle { grid-template-columns: 1fr 1fr; } }
    .cp-step { background: #f5f5fb; border: 1px solid #e0e0ee; border-radius: 8px; padding: 8px; font-size: 11px; text-align: center; color: #555; }
    .cp-text { font-size: 13px; color: #1a1a2e; line-height: 1.5; margin-bottom: 20px; white-space: pre-wrap; }
    .cp-list { font-size: 13px; color: #1a1a2e; line-height: 1.5; margin-bottom: 20px; padding-left: 20px; }
    .cp-list li { margin-bottom: 4px; }
    .cp-meta-text { font-size: 11px; color: #aaa; margin-top: -12px; margin-bottom: 20px; }
    .cp-actions { display: flex; gap: 16px; }
    .cp-btn-link { font-size: 13px; font-weight: 500; color: #4b3fa0; text-decoration: none; transition: color 0.15s; }
    .cp-btn-link:hover { color: #2e2e52; }
    .cp-empty { text-align: center; padding: 40px 20px; background: #fff; border-radius: 16px; border: 1px dashed #c8c8de; }
    .cp-empty-text { font-size: 13px; color: #888; margin-bottom: 12px; }
    .cp-status-alert { background: #EAF3DE; color: #27500A; padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 24px; border: 1px solid #d4e8c1; }
</style>

<div class="cp-shell">
    @include('partials.topbar')
    <div class="cp-hero">
        <h1 class="cp-hello">Abstract Review</h1>
        <p class="cp-hello-sub">Track each abstract's review process and reviewer comments.</p>
    </div>

    @if (session('status'))
        <div class="cp-status-alert">
            {{ session('status') }}
        </div>
    @endif

    @if (count($submissions) === 0)
        <div class="cp-empty">
            <p class="cp-empty-text">No abstracts submitted yet.</p>
            <a href="{{ route('submit') }}" class="cp-btn-link">Submit your first abstract →</a>
        </div>
    @else
        <div>
            @foreach ($submissions as $submission)
                @php
                    $badgeClass = match(strtolower($submission['status'] ?? '')) {
                        'under review'  => 'cp-badge-review',
                        'rebuttal open' => 'cp-badge-rebuttal',
                        'accepted'      => 'cp-badge-accepted',
                        default         => 'cp-badge-pending',
                    };
                @endphp
                <div class="cp-card">
                    <div class="cp-card-head">
                        <div>
                            <h2 class="cp-sub-title">{{ $submission['title'] }}</h2>
                            <p class="cp-sub-meta">Author: {{ $submission['author'] }} | Track: {{ $submission['track'] }}</p>
                        </div>
                        <span class="cp-badge {{ $badgeClass }}">
                            {{ $submission['status'] }}
                        </span>
                    </div>

                    <div>
                        <h3 class="cp-section-title">Submission Lifecycle</h3>
                        <div class="cp-lifecycle">
                            @foreach (['Abstract Submitted', 'Under Review', 'Rebuttal', 'Decision'] as $step)
                                <div class="cp-step">
                                    {{ $step }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="cp-section-title">Abstract</h3>
                        <p class="cp-text">{{ $submission['abstract'] }}</p>
                    </div>

                    <div>
                        <h3 class="cp-section-title">Review Process & Comments</h3>
                        <ul class="cp-list">
                            @foreach ($submission['comments'] as $comment)
                                <li>{{ $comment }}</li>
                            @endforeach
                        </ul>
                        <p class="cp-meta-text">Submitted: {{ $submission['submitted_at'] }}</p>
                    </div>

                    <div class="cp-actions">
                        @if (!empty($submission['attachment_path']))
                            <a href="{{ route('downloads.attachment', $submission['id']) }}" class="cp-btn-link">
                                Download Attachment ↗
                            </a>
                        @endif
                        <a href="{{ route('rebuttals') }}" class="cp-btn-link">
                            Open Rebuttal →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
</x-layouts::app>
