<x-layouts::app :title="__('Reviewer Dashboard')">
    @include('partials.portal.open')

    <div class="cp-main-grid">
        <div class="cp-card cp-card-highlight">
            <h2 class="cp-card-title">Reviewer dashboard</h2>
            <p class="cp-card-desc">All submissions received across the conference portal.</p>

            @if (session('status'))
                <p class="cp-card-desc" style="color:#1a7f37; margin-bottom:16px;">{{ session('status') }}</p>
            @endif

            @if ($submissions->isEmpty())
                <p class="cp-card-desc">No abstracts have been submitted yet.</p>
            @else
                <div style="display:grid; gap:18px; margin-top:20px;">
                    @foreach ($submissions as $submission)
                        <div style="border:1px solid #eaeaea; border-radius:10px; padding:18px; background:#fff;">
                            <div style="display:flex; justify-content:space-between; gap:16px; flex-wrap:wrap; align-items:center;">
                                <div>
                                    <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666;">{{ $submission->track }}</div>
                                    <h3 style="margin:8px 0 0; font-size:22px;">{{ $submission->title }}</h3>
                                </div>
                                <span style="padding:6px 10px; border-radius:999px; background:#f3f3f3; font-size:12px; font-weight:700; color:#1d1d1d;">
                                    {{ $submission->status ?? 'Under Initial Review' }}
                                </span>
                            </div>

                            <div style="margin-top:12px; color:#4b5563; line-height:1.6;">
                                <strong>Author:</strong> {{ $submission->author }}<br>
                                <strong>Submitted by:</strong> {{ $submission->user?->email ?? 'Unknown user' }}<br>
                                <strong>Submitted:</strong> {{ $submission->submitted_at?->format('j M Y, H:i') ?? 'N/A' }}
                            </div>

                            @if (! empty($submission->attachment_path))
                                <div style="margin-top:12px;">
                                    <a href="{{ route('downloads.attachment', $submission->id) }}" class="cp-btn-link">Download attachment</a>
                                    @if (! empty($submission->attachment_name))
                                        <span style="margin-left:8px; color:#6b7280;">{{ $submission->attachment_name }}</span>
                                    @endif
                                </div>
                            @endif

                            <div style="margin-top:16px; padding:14px 16px; background:#fafaf8; border:1px solid #eaeaea; border-radius:8px;">
                                <div style="font-weight:700; margin-bottom:8px;">Abstract</div>
                                <div style="white-space:pre-wrap;">{{ $submission->abstract }}</div>
                            </div>

                            @if (! empty($submission->comments))
                                <div style="margin-top:16px;">
                                    <div style="font-weight:700; margin-bottom:8px;">Review comments</div>
                                    <ul style="padding-left:18px; color:#374151; margin:0; display:grid; gap:8px;">
                                        @foreach ($submission->comments as $comment)
                                            <li>
                                                @if (is_array($comment))
                                                    <strong>{{ $comment['author'] ?? 'Reviewer' }}</strong>
                                                    <span> — {{ $comment['message'] ?? '' }}</span>
                                                    @if (! empty($comment['at']))
                                                        <small style="color:#6b7280;"> ({{ \Carbon\Carbon::parse($comment['at'])->format('d M Y H:i') }})</small>
                                                    @endif

                                                        @if ($submission->relationLoaded('reviews') ? $submission->reviews->isNotEmpty() : $submission->reviews()->exists())
                                                            <div style="margin-top:16px;">
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
                                                @else
                                                    {{ $comment }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('reviewer.comment', $submission) }}" style="margin-top:16px;">
                                @csrf
                                <div style="display:grid; gap:12px;">
                                    <label for="comment-{{ $submission->id }}" style="font-weight:700;">Add review comment</label>
                                    <textarea id="comment-{{ $submission->id }}" name="comment" rows="4" required style="width:100%; border:1px solid #d8d8d8; border-radius:8px; padding:10px 12px;"></textarea>
                                    <div style="display:flex; gap:12px; align-items:center; flex-wrap:wrap;">
                                        <select name="status" style="padding:10px 12px; border:1px solid #d8d8d8; border-radius:8px; background:#fff;">
                                            <option value="">Keep current status</option>
                                            <option value="Under Initial Review">Under Initial Review</option>
                                            <option value="Rebuttal Open">Rebuttal Open</option>
                                            <option value="Accepted">Accepted</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Send comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>
