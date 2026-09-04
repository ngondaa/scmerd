<x-layouts::app :title="$submission->title">
    @include('partials.portal.open')

    <div class="cp-main-grid">
        <div class="cp-card cp-card-highlight">
            <h2 class="cp-card-title">{{ $submission->title }}</h2>
            <p class="cp-card-desc">Author: {{ $submission->author }}</p>

            <div style="margin-top:12px; color:#4b5563; line-height:1.6;">
                <strong>Track:</strong> {{ $submission->track }}<br>
                <strong>Submitted by:</strong> {{ $submission->user?->email ?? 'Unknown' }}<br>
                <strong>Status:</strong> {{ $submission->status ?? 'Under Initial Review' }}
            </div>

            <div style="margin-top:16px; padding:14px 16px; background:#fafaf8; border:1px solid #eaeaea; border-radius:8px;">
                <div style="font-weight:700; margin-bottom:8px;">Abstract</div>
                <div style="white-space:pre-wrap;">{{ $submission->abstract }}</div>
            </div>

            <div style="margin-top:16px;">
                <div style="font-weight:700; margin-bottom:8px;">Assigned Reviewers</div>
                <ul style="padding-left:18px; color:#374151; margin:0; display:grid; gap:8px;">
                    @forelse ($submission->reviewers as $r)
                        <li>{{ $r->name }} ({{ $r->email }}) — assigned {{ $r->pivot->assigned_at?->format('j M Y, H:i') }}</li>
                    @empty
                        <li>No reviewers assigned</li>
                    @endforelse
                </ul>
            </div>

            <form method="POST" action="{{ route('reviewer.submission.assign', $submission) }}" style="margin-top:16px;">
                @csrf
                <div style="display:flex; gap:12px; align-items:center;">
                    <select name="user_id" style="padding:10px 12px; border:1px solid #d8d8d8; border-radius:8px; background:#fff;">
                        @foreach ($possibleReviewers as $pr)
                            <option value="{{ $pr->id }}">{{ $pr->name }} — {{ $pr->email }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Assign reviewer</button>
                </div>
            </form>

            @if (! empty($submission->reviews))
                <div style="margin-top:18px;">
                    <div style="font-weight:700; margin-bottom:8px;">Reviews</div>
                    <ul style="padding-left:18px; color:#374151; margin:0; display:grid; gap:8px;">
                        @foreach ($submission->reviews as $r)
                            <li>
                                <strong>{{ $r->user?->name ?? 'Reviewer' }}</strong>
                                <span> — {{ $r->comment }}</span>
                                @if (! empty($r->status))
                                    <small style="color:#6b7280;"> (Status: {{ $r->status }})</small>
                                @endif
                                <small style="color:#6b7280;"> ({{ $r->created_at?->format('d M Y H:i') }})</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="margin-top:20px;">
                <a href="{{ route('reviewer.dashboard') }}" class="cp-btn-link">Back to dashboard</a>
            </div>
        </div>
    </div>
</x-layouts::app>
