<x-layouts::app :title="__('Dashboard')">
@verbatim
<style>
.cp-shell{background:#f0f0f5;border-radius:20px;padding:16px;font-family:ui-sans-serif,system-ui,sans-serif}
.cp-topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
.cp-brand{background:#1a1a2e;color:#e8e8f5;border-radius:20px;padding:6px 16px;font-size:13px;font-weight:500;text-decoration:none}
.cp-nav{display:flex;align-items:center;gap:2px;background:#e0e0ee;border-radius:20px;padding:3px;flex-wrap:wrap}
.cp-nav-item{padding:5px 13px;border-radius:16px;font-size:12px;color:#666;text-decoration:none}
.cp-nav-item:hover{background:#d0d0e8;color:#1a1a2e}
.cp-nav-item.active{background:#1a1a2e;color:#e8e8f5}

@media(max-width:768px){
.cp-nav{flex-direction:column;gap:0;padding:6px}
.cp-nav-item{display:block;width:100%;text-align:center;padding:8px 13px;margin-bottom:2px}
}
.cp-topbar-right{display:flex;align-items:center;gap:8px}
.cp-top-btn{background:#e0e0ee;border-radius:20px;padding:6px 14px;font-size:12px;color:#555;text-decoration:none}
.cp-avatar{width:30px;height:30px;border-radius:50%;background:#4b3fa0;color:#e8e8f5;display:flex;align-items:center;justify-content:center;font-size:11px}

.cp-hero{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
.cp-hello{font-size:26px;font-weight:500;color:#1a1a2e}
.cp-hello-sub{font-size:13px;color:#888;margin-top:4px}

.cp-big-stats{display:flex;gap:24px}
.cp-big-num{font-size:28px;font-weight:500;color:#1a1a2e}
.cp-big-label{font-size:11px;color:#888}

.cp-main-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
@media(max-width:900px){.cp-main-grid{grid-template-columns:1fr}}

.cp-card{background:#fff;border-radius:16px;padding:16px}
.cp-card-purple{background:#4b3fa0;border-radius:16px;padding:16px}
.cp-card-title{font-size:13px;font-weight:500;color:#1a1a2e}
.cp-card-title-light{font-size:13px;font-weight:500;color:#e8e8f5}

.cp-module-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.cp-mod-card{background:#f5f5fb;border-radius:12px;padding:12px;text-decoration:none}
.cp-mod-card:hover{background:#ebebf8}
.cp-mod-title{font-size:12px;color:#1a1a2e}
.cp-mod-desc{font-size:11px;color:#888}

.cp-sub-row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:.5px solid #eee}
.cp-sub-title{font-size:12px;color:#1a1a2e}
.cp-badge{font-size:10px;padding:2px 8px;border-radius:99px}
.cp-badge-review{background:#EEEDFE;color:#3C3489}
.cp-badge-rebuttal{background:#E6F1FB;color:#0C447C}
.cp-badge-accepted{background:#EAF3DE;color:#27500A}
.cp-badge-pending{background:#e0e0ee;color:#555}

.cp-bottom-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px}
@media(max-width:700px){.cp-bottom-row{grid-template-columns:1fr}}

.cp-qa-item{background:#3a2f8a;border-radius:10px;padding:10px;margin-top:8px;text-decoration:none;display:block}
.cp-qa-title{font-size:12px;color:#e8e8f5}
.cp-qa-sub{font-size:11px;color:#bbb}

.cp-empty{font-size:12px;color:#aaa;padding:10px 0}
</style>
@endverbatim

<div class="cp-shell">

    {{-- Topbar --}}
    <div class="cp-topbar">
        <span class="cp-brand">ConfPortal</span>
        <div class="cp-nav">
            <a href="{{ route('dashboard') }}" class="cp-nav-item active">Dashboard</a>
            <a href="{{ route('submit') }}" class="cp-nav-item">Submit</a>
            <a href="{{ route('abstracts') }}" class="cp-nav-item">Abstracts</a>
            <a href="{{ route('rebuttals') }}" class="cp-nav-item">Rebuttals</a>
            <a href="{{ route('notifications') }}" class="cp-nav-item">Notifications</a>
            <a href="{{ route('downloads') }}" class="cp-nav-item">Downloads</a>
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
            <div class="cp-hello-sub">Manage submissions and track progress.</div>
        </div>
        <div class="cp-big-stats">
            <div>
                <div class="cp-big-num">{{ $stats['total'] ?? 0 }}</div>
                <div class="cp-big-label">Total</div>
            </div>
            <div>
                <div class="cp-big-num">{{ $stats['accepted'] ?? 0 }}</div>
                <div class="cp-big-label">Accepted</div>
            </div>
        </div>
    </div>

    {{-- Main --}}
    <div class="cp-main-grid">

        {{-- Modules --}}
        <div class="cp-card">
            <div class="cp-card-title">Portal modules</div>
            <div class="cp-module-grid">
                <a href="{{ route('submit') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Submit abstract</div>
                    <div class="cp-mod-desc">Upload and manage</div>
                </a>
                <a href="{{ route('abstracts') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Submissions</div>
                    <div class="cp-mod-desc">Track status</div>
                </a>
                <a href="{{ route('rebuttals') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Rebuttals</div>
                    <div class="cp-mod-desc">Respond to reviews</div>
                </a>
                <a href="{{ route('downloads') }}" class="cp-mod-card">
                    <div class="cp-mod-title">Downloads</div>
                    <div class="cp-mod-desc">Export data</div>
                </a>
            </div>
        </div>

        {{-- Recent submissions --}}
        <div class="cp-card">
            <div class="cp-card-title">Recent submissions</div>

            @if (empty($submissions))
                <p class="cp-empty">No submissions yet.</p>
            @else
                @foreach (array_slice($submissions, 0, 5) as $submission)
                    @php
                        $status = strtolower($submission['status'] ?? '');
                        $badge = match($status) {
                            'under review' => 'cp-badge-review',
                            'rebuttal open' => 'cp-badge-rebuttal',
                            'accepted' => 'cp-badge-accepted',
                            default => 'cp-badge-pending'
                        };
                    @endphp

                    <div class="cp-sub-row">
                        <div class="cp-sub-title">{{ $submission['title'] }}</div>
                        <span class="cp-badge {{ $badge }}">{{ $submission['status'] }}</span>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

    {{-- Bottom --}}
    <div class="cp-bottom-row">

        <div class="cp-card">
            <div class="cp-card-title">Summary</div>
            <p class="cp-empty">
                {{ $stats['under_review'] ?? 0 }} under review •
                {{ $stats['rebuttal_open'] ?? 0 }} rebuttals •
                {{ $stats['rejected'] ?? 0 }} rejected
            </p>
        </div>

        <div class="cp-card-purple">
            <div class="cp-card-title-light">Quick actions</div>

            <a href="{{ route('submit') }}" class="cp-qa-item">
                <div class="cp-qa-title">New submission</div>
                <div class="cp-qa-sub">Start here →</div>
            </a>

            <a href="{{ route('rebuttals') }}" class="cp-qa-item">
                <div class="cp-qa-title">Rebuttals</div>
                <div class="cp-qa-sub">Respond →</div>
            </a>

            <a href="{{ route('downloads') }}" class="cp-qa-item">
                <div class="cp-qa-title">Download CSV</div>
                <div class="cp-qa-sub">Export →</div>
            </a>

        </div>

    </div>

</div>
</x-layouts::app>