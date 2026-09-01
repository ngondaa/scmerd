<x-layouts::app :title="__('Downloads')">

@include('partials.portal.open')

<div class="cp-hero cp-hero--row">
    <div>
        <p class="cp-kicker">Export</p>
        <h1 class="cp-hello">Downloads</h1>
        <p class="cp-hello-sub">Download uploaded files or export all submission records.</p>
    </div>
    <a href="{{ route('exports.submissions') }}" class="cp-btn-primary">Export CSV</a>
</div>

@if (count($submissions) === 0)
    <div class="cp-empty">
        <p class="cp-empty-text">No files available yet.</p>
    </div>
@else
    @foreach ($submissions as $submission)
        <div class="cp-card cp-card--inset">
            <p class="cp-item-title">{{ $submission['title'] }}</p>
            <p class="cp-item-meta">{{ $submission['track'] }} · {{ $submission['stage'] }}</p>
            @if (!empty($submission['attachment_path']))
                <a href="{{ route('downloads.attachment', $submission['id']) }}" class="cp-btn-link">
                    Download {{ $submission['attachment_name'] ?? 'attachment' }}
                </a>
            @else
                <p class="cp-item-meta">No attachment uploaded.</p>
            @endif
        </div>
    @endforeach
@endif

@include('partials.portal.close')

</x-layouts::app>
