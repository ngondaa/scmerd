<x-layouts::app :title="__('Tracks')">
<style>
    .cp-shell { background: #f0f0f5; border-radius: 20px; padding: 16px; font-family: var(--font-sans, ui-sans-serif, system-ui, sans-serif); max-width: 1000px; margin: 0 auto; }
    .cp-hero { margin-bottom: 24px; padding: 0 4px; }
    .cp-hello { font-size: 28px; font-weight: 500; color: #1a1a2e; letter-spacing: -0.02em; line-height: 1.15; }
    .cp-hello-sub { font-size: 13px; color: #888; margin-top: 4px; }
    .cp-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    @media (max-width: 600px) { .cp-grid { grid-template-columns: 1fr; } }
    .cp-card { background: #fff; border-radius: 16px; padding: 20px; border: 1px solid #e0e0ee; }
    .cp-sub-title { font-size: 16px; font-weight: 500; color: #1a1a2e; }
    .cp-sub-meta { font-size: 13px; color: #888; margin-top: 8px; }
</style>

<div class="cp-shell">
    @include('partials.topbar')
    <div class="cp-hero">
        <h1 class="cp-hello">Submission Track</h1>
        <p class="cp-hello-sub">Current scope is limited to abstract submission only.</p>
    </div>

    <div class="cp-grid">
        @foreach ($tracks as $track)
            <div class="cp-card">
                <h2 class="cp-sub-title">{{ $track }}</h2>
                <p class="cp-sub-meta">
                    Your submissions: {{ count(array_filter($submissions, fn($s) => $s['track'] === $track)) }}
                </p>
            </div>
        @endforeach
    </div>
</div>
</x-layouts::app>
