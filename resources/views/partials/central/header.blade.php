<header class="site">
  <div class="wrap">
    <nav class="site-nav">
      <a href="{{ route('home') }}" class="site-nav-logo">
        <img class="site-nav-logo-img" src="{{ asset('images/logo.png') }}" alt="">
        <span class="site-nav-wordmark">SAIMechE Central</span>
      </a>

      <div class="site-nav-cluster">
        <ul class="nav-links" id="navLinks">
          <li><a href="{{ route('home') }}#about">About</a></li>
          <li><a href="{{ route('home') }}#disciplines">Disciplines</a></li>
          <li><a href="{{ route('home') }}#dates">Key dates</a></li>
          <li><a href="{{ route('home') }}#awards">Prize awards</a></li>
          <li><a href="{{ route('home') }}#gallery">Gallery</a></li>
          <li><a href="{{ route('home') }}#universities">Partners</a></li>
          <li><a href="{{ route('home') }}#contact">Contact</a></li>
        </ul>

        <div class="nav-right">
          @auth
            <a href="{{ route('dashboard') }}" class="nav-cta">Dashboard</a>
          @else
            <div class="nav-auth">
              @if (Route::has('login'))
                <a href="{{ route('login') }}" class="nav-cta nav-cta-light">Log in</a>
              @endif
              @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-cta">Register</a>
              @endif
            </div>
          @endauth
          <button class="nav-toggle" id="navToggle" type="button" aria-label="Toggle menu" aria-expanded="false">
            <span></span><span></span>
          </button>
        </div>
      </div>
    </nav>
  </div>
</header>
