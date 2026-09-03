<header class="cp-header">
    <div class="cp-header-inner">
        <a href="{{ route('dashboard') }}" class="cp-brand" aria-label="Dashboard">
            <img src="{{ asset('images/logo.png') }}" alt="SAIMechE" class="site-nav-logo-img">
        </a>

        <div class="cp-nav-cluster">
            <nav class="cp-nav" id="cpNavLinks" aria-label="Portal navigation">
                <a href="{{ route('dashboard') }}" class="cp-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                @if (auth()->user()?->registration_paid_at)
                    <a href="{{ route('submit') }}" class="cp-nav-item {{ request()->routeIs('submit') ? 'active' : '' }}">Submit</a>
                    <a href="{{ route('abstracts') }}" class="cp-nav-item {{ request()->routeIs('abstracts') ? 'active' : '' }}">Abstracts</a>
                    <a href="{{ route('rebuttals') }}" class="cp-nav-item {{ request()->routeIs('rebuttals') ? 'active' : '' }}">Rebuttals</a>
                    <a href="{{ route('notifications') }}" class="cp-nav-item {{ request()->routeIs('notifications') ? 'active' : '' }}">Notifications</a>
                    <a href="{{ route('downloads') }}" class="cp-nav-item {{ request()->routeIs('downloads') ? 'active' : '' }}">Downloads</a>
                @endif

                @if (auth()->user()?->is_reviewer)
                    <a href="{{ route('reviewer.dashboard') }}" class="cp-nav-item {{ request()->routeIs('reviewer.dashboard') ? 'active' : '' }}">Reviewer Board</a>
                @endif
            </nav>

            <div class="cp-nav-actions">
                <form method="POST" action="{{ route('logout') }}" class="cp-nav-logout">
                    @csrf
                    <button type="submit" class="cp-nav-secondary cp-nav-logout-button">Log out</button>
                </form>
                <button class="cp-nav-toggle" id="cpNavToggle" type="button" aria-label="Toggle menu" aria-expanded="false">
                    <span></span><span></span>
                </button>
            </div>
        </div>
    </div>
</header>
