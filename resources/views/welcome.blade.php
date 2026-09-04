@extends('layouts.central')

@section('title', '2026 Postgraduate Conference & Prize Awards — SAIMechE Central Branch')
@section('description', 'SAIMechE Central Branch Postgraduate Conference on Mechanical Engineering and Related Disciplines. University of the Witwatersrand, Johannesburg.')

@section('content')

<!-- Reverted hero: simpler announcement + hero layout -->
<style>
/* Scoped hero overrides for this page (announcement uses global .announce styles) */
.welcome-hero{padding:64px 0 0;}
.welcome-hero .wrap{position:relative;}
.welcome-hero h1{font-family:'Archivo',sans-serif;font-size:clamp(40px,6.4vw,64px);margin:0 0 .6em 0;line-height:.96;}
.welcome-hero .lede{font-size:18px;color:var(--ink-soft);max-width:52ch;margin-top:12px}
.welcome-cta-banners{margin-top:40px;}

@media (max-width: 640px){
  .welcome-hero{padding-top:32px;}
  .welcome-hero h1{
    font-size:clamp(34px, 12vw, 52px);
    line-height:0.92;
    max-width:10ch;
    letter-spacing:-0.04em;
  }
  .welcome-hero .lede{
    font-size:16px;
    line-height:1.6;
    margin-top:16px;
  }
  .welcome-cta-banners{margin-top:24px;}
  .cta-row{padding:18px 16px;}
}
</style>

@section('announce')
<div class="announce">
  <div class="wrap announce-inner">
    <span class="dot"></span>
    <div>
      <h2>Abstracts open now</h2>
      <p>Submit by 25 September 2026</p>
    </div>
  </div>
</div>
@endsection

<section class="hero welcome-hero">
  <div class="wrap">
    <h1>Welcome to the SAIMechE Central Branch Postgraduate Conference</h1>
    <p class="lede">This year's conference brings together postgraduate engineers from eight universities across Gauteng, presenting original research in mechanical, industrial and aeronautical engineering before a night of prizes at the gala dinner. Here's what you need to know.</p>
  </div>
  <div class="welcome-cta-banners">
    @if (Route::has('register'))
      <a href="{{ route('register') }}" class="cta-banner cta-banner--register">
        <div class="cta-row">
          <div>
            <span class="label">Register to attend</span>
             </div>
          <span class="chev" aria-hidden="true">›</span>
        </div>
      </a>
    @endif
    <a href="{{ auth()->check() && auth()->user()?->registration_paid_at ? route('submit') : (Route::has('login') ? route('login') : '#contact') }}" class="cta-banner cta-banner--abstract">
      <div class="cta-row">
        <div>
          <span class="label">Submit an abstract</span>
          </div>
        <span class="chev" aria-hidden="true">›</span>
      </div>
    </a>
  </div>
</section>





<section id="disciplines" class="section-light">
  <div class="wrap">
    <h2>Conference disciplines</h2>
    <p class="section-intro">Submissions welcomed across eight engineering disciplines</p>
    <div class="disciplines-grid">
      <div class="discipline-card">Mechanical Engineering</div>
      <div class="discipline-card">Electro-Mechanical Engineering</div>
      <div class="discipline-card">Industrial Engineering</div>
      <div class="discipline-card">Biomedical Engineering</div>
      <div class="discipline-card">Aeronautical Engineering</div>
      <div class="discipline-card">Manufacturing & Materials</div>
      <div class="discipline-card">Mechatronic Engineering</div>
      <div class="discipline-card">Energy & Sustainability</div>
    </div>
  </div>
</section>

