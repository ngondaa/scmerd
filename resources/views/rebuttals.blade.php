<x-layouts::app :title="__('Rebuttals')">
<style>
    .cp-shell { background: #f0f0f5; border-radius: 20px; padding: 16px; font-family: var(--font-sans, ui-sans-serif, system-ui, sans-serif); max-width: 1000px; margin: 0 auto; }
    .cp-hero { margin-bottom: 24px; padding: 0 4px; }
    .cp-hello { font-size: 28px; font-weight: 500; color: #1a1a2e; letter-spacing: -0.02em; line-height: 1.15; }
    .cp-hello-sub { font-size: 13px; color: #888; margin-top: 4px; }
    .cp-card { background: #fff; border-radius: 16px; padding: 20px; margin-bottom: 16px; }
    .cp-sub-title { font-size: 18px; font-weight: 500; color: #1a1a2e; }
    .cp-sub-meta { font-size: 13px; color: #888; margin-top: 4px; margin-bottom: 16px; }
    .cp-section-title { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #888; margin-bottom: 12px; }
    .cp-list { font-size: 13px; color: #1a1a2e; line-height: 1.5; margin-bottom: 20px; padding-left: 20px; }
    .cp-list li { margin-bottom: 4px; }
    .cp-label { display: block; font-size: 13px; font-weight: 500; color: #1a1a2e; margin-bottom: 8px; }
    .cp-textarea { width: 100%; border: 1px solid #e0e0ee; border-radius: 12px; padding: 10px 14px; font-size: 13px; font-family: inherit; color: #1a1a2e; background: #fff; transition: border-color 0.15s; outline: none; margin-bottom: 12px; }
    .cp-textarea:focus { border-color: #4b3fa0; }
    .cp-btn-primary { background: #1a1a2e; color: #e8e8f5; border: none; border-radius: 12px; padding: 10px 20px; font-size: 13px; font-weight: 500; cursor: pointer; transition: background 0.15s; display: inline-block; text-decoration: none; }
    .cp-btn-primary:hover { background: #2e2e52; }
    .cp-error { font-size: 11px; color: #d32f2f; margin-bottom: 12px; margin-top: -8px; }
    .cp-empty { text-align: center; padding: 40px 20px; background: #fff; border-radius: 16px; border: 1px dashed #c8c8de; font-size: 13px; color: #888; }
    .cp-status-alert { background: #EAF3DE; color: #27500A; padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 24px; border: 1px solid #d4e8c1; }
</style>

<div class="cp-shell">
    @include('partials.topbar')
    <div class="cp-hero">
        <h1 class="cp-hello">Rebuttal</h1>
        <p class="cp-hello-sub">Respond to review comments from the author side.</p>
    </div>

    @if (session('status'))
        <div class="cp-status-alert">
            {{ session('status') }}
        </div>
    @endif

    @if (count($submissions) === 0)
        <div class="cp-empty">
            No submissions available for rebuttal yet.
        </div>
    @else
        <div>
            @foreach ($submissions as $submission)
                <div class="cp-card">
                    <h2 class="cp-sub-title">{{ $submission['title'] }}</h2>
                    <p class="cp-sub-meta">Current status: {{ $submission['status'] }}</p>

                    <div>
                        <h3 class="cp-section-title">Reviewer Comments</h3>
                        <ul class="cp-list">
                            @foreach ($submission['comments'] as $comment)
                                <li>{{ $comment }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('rebuttals.store', $submission['id']) }}">
                        @csrf
                        <label for="rebuttal-{{ $submission['id'] }}" class="cp-label">Your Rebuttal</label>
                        <textarea
                            id="rebuttal-{{ $submission['id'] }}"
                            name="rebuttal"
                            rows="4"
                            class="cp-textarea"
                        >{{ $submission['rebuttal'] ?? '' }}</textarea>
                        @error('rebuttal')
                            <p class="cp-error">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="cp-btn-primary">
                            Submit Rebuttal
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
</x-layouts::app>
