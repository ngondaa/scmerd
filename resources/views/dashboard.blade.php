<x-layouts::app :title="__('Dashboard')">
@verbatim
<style>
    .cp-shell{background:#f0f0f5;border-radius:20px;padding:16px;font-family:ui-sans-serif,system-ui,sans-serif}
    .cp-topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
    .cp-brand{background:#1a1a2e;color:#e8e8f5;border-radius:20px;padding:6px 16px;font-size:13px;font-weight:500;letter-spacing:.02em;text-decoration:none}
    .cp-nav{display:flex;align-items:center;gap:2px;background:#e0e0ee;border-radius:20px;padding:3px}
    .cp-nav-item{padding:5px 13px;border-radius:16px;font-size:12px;color:#666;text-decoration:none;white-space:nowrap;transition:background .15s}
    .cp-nav-item:hover{background:#d0d0e8;color:#1a1a2e}
    .cp-nav-item.active{background:#1a1a2e;color:#e8e8f5}
    .cp-topbar-right{display:flex;align-items:center;gap:8px}
    .cp-top-btn{background:#e0e0ee;border-radius:20px;padding:6px 14px;font-size:12px;color:#555;cursor:pointer;border:none;text-decoration:none}
    .cp-avatar{width:30px;height:30px;border-radius:50%;background:#4b3fa0;color:#e8e8f5;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:500}
    .cp-hero{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;padding:0 4px;gap:16px}
    .cp-hello{font-size:28px;font-weight:500;color:#1a1a2e;letter-spacing:-.02em;line-height:1.15}
    .cp-hello-sub{font-size:13px;color:#888;margin-top:4px}
    .cp-big-stats{display:flex;gap:28px;align-items:flex-end;flex-shrink:0}
    .cp-big-stat{text-align:right}
    .cp-big-num{font-size:32px;font-weight:500;color:#1a1a2e;line-height:1}
    .cp-big-label{font-size:11px;color:#888;margin-top:3px}
    .cp-progress-row{display:flex;gap:8px;margin-bottom:16px}
    .cp-prog-pill{background:#e0e0ee;border-radius:12px;padding:10px 14px;flex:1}
    .cp-prog-label{font-size:10px;color:#888;margin-bottom:6px;text-transform:uppercase;letter-spacing:.06em}
    .cp-prog-bar-wrap{background:#c8c8de;border-radius:6px;height:6px;width:100%}
    .cp-prog-bar{border-radius:6px;height:6px}
    .cp-prog-val{font-size:12px;color:#1a1a2e;font-weight:500;margin-top:5px}
    .cp-main-grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1.6fr) minmax(0,1fr);gap:10px;margin-bottom:10px}
    @media(max-width:900px){.cp-main-grid{grid-template-columns:1fr}.cp-hero{flex-direction:column}.cp-progress-row{flex-wrap:wrap}}
    .cp-card{background:#fff;border-radius:16px;padding:14px}
    .cp-card-dark{background:#1a1a2e;border-radius:16px;padding:14px}
    .cp-card-purple{background:#4b3fa0;border-radius:16px;padding:14px}
    .cp-card-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
    .cp-card-title{font-size:13px;font-weight:500;color:#1a1a2e}
    .cp-card-title-light{font-size:13px;font-weight:500;color:#e8e8f5}
    .cp-card-ext{font-size:11px;color:#aaa;text-decoration:none}
    .cp-module-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px}
    .cp-mod-card{background:#f5f5fb;border-radius:12px;padding:12px 14px;cursor:pointer;transition:background .15s;text-decoration:none;display:block}
    .cp-mod-card:hover{background:#ebebf8}
    .cp-mod-title{font-size:12px;font-weight:500;color:#1a1a2e;margin-bottom:3px}
    .cp-mod-desc{font-size:11px;color:#888;line-height:1.4}
    .cp-mod-arrow{font-size:11px;color:#4b3fa0;margin-top:6px}
    .cp-sub-row{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:8px 0;border-bottom:.5px solid #f0f0f5}
    .cp-sub-row:last-child{border-bottom:none}
    .cp-sub-id{font-size:10px;color:#aaa;margin-bottom:2px;letter-spacing:.04em}
    .cp-sub-title{font-size:12px;color:#1a1a2e}
    .cp-badge{font-size:10px;padding:2px 8px;border-radius:99px;white-space:nowrap;letter-spacing:.03em;flex-shrink:0}
    .cp-badge-review{background:#EEEDFE;color:#3C3489}
    .cp-badge-rebuttal{background:#E6F1FB;color:#0C447C}
    .cp-badge-accepted{background:#EAF3DE;color:#27500A}
    .cp-badge-pending{background:#e0e0ee;color:#555}
    .cp-att-big{display:flex;gap:16px;margin-bottom:10px}
    .cp-att-num{font-size:22px;font-weight:500;color:#e8e8f5;line-height:1}
    .cp-att-sub{font-size:10px;color:#8888aa;margin-top:3px}
    .cp-att-dots{display:flex;flex-wrap:wrap;gap:4px}
    .cp-att-dot{width:13px;height:13px;border-radius:50%}
    .cp-bottom-row{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:10px}
    @media(max-width:700px){.cp-bottom-row{grid-template-columns:1fr}}
    .cp-prog-steps{display:flex;flex-direction:column;gap:8px;margin-top:4px}
    .cp-prog-step{display:flex;align-items:center;gap:10px}
    .cp-ps-label{font-size:11px;color:#888;width:90px;flex-shrink:0}
    .cp-ps-track{flex:1;background:#e0e0ee;border-radius:6px;height:7px}
    .cp-ps-fill{border-radius:6px;height:7px}
    .cp-ps-val{font-size:11px;color:#1a1a2e;font-weight:500;width:24px;text-align:right;flex-shrink:0}
    .cp-qa-item{background:#3a2f8a;border-radius:10px;padding:10px 12px;cursor:pointer;margin-bottom:8px;text-decoration:none;display:block}
    .cp-qa-item:last-child{margin-bottom:0}
    .cp-qa-title{font-size:12px;font-weight:500;color:#e8e8f5}
    .cp-qa-sub{font-size:11px;color:#9b8fff;margin-top:2px}
    .cp-empty{font-size:12px;color:#aaa;font-style:italic;padding:12px 0}
</style>
@endverbatim

<div class="cp-shell">
    {{-- Topbar --}}
    <div class="cp-topbar">
        <span class="cp-brand">ConfPortal</span>
        <div class="cp-nav">
            <a href="{{ route('dashboard') }}"    class="cp-nav-item active">Dashboard</a>
            <a href="{{ route('submit') }}"        class="cp-nav-item">Submit</a>
            <a href="{{ route('abstracts') }}"     class="cp-nav-item">Abstracts</a>
            <a href="{{ route('rebuttals') }}"     class="cp-nav-item">Rebuttals</a>
            <a href="{{ route('notifications') }}" class="cp-nav-item">Notifications</a>
            <a href="{{ route('downloads') }}"     class="cp-nav-item">Downloads</a>
        </div>
        <div class="cp-topbar-right">
            <a href="/profile" class="cp-top-btn">Settings</a>
            <div class="cp-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'AU', 0, 2)) }}</div>
        </div>
    </div>

    {{-- Hero --}}
    <div class="cp-hero">
        <div>
            <div class="cp-hello">Author Dashboard</div>
            <div class="cp-hello-sub">Submit abstracts, track reviews, manage rebuttals, download files.</div>
        </div>
        <div class="cp-big-stats">
            <div class="cp-big-stat">
                <div class="cp-big-num">{{ $stats['total'] ?? 0 }}</div>
                <div class="cp-big-label">Submissions</div>
            </div>
            <div class="cp-big-stat">
                <div class="cp-big-num">{{ $stats['under_review'] ?? 0 }}</div>
                <div class="cp-big-label">Under review</div>
            </div>
            <div class="cp-big-stat">
                <div class="cp-big-num">{{ ($stats['rebuttal_open'] ?? 0) + ($stats['accepted'] ?? 0) }}</div>
                <div class="cp-big-label">Rebuttal / accepted</div>
            </div>
        </div>
    </div>

    {{-- Progress pills --}}
    @php
        $cpTotal     = max($stats['total'] ?? 1, 1);
        $pctSubm     = round(($stats['total'] ?? 0) / $cpTotal * 100);
        $pctReview   = round(($stats['under_review'] ?? 0) / $cpTotal * 100);
        $pctRebuttal = round(($stats['rebuttal_open'] ?? 0) / $cpTotal * 100);
        $pctAccepted = round(($stats['accepted'] ?? 0) / $cpTotal * 100);
    @endphp
    <div class="cp-progress-row">
        <div class="cp-prog-pill">
            <div class="cp-prog-label">Submitted</div>
            <div class="cp-prog-bar-wrap"><div class="cp-prog-bar" style="width:{{ $pctSubm }}%;background:#1a1a2e"></div></div>
            <div class="cp-prog-val">{{ $stats['total'] ?? 0 }}</div>
        </div>
        <div class="cp-prog-pill">
            <div class="cp-prog-label">Under review</div>
            <div class="cp-prog-bar-wrap"><div class="cp-prog-bar" style="width:{{ $pctReview }}%;background:#4b3fa0"></div></div>
            <div class="cp-prog-val">{{ $stats['under_review'] ?? 0 }}</div>
        </div>
        <div class="cp-prog-pill">
            <div class="cp-prog-label">Rebuttal</div>
            <div class="cp-prog-bar-wrap"><div class="cp-prog-bar" style="width:{{ $pctRebuttal }}%;background:#7b72cc"></div></div>
            <div class="cp-prog-val">{{ $stats['rebuttal_open'] ?? 0 }}</div>
        </div>
        <div class="cp-prog-pill">
            <div class="cp-prog-label">Accepted</div>
            <div class="cp-prog-bar-wrap"><div class="cp-prog-bar" style="width:{{ $pctAccepted }}%;background:#AFA9EC"></div></div>
            <div class="cp-prog-val">{{ $stats['accepted'] ?? 0 }}</div>
        </div>
    </div>

    {{-- Main 3-column grid --}}
    <div class="cp-main-grid">

        {{-- Portal modules --}}
        <div class="cp-card">
            <div class="cp-card-head">
                <span class="cp-card-title">Portal modules</span>
                <span class="cp-card-ext">↗</span>
            </div>
            <div class="cp-module-grid">
                <a href="{{ route('submit') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Submit abstract</div>
                    <div class="cp-mod-desc">Metadata form with file upload</div>
                    <div class="cp-mod-arrow">→</div>
                </a>
                <a href="{{ route('abstracts') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Life cycle</div>
                    <div class="cp-mod-desc">Status timeline &amp; comments</div>
                    <div class="cp-mod-arrow">→</div>
                </a>
                <a href="{{ route('tracks') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Tracks</div>
                    <div class="cp-mod-desc">Abstract submission only</div>
                    <div class="cp-mod-arrow">→</div>
                </a>
                <a href="{{ route('rebuttals') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Rebuttal</div>
                    <div class="cp-mod-desc">Respond to reviewers</div>
                    <div class="cp-mod-arrow">→</div>
                </a>
                <a href="{{ route('notifications') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Notifications</div>
                    <div class="cp-mod-desc">Review &amp; rebuttal alerts</div>
                    <div class="cp-mod-arrow">→</div>
                </a>
                <a href="{{ route('downloads') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Downloads</div>
                    <div class="cp-mod-desc">Files &amp; CSV export</div>
                    <div class="cp-mod-arrow">→</div>
                </a>
            </div>
        </div>

        {{-- Recent submissions --}}
        <div class="cp-card">
            <div class="cp-card-head">
                <span class="cp-card-title">Recent submissions</span>
                <a href="{{ route('abstracts') }}" class="cp-card-ext">View all ↗</a>
            </div>
            @if (empty($submissions))
                <p class="cp-empty">No submissions yet. Start from the submit page.</p>
            @else
                @foreach (array_slice($submissions, 0, 5) as $submission)
                    @php
                        $cpStatus = strtolower($submission['status'] ?? '');
                        if ($cpStatus === 'under review') {
                            $badgeClass = 'cp-badge-review';
                        } elseif ($cpStatus === 'rebuttal open') {
                            $badgeClass = 'cp-badge-rebuttal';
                        } elseif ($cpStatus === 'accepted') {
                            $badgeClass = 'cp-badge-accepted';
                        } else {
                            $badgeClass = 'cp-badge-pending';
                        }
                    @endphp
                    <div class="cp-sub-row">
                        <div>
                            <div class="cp-sub-id">{{ $submission['track'] ?? 'Abstract submission' }}</div>
                            <div class="cp-sub-title">{{ $submission['title'] }}</div>
                        </div>
                        <span class="cp-badge {{ $badgeClass }}">{{ $submission['status'] }}</span>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Review pipeline --}}
        <div class="cp-card-dark">
            <div class="cp-card-head">
                <span class="cp-card-title-light">Review pipeline</span>
                <span class="cp-card-ext">↗</span>
            </div>
            <div class="cp-att-big">
                <div>
                    <div class="cp-att-num">{{ $stats['under_review'] ?? 0 }} <span style="font-size:10px;color:#9b8fff">↗</span></div>
                    <div class="cp-att-sub">Active</div>
                </div>
                <div>
                    <div class="cp-att-num">{{ $stats['rebuttal_open'] ?? 0 }} <span style="font-size:10px;color:#6666aa">↘</span></div>
                    <div class="cp-att-sub">Pending</div>
                </div>
            </div>
            <div class="cp-att-dots">
                @php $cpDots = ['#2e2e52','#4b3fa0','#2e2e52','#7b72cc','#2e2e52']; @endphp
                @for ($i = 0; $i < 24; $i++)
                    <div class="cp-att-dot" style="background:{{ $cpDots[$i % 5] }}"></div>
                @endfor
            </div>
        </div>

    </div>

    {{-- Bottom row --}}
    <div class="cp-bottom-row">

        {{-- Stage breakdown --}}
        <div class="cp-card">
            <div class="cp-card-head">
                <span class="cp-card-title">Submission stage breakdown</span>
            </div>
            <div class="cp-prog-steps">
                @php
                    $cpStages = [
                        ['label' => 'Submitted',    'val' => $stats['total'] ?? 0,         'color' => '#1a1a2e'],
                        ['label' => 'Under review', 'val' => $stats['under_review'] ?? 0,  'color' => '#4b3fa0'],
                        ['label' => 'Rebuttal',     'val' => $stats['rebuttal_open'] ?? 0, 'color' => '#7b72cc'],
                        ['label' => 'Accepted',     'val' => $stats['accepted'] ?? 0,      'color' => '#AFA9EC'],
                        ['label' => 'Rejected',     'val' => $stats['rejected'] ?? 0,      'color' => '#c8c8de'],
                    ];
                    $cpMax = max(array_column($cpStages, 'val') ?: [1]);
                    $cpMax = $cpMax > 0 ? $cpMax : 1;
                @endphp
                @foreach ($cpStages as $cpStage)
                    <div class="cp-prog-step">
                        <div class="cp-ps-label">{{ $cpStage['label'] }}</div>
                        <div class="cp-ps-track">
                            <div class="cp-ps-fill" style="width:{{ round($cpStage['val'] / $cpMax * 100) }}%;background:{{ $cpStage['color'] }}"></div>
                        </div>
                        <div class="cp-ps-val">{{ $cpStage['val'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="cp-card-purple">
            <div class="cp-card-head">
                <span class="cp-card-title-light">Quick actions</span>
            </div>
            <a href="{{ route('submit') }}" class="cp-qa-item">
                <div class="cp-qa-title">New submission</div>
                <div class="cp-qa-sub">Open the abstract form →</div>
            </a>
            <a href="{{ route('rebuttals') }}" class="cp-qa-item">
                <div class="cp-qa-title">Pending rebuttals</div>
                <div class="cp-qa-sub">{{ $stats['rebuttal_open'] ?? 0 }} response(s) required →</div>
            </a>
            <a href="{{ route('downloads') }}" class="cp-qa-item">
                <div class="cp-qa-title">Download CSV</div>
                <div class="cp-qa-sub">Export submission list →</div>
            </a>
        </div>

    </div>
</div>
</x-layouts::app>   