<section id="dates" class="section-dark">
  <div class="wrap">
    <h2>Important dates</h2>
    <p class="section-intro">Key milestones to plan around</p>
    <div class="timeline">
      <div class="timeline-year">This year — 2026</div>
      <div class="timeline-item">
        <div class="timeline-marker">
          <div class="timeline-dot"></div>
        </div>
        <div class="timeline-content">
          <div class="timeline-date">Now</div>
          <div class="timeline-title">Abstract submissions open</div>
          <div class="timeline-desc">Use the submission form — one per presenting author</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-marker">
          <div class="timeline-dot"></div>
        </div>
        <div class="timeline-content">
          <div class="timeline-date">25 September 2026</div>
          <div class="timeline-title">Abstract submission deadline</div>
          <div class="timeline-desc">Final date for abstracts to be considered for the programme</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-marker">
          <div class="timeline-dot"></div>
        </div>
        <div class="timeline-content">
          <div class="timeline-date">09 October 2026 · 09h00</div>
          <div class="timeline-title">Conference day</div>
          <div class="timeline-desc">SWEB, West Campus, University of the Witwatersrand</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-marker">
          <div class="timeline-dot"></div>
        </div>
        <div class="timeline-content">
          <div class="timeline-date">09 October 2026 · 18h00</div>
          <div class="timeline-title">Gala dinner & prize awards</div>
          <div class="timeline-desc">Evening venue to be confirmed closer to the date</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="awards" class="section-light">
  <div class="wrap">
    <h2>Prize awards</h2>
    <p class="section-intro">Recognising excellence across multiple categories</p>
    <div class="awards-grid">
      <div class="award-item">
        <h3>Outstanding Research Presentation</h3>
        <p>For the strongest overall presentation on the day</p>
      </div>
      <div class="award-item">
        <h3>Best Student Paper</h3>
        <p>Awarded for the highest quality written submission</p>
      </div>
      <div class="award-item">
        <h3>Innovation Excellence Award</h3>
        <p>For work with the clearest path to real-world impact</p>
      </div>
      <div class="award-item">
        <h3>Emerging Researcher Recognition</h3>
        <p>For first-time presenters showing strong future potential</p>
      </div>
    
</section>

<section id="gallery">
  <div class="wrap">
    <span class="section-head kicker">Conference moments</span>
    <h2 style="margin-bottom:28px;">Scenes from past sessions, labs &amp; keynotes</h2>
    <div class="gallery-slider">
      <div class="gallery-grid">
        <div class="gallery-item active">
          <img src="{{ asset('images/3.jpeg') }}" alt="Keynote presentation">
          <span class="gallery-label">Keynote presentation</span>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/4.jpeg') }}" alt="Research presentations">
          <span class="gallery-label">Research presentations</span>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/5.jpeg') }}" alt="Wits campus">
          <span class="gallery-label">Wits campus</span>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/6.jpeg') }}" alt="Award ceremony">
          <span class="gallery-label">Award ceremony</span>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/7.jpeg') }}" alt="Panel discussion">
          <span class="gallery-label">Panel discussion</span>
        </div>
      </div>
      <div class="slider-controls" aria-hidden="true">
        <button class="slider-control prev" aria-label="Previous">‹</button>
        <button class="slider-control next" aria-label="Next">›</button>
      </div>
      <div class="slider-dots" aria-hidden="false"></div>
    </div>
    </div>
</section>

<section id="universities">
  <div class="wrap">
    <span class="section-head kicker">Partner universities</span>
    <h2 style="margin-bottom:24px;">Drawing postgraduates from across Gauteng</h2>
    <div class="uni-grid">
      <a class="uni-card" href="https://www.uj.ac.za/" target="_blank" rel="noopener">
        <img src="{{ asset('unilogos/uj.png') }}" alt="University of Johannesburg" loading="lazy">
      </a>
     
      <a class="uni-card" href="https://www.unisa.ac.za/" target="_blank" rel="noopener">
        <img src="{{ asset('unilogos/unisa.png') }}" alt="UNISA — University of South Africa" loading="lazy">
      </a>
      
      
      <a class="uni-card" href="https://www.wits.ac.za/" target="_blank" rel="noopener">
        <img src="{{ asset('unilogos/wits-logo.png') }}" alt="University of the Witwatersrand" loading="lazy">
      </a>
    </div>
    <p class="uni-note">…and other academic and research institutions.</p>
  </div>
</section>

