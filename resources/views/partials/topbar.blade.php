<header class="cp-header">
    <div class="cp-header-inner">
        <a href="{{ route('dashboard') }}" class="cp-brand">
            <img src="{{ asset('images/logo.png') }}" alt="">
            <span class="cp-brand-wordmark">SAIMechE Central</span>
        </a>

        <div class="cp-nav-cluster">
            <nav class="cp-nav" id="cpNavLinks" aria-label="Portal navigation">
                <a href="{{ route('dashboard') }}" class="cp-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('submit') }}" class="cp-nav-item {{ request()->routeIs('submit') ? 'active' : '' }}">Submit</a>
                <a href="{{ route('abstracts') }}" class="cp-nav-item {{ request()->routeIs('abstracts') ? 'active' : '' }}">Abstracts</a>
                <a href="{{ route('rebuttals') }}" class="cp-nav-item {{ request()->routeIs('rebuttals') ? 'active' : '' }}">Rebuttals</a>
                <a href="{{ route('notifications') }}" class="cp-nav-item {{ request()->routeIs('notifications') ? 'active' : '' }}">Notifications</a>
                <a href="{{ route('downloads') }}" class="cp-nav-item {{ request()->routeIs('downloads') ? 'active' : '' }}">Downloads</a>
            </nav>

            <div class="cp-nav-actions">
                <a href="{{ route('home') }}" class="cp-nav-secondary">Conference site</a>
                <a href="{{ route('submit') }}" class="cp-nav-cta">Submit abstract</a>
                <button class="cp-nav-toggle" id="cpNavToggle" type="button" aria-label="Toggle menu" aria-expanded="false">
                    <span></span><span></span>
                </button>
            </div>
        </div>
    </div>
</header>
