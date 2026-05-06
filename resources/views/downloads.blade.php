<x-layouts::app :title="__('Downloads')">
<style>
    .cp-shell { background: #f0f0f5; border-radius: 20px; padding: 16px; font-family: var(--font-sans, ui-sans-serif, system-ui, sans-serif); max-width: 1000px; margin: 0 auto; }
    .cp-hero { margin-bottom: 24px; padding: 0 4px; display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
    .cp-hello { font-size: 28px; font-weight: 500; color: #1a1a2e; letter-spacing: -0.02em; line-height: 1.15; }
    .cp-hello-sub { font-size: 13px; color: #888; margin-top: 4px; }
    .cp-btn-primary { background: #1a1a2e; color: #e8e8f5; border: none; border-radius: 12px; padding: 10px 20px; font-size: 13px; font-weight: 500; cursor: pointer; transition: background 0.15s; display: inline-flex; align-items: center; text-decoration: none; }
    .cp-btn-primary:hover { background: #2e2e52; }
    .cp-card { background: #fff; border-radius: 12px; padding: 16px; margin-bottom: 12px; border: 1px solid #e0e0ee; }
    .cp-item-title { font-size: 14px; font-weight: 500; color: #1a1a2e; }
    .cp-item-meta { font-size: 12px; color: #888; margin-top: 4px; margin-bottom: 12px; }
    .cp-btn-link { font-size: 13px; font-weight: 500; color: #4b3fa0; text-decoration: none; transition: color 0.15s; }
    .cp-btn-link:hover { color: #2e2e52; }
    .cp-empty { text-align: center; padding: 40px 20px; background: #fff; border-radius: 16px; border: 1px dashed #c8c8de; font-size: 13px; color: #888; }
</style>

<div class="cp-shell">
    @include('partials.topbar')
    <div class="cp-hero">
        <div>
            <h1 class="cp-hello">Downloads and Export</h1>
            <p class="cp-hello-sub">Download uploaded files or export all submission records.</p>
        </div>
        <a href="{{ route('exports.submissions') }}" class="cp-btn-primary">
            Export CSV
        </a>
    </div>

    @if (count($submissions) === 0)
        <div class="cp-empty">
            No files available yet.
        </div>
    @else
        <div>
            @foreach ($submissions as $submission)
                <div class="cp-card">
                    <p class="cp-item-title">{{ $submission['title'] }}</p>
                    <p class="cp-item-meta">{{ $submission['track'] }} | {{ $submission['stage'] }}</p>
                    @if (!empty($submission['attachment_path']))
                        <a href="{{ route('downloads.attachment', $submission['id']) }}" class="cp-btn-link">
                            Download {{ $submission['attachment_name'] ?? 'attachment' }} ↗
                        </a>
                    @else
                        <p class="cp-item-meta" style="margin-bottom: 0;">No attachment uploaded.</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
</x-layouts::app>