<section id="venue">
  <div class="wrap venue-grid">
    <div>
      <span class="section-head kicker">Venue</span>
      <h2>Getting there</h2>
      <ul class="venue-list">
        <li><div class="k mono">BUILDING</div><div>Southwest Engineering Building (SWEB)</div></li>
        <li><div class="k mono">CAMPUS</div><div>West Campus, University of the Witwatersrand</div></li>
        <li><div class="k mono">ADDRESS</div><div>1 Jan Smuts Avenue, Braamfontein, Johannesburg, 2000</div></li>
        <li><div class="k mono">START</div><div>09h00, Friday 09 October 2026</div></li>
        <li><div class="k mono">EVENING</div><div>Gala dinner venue to be confirmed</div></li>
      </ul>
    </div>
    <div>
      <span class="section-head kicker">Location</span>
      <div class="venue-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3580.1522852615117!2d28.029332999999998!3d-26.191723999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjbCsDExJzMwLjIiUyAyOMKwMDEnNDUuNiJF!5e0!3m2!1sen!2smw!4v1747369293879!5m2!1sen!2smw"
          allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          title="Southwest Engineering Building, Wits University">
        </iframe>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js"></script>
<script>
(function(){
  var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Nav: condense on scroll ---------- */
  var header = document.querySelector('header.site');
  if (header) {
    var onScroll = function(){
      header.classList.toggle('is-scrolled', window.scrollY > 12);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---------- Hero: split headline into words for entrance ---------- */
  var heroH1 = document.querySelector('.welcome-hero h1');
  if (heroH1 && !prefersReduced) {
    var words = heroH1.textContent.trim().split(/\s+/);
    heroH1.innerHTML = words.map(function (w) { return '<span class="word">' + w + '</span>'; }).join(' ');
  }

  /* ---------- Reduced motion / no anime.js: just reveal everything ---------- */
  var tm = document.querySelector('.timeline');
  if (prefersReduced || typeof anime === 'undefined') {
    document.querySelectorAll('.reveal-init').forEach(function (e) { e.style.opacity = 1; e.style.transform = 'none'; });
    if (tm) tm.classList.add('revealed');
    return;
  }

  /* ---------- Hero entrance ---------- */
  anime({
    targets: '.welcome-hero h1 .word',
    translateY: [26, 0],
    opacity: [0, 1],
    easing: 'easeOutExpo',
    duration: 900,
    delay: anime.stagger(55)
  });
  anime({
    targets: '.welcome-hero .lede, .welcome-hero .welcome-cta-banners',
    translateY: [16, 0],
    opacity: [0, 1],
    easing: 'easeOutExpo',
    duration: 800,
    delay: anime.stagger(120, { start: 350 })
  });

  /* ---------- Scroll-triggered reveals, grouped by parent for stagger ---------- */
  var revealSelectors = [
    '.section-head', '.disciplines-grid .discipline-card', '.gallery-item',
    '.timeline-item', '.awards-grid .award-item', '.uni-card', '.spec-grid .spec-item'
  ].join(',');
  var els = Array.prototype.slice.call(document.querySelectorAll(revealSelectors))
    .filter(function (e) { return !e.closest('.gallery-slider'); });
  if (els.length) {
    els.forEach(function (e) { e.style.opacity = 0; });

    var animated = new WeakSet();
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (ent) {
        if (!ent.isIntersecting || animated.has(ent.target)) return;

        var parent = ent.target.parentElement;
        var group = parent
          ? els.filter(function (e) { return e.parentElement === parent; })
          : [ent.target];

        group.forEach(function (e) { animated.add(e); });

        anime({
          targets: group,
          translateY: [22, 0],
          opacity: [0, 1],
          easing: 'easeOutExpo',
          duration: 700,
          delay: anime.stagger(70)
        });

        io.unobserve(ent.target);
      });
    }, { threshold: 0.15 });

    els.forEach(function (e) { io.observe(e); });
  }

  /* ---------- Timeline: draw line, pop dots in sequence ---------- */
  if (tm) {
    var first = tm.querySelector('.timeline-item');
    if (first) {
      var ioLine = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (!en.isIntersecting) return;
          tm.classList.add('revealed');
          anime({
            targets: tm.querySelectorAll('.timeline-dot'),
            scale: [0, 1],
            easing: 'easeOutBack',
            duration: 500,
            delay: anime.stagger(140)
          });
          ioLine.disconnect();
        });
      }, { threshold: 0.08 });
      ioLine.observe(first);
    }
  }

  /* ---------- Gallery touch affordance ---------- */
  document.querySelectorAll('.gallery-item img').forEach(function (img) {
    img.addEventListener('touchstart', function () { img.style.transform = 'scale(1.02)'; }, { passive: true });
    img.addEventListener('touchend', function () { img.style.transform = ''; }, { passive: true });
  });

  /* ---------- Gallery slider: autoplay fade with controls ---------- */
  (function(){
    var slider = document.querySelector('.gallery-slider');
    if (!slider) return;
    var slides = Array.prototype.slice.call(slider.querySelectorAll('.gallery-item'));
    if (!slides.length) return;
    // init
    slides.forEach(function(s,i){ s.classList.remove('active'); });
    slides[0].classList.add('active');

    var dots = slider.querySelector('.slider-dots');
    slides.forEach(function(_,i){ var b = document.createElement('button'); if(i===0) b.classList.add('active'); b.addEventListener('click', function(){ goTo(i); }); dots.appendChild(b); });

    var prev = slider.querySelector('.slider-control.prev');
    var next = slider.querySelector('.slider-control.next');
    var current = 0;

    var mm = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var autoplay = !mm;
    var interval = 4500, timer = null;

    function startTimer(){ if (mm) return; clearTimer(); timer = setInterval(function(){ if (autoplay) goTo(current+1); }, interval); }
    function clearTimer(){ if (timer) { clearInterval(timer); timer = null; } }
    function resetTimer(){ autoplay = true; clearTimer(); startTimer(); }

    function goTo(idx){ var to = (idx + slides.length) % slides.length; if (to === current) return; slides[current].classList.remove('active'); if (dots && dots.children[current]) dots.children[current].classList.remove('active'); slides[to].classList.add('active'); if (dots && dots.children[to]) dots.children[to].classList.add('active'); current = to; }

    prev && prev.addEventListener('click', function(){ goTo(current-1); resetTimer(); });
    next && next.addEventListener('click', function(){ goTo(current+1); resetTimer(); });

    // pause on hover for pointer devices
    slider.addEventListener('mouseenter', function(){ if (!mm) autoplay = false; });
    slider.addEventListener('mouseleave', function(){ if (!mm) autoplay = true; });

    // touch / swipe support
    (function(){
      var startX = 0, startY = 0, deltaX = 0, tracking = false, moved = false;
      var threshold = 40; // px required to trigger swipe

      slider.addEventListener('touchstart', function(e){
        if (!e.touches || e.touches.length > 1) return;
        startX = e.touches[0].clientX; startY = e.touches[0].clientY; deltaX = 0; tracking = true; moved = false; autoplay = false;
      }, { passive: true });

      slider.addEventListener('touchmove', function(e){
        if (!tracking || !e.touches || e.touches.length > 1) return;
        var x = e.touches[0].clientX, y = e.touches[0].clientY;
        deltaX = x - startX; var deltaY = y - startY;
        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 8) {
          // horizontal intent, prevent vertical scroll only when moving noticeably horizontally
          e.preventDefault(); moved = true;
        }
      }, { passive: false });

      slider.addEventListener('touchend', function(e){
        tracking = false; if (!moved) { autoplay = true; resetTimer(); return; }
        if (Math.abs(deltaX) > threshold) {
          if (deltaX < 0) goTo(current+1); else goTo(current-1);
        }
        // restore autoplay after a short delay
        setTimeout(function(){ autoplay = true; resetTimer(); }, 350);
      });
    })();

    // start autoplay timer if allowed
    startTimer();
  })();
})();
</script>
@endpush
