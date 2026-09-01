<footer id="contact">
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <h4>SAIMechE Central Branch</h4>
        <p>Advancing mechanical, industrial and aeronautical engineering excellence, research and innovation across Gauteng.</p>
        <p>
          <a href="https://www.scmerd.org" target="_blank" rel="noopener">scmerd.org</a><br>
          <a href="https://www.saimeche.org.za" target="_blank" rel="noopener">saimeche.org.za</a>
        </p>
      </div>
      <div>
        <h4>Contact</h4>
        <p>
          SAIMechE Central Branch<br>
          <a href="mailto:info@scmerd.org">info@scmerd.org</a>
        </p>
        <p>
          Conference Chair: Dr Tiyamike Ngonda<br>
          University of the Witwatersrand, Johannesburg
        </p>
        <p>
          Administration: Carey Evans<br>
          Tel: 011 274 6881<br>
          <a href="mailto:carey@saimeche.org.za">carey@saimeche.org.za</a>
        </p>
      </div>
      <div>
        <h4>Quick links</h4>
        <p>
          @if (Route::has('register'))
            <a href="{{ route('register') }}">Register to attend</a><br>
          @endif
          <a href="{{ auth()->check() ? route('submit') : (Route::has('login') ? route('login') : route('home').'#contact') }}">Submit an abstract</a><br>
          <a href="{{ route('home') }}#dates">Key dates</a><br>
          <a href="{{ route('home') }}#awards">Prize awards</a><br>
          <a href="{{ route('home') }}#venue">Venue</a>
        </p>
      </div>
    </div>
    <div class="foot-bottom">
      <span>SAIMechE Central Branch — Postgraduate Conference 2026</span>
      <span>&copy; {{ date('Y') }} SAIMechE Central Branch</span>
    </div>
  </div>
</footer>
