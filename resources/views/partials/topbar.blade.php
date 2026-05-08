<style>
    .cp-topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 16px; }
    .cp-brand { background: #1a1a2e; color: #e8e8f5; border-radius: 20px; padding: 6px 16px; font-size: 13px; font-weight: 500; letter-spacing: 0.02em; text-decoration: none; }
    .cp-nav { display: flex; align-items: center; gap: 2px; background: #e0e0ee; border-radius: 20px; padding: 3px; flex-wrap: wrap; }
    .cp-nav-item { padding: 5px 13px; border-radius: 16px; font-size: 12px; color: #666; text-decoration: none; white-space: nowrap; transition: background 0.15s; }
    .cp-nav-item:hover { background: #d0d0e8; color: #1a1a2e; }
    .cp-nav-item.active { background: #1a1a2e; color: #e8e8f5; }
    .cp-topbar-right { display: flex; align-items: center; gap: 8px; }
    .cp-top-btn { background: #e0e0ee; border-radius: 20px; padding: 6px 14px; font-size: 12px; color: #555; cursor: pointer; border: none; text-decoration: none; }
    .cp-top-btn:hover { background: #d0d0e8; color: #1a1a2e; }
    .cp-avatar { width: 30px; height: 30px; border-radius: 50%; background: #4b3fa0; color: #e8e8f5; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 500; }
</style>

<style>
@media(max-width:768px){
.cp-nav{flex-direction:column;gap:0;padding:6px}
.cp-nav-item{display:block;width:100%;text-align:center;padding:8px 13px;margin-bottom:2px}
}
</style>

<div class="cp-topbar">
    <span class="cp-brand">ConfPortal</span>
    <div class="cp-nav">
        <a href="{{ route('dashboard') }}" class="cp-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('submit') }}" class="cp-nav-item {{ request()->routeIs('submit') ? 'active' : '' }}">Submit</a>
        <a href="{{ route('abstracts') }}" class="cp-nav-item {{ request()->routeIs('abstracts') ? 'active' : '' }}">Abstracts</a>
        <a href="{{ route('rebuttals') }}" class="cp-nav-item {{ request()->routeIs('rebuttals') ? 'active' : '' }}">Rebuttals</a>
        <a href="{{ route('notifications') }}" class="cp-nav-item {{ request()->routeIs('notifications') ? 'active' : '' }}">Notifications</a>
        <a href="{{ route('downloads') }}" class="cp-nav-item {{ request()->routeIs('downloads') ? 'active' : '' }}">Downloads</a>
    </div>
    <div class="cp-topbar-right">
       
        <div class="cp-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'AU', 0, 2)) }}</div>
    </div>
</div>
