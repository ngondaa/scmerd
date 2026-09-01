<x-layouts::app :title="__('Rebuttals')">

@include('partials.portal.open')

<div class="cp-hero">
    <p class="cp-kicker">Response</p>
    <h1 class="cp-hello">Rebuttal</h1>
    <p class="cp-hello-sub">Respond to review comments from the author side.</p>
</div>

@if (session('status'))
    <div class="cp-status-alert">{{ session('status') }}</div>
@endif

@if (count($submissions) === 0)
    <div class="cp-empty">
        <p class="cp-empty-text">No submissions available for rebuttal yet.</p>
    </div>
@else
    @foreach ($submissions as $submission)
        <div class="cp-card cp-card--inset">
            <h2 class="cp-sub-title">{{ $submission['title'] }}</h2>
            <p class="cp-sub-meta">Current status: {{ $submission['status'] }}</p>

            <h3 class="cp-section-title">Reviewer comments</h3>
            <ul class="cp-list">
                @foreach ($submission['comments'] as $comment)
                    <li>{{ $comment }}</li>
                @endforeach
            </ul>

            <form method="POST" action="{{ route('rebuttals.store', $submission['id']) }}">
                @csrf
                <label for="rebuttal-{{ $submission['id'] }}" class="cp-label">Your rebuttal</label>
                <textarea
                    id="rebuttal-{{ $submission['id'] }}"
                    name="rebuttal"
                    rows="4"
                    class="cp-textarea"
                    style="min-height:120px;margin-bottom:16px;"
                >{{ $submission['rebuttal'] ?? '' }}</textarea>
                @error('rebuttal')
                    <p class="cp-error">{{ $message }}</p>
                @enderror
                <button type="submit" class="cp-btn-primary">Submit rebuttal</button>
            </form>
        </div>
    @endforeach
@endif

@include('partials.portal.close')

</x-layouts::app>
