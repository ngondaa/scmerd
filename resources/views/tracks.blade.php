<x-layouts::app :title="__('Tracks')">

@include('partials.portal.open')

<div class="cp-hero">
    <p class="cp-kicker">Scope</p>
    <h1 class="cp-hello">Submission tracks</h1>
    <p class="cp-hello-sub">Current scope is limited to abstract submission only.</p>
</div>

<div class="cp-grid">
    @foreach ($tracks as $track)
        <div class="cp-card">
            <h2 class="cp-sub-title" style="font-size:18px;">{{ $track }}</h2>
            <p class="cp-sub-meta">
                Your submissions: {{ count(array_filter($submissions, fn($s) => $s['track'] === $track)) }}
            </p>
        </div>
    @endforeach
</div>

@include('partials.portal.close')

</x-layouts::app>
