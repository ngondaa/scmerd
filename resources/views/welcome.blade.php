@extends('layouts.central')

@section('title', '2026 Postgraduate Conference & Prize Awards — SAIMechE Central Branch')
@section('description', 'SAIMechE Central Branch Postgraduate Conference on Mechanical Engineering and Related Disciplines. University of the Witwatersrand, Johannesburg.')

@section('content')

<section class="hero">
  <div class="wrap">
    <h1>SAIMechE Central Branch Postgraduate Conference</h1>
    <p class="lede">The Central Branch brings together postgraduate engineers from universities across Gauteng for a day of oral and poster presentations, critical academic exchange, and prize awards at the gala dinner — advancing South Africa's mechanical engineering research community.</p>
  </div>
  @if (Route::has('register'))
  <a href="{{ route('register') }}" class="cta-banner">
    <div class="wrap cta-row">
      <span><span class="label">Register to attend</span><span class="sub">Free for postgraduate students — day session and gala dinner</span></span>
      <span class="chev">&rsaquo;</span>
    </div>
  </a>
  @endif
  <a href="{{ auth()->check() ? route('submit') : (Route::has('login') ? route('login') : '#contact') }}" class="cta-banner">
    <div class="wrap cta-row">
      <span><span class="label">Submit an abstract</span><span class="sub">Closes 25 September 2026 — oral or poster format</span></span>
      <span class="chev">&rsaquo;</span>
    </div>
  </a>
</section>

<section id="details">
  <div class="wrap">
    <span class="section-head kicker">At a glance</span>
    <div class="spec-panel">
      <div class="spec-title">EVENT DETAILS</div>
      <div class="spec-row"><div class="spec-label mono">DATE</div><div class="spec-value"><strong>Friday, 09 October 2026</strong> — starts 09h00</div></div>
      <div class="spec-row"><div class="spec-label mono">VENUE</div><div class="spec-value">Southwest Engineering Building (SWEB), West Campus, University of the Witwatersrand, Braamfontein, Johannesburg</div></div>
      <div class="spec-row"><div class="spec-label mono">EVENING</div><div class="spec-value">Gala dinner &amp; prize awards, 18h00 — venue to be confirmed</div></div>
      <div class="spec-row"><div class="spec-label mono">CPD</div><div class="spec-value">ECSA recognised — 1 CPD credit (validation SAIMechE-1852-10/26)</div></div>
      <div class="spec-row"><div class="spec-label mono">ABSTRACTS</div><div class="spec-value">Close <strong>25 September 2026</strong></div></div>
    </div>
  </div>
</section>

<section id="about">
  <div class="wrap two-col">
    <div class="prose">
      <span class="section-head kicker">About the conference</span>
      <h2>A platform for South Africa's next generation of engineers</h2>
      <p>The SAIMechE Central Branch Postgraduate Conference is the premier annual gathering for postgraduate students, researchers, and industry practitioners across mechanical, industrial, and aeronautical engineering disciplines in South Africa.</p>
      <p>Hosted at the University of the Witwatersrand, the conference provides a rigorous peer-reviewed forum for emerging engineers to present cutting-edge research, receive critical feedback from leading academics, and forge connections with industry partners driving South Africa's engineering future.</p>
      <p>The day runs as a full programme of oral and poster presentations, closing with a gala dinner where the branch's postgraduate prize awards are presented.</p>
    </div>
    <div>
      <span class="section-head kicker">Why attend</span>
      <ul class="disc-list" style="columns:1;">
        <li>Engage directly with leading academics and researchers in your field</li>
        <li>Connect with practising engineers and industry partners</li>
        <li>See emerging technologies and innovation from postgraduate labs across Gauteng</li>
        <li>Meet postgraduate students from every participating university</li>
      </ul>
      <div class="organiser-card" style="margin-top:32px;">
        <img src="{{ asset('unilogos/schoolofMech.png') }}" alt="School of Mechanical, Industrial and Aeronautical Engineering">
        <p style="margin:0;font-size:14px;color:var(--ink-soft);">Organised by the SAIMechE Central Branch and the School of Mechanical, Industrial &amp; Aeronautical Engineering, University of the Witwatersrand.</p>
      </div>
    </div>
  </div>
</section>

<section id="disciplines">
  <div class="wrap">
    <span class="section-head kicker">Conference disciplines</span>
    <h2 style="margin-bottom:28px;">Submissions are welcomed across eight disciplines</h2>
    <ul class="disc-list">
      <li>Mechanical Engineering</li>
      <li>Electro-Mechanical Engineering</li>
      <li>Industrial Engineering</li>
      <li>Biomedical Engineering</li>
      <li>Aeronautical Engineering</li>
      <li>Manufacturing &amp; Materials Engineering</li>
      <li>Mechatronic Engineering</li>
      <li>Energy &amp; Sustainability Technologies</li>
    </ul>
  </div>
</section>

<section id="dates">
  <div class="wrap">
    <span class="section-head kicker">Key dates</span>
    <h2 style="margin-bottom:8px;">Four dates to plan around</h2>
    <p class="prose" style="color:var(--ink-soft);margin-bottom:30px;">Registration is open now. Abstracts are reviewed after the submission deadline, so submit early where possible.</p>
    <ol class="timeline">
      <li><div class="num">01</div><div><div class="t-title">Abstract submissions open</div><div class="t-date">Now</div><div class="t-desc">Use the abstract form — one submission per presenting author.</div></div></li>
      <li><div class="num">02</div><div><div class="t-title">Abstract submission deadline</div><div class="t-date">25 September 2026</div><div class="t-desc">Final date for abstracts to be considered for the programme.</div></div></li>
      <li><div class="num">03</div><div><div class="t-title">Conference day</div><div class="t-date">Friday, 09 October 2026 · 09h00</div><div class="t-desc">SWEB, West Campus, University of the Witwatersrand.</div></div></li>
      <li><div class="num">04</div><div><div class="t-title">Gala dinner &amp; prize awards</div><div class="t-date">09 October 2026 · 18h00</div><div class="t-desc">Evening venue to be confirmed closer to the date.</div></div></li>
    </ol>
  </div>
</section>

<section id="awards">
  <div class="wrap two-col">
    <div>
      <span class="section-head kicker">Postgraduate prize awards</span>
      <h2>Recognising excellence</h2>
      <p class="prose" style="color:var(--ink-soft);">Awards are judged on the day and presented at the gala dinner. Additional categories may be approved by the organising committee.</p>
    </div>
    <ul class="award-list">
      <li><div class="award-mark"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><path d="M8 21h8M12 17v4M7 4h10v4a5 5 0 0 1-10 0V4zM5 6H3v2a4 4 0 0 0 4 4M19 6h2v2a4 4 0 0 1-4 4"/></svg></div><div><h3>Outstanding Research Presentation</h3><p>For the strongest overall presentation on the day.</p></div></li>
      <li><div class="award-mark"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><path d="M4 19V6a2 2 0 0 1 2-2h9l5 5v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M14 4v5h5"/></svg></div><div><h3>Best Student Paper</h3><p>Awarded for the highest quality written submission.</p></div></li>
      <li><div class="award-mark"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><path d="M12 2a5 5 0 0 1 5 5c0 2.5-2 4-2 6h-6c0-2-2-3.5-2-6a5 5 0 0 1 5-5zM10 17h4M9 20h6"/></svg></div><div><h3>Innovation Excellence Award</h3><p>For work with the clearest path to real-world engineering impact.</p></div></li>
      <li><div class="award-mark"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.6"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg></div><div><h3>Emerging Researcher Recognition</h3><p>For a first-time presenter showing strong future potential.</p></div></li>
    </ul>
  </div>
</section>

<section id="gallery">
  <div class="wrap">
    <span class="section-head kicker">Conference moments</span>
    <h2 style="margin-bottom:28px;">Scenes from past sessions, labs &amp; keynotes</h2>
    <div class="gallery-grid">
      <div class="gallery-item">
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
    <p class="uni-note" style="margin-top:24px;">Moments from previous SAIMechE Central Branch postgraduate conferences at Wits University.</p>
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
      <a class="uni-card" href="https://www.up.ac.za/" target="_blank" rel="noopener">
        <img src="{{ asset('unilogos/up.png') }}" alt="University of Pretoria" loading="lazy">
      </a>
      <a class="uni-card" href="https://www.unisa.ac.za/" target="_blank" rel="noopener">
        <img src="{{ asset('unilogos/unisa.png') }}" alt="UNISA — University of South Africa" loading="lazy">
      </a>
      <a class="uni-card" href="https://www.tut.ac.za/" target="_blank" rel="noopener">
        <img src="{{ asset('unilogos/TUT.png') }}" alt="Tshwane University of Technology" loading="lazy">
      </a>
      <a class="uni-card" href="https://vut.ac.za/" target="_blank" rel="noopener">
        <img src="{{ asset('unilogos/Vaal-University-of-Technology.png') }}" alt="Vaal University of Technology" loading="lazy">
      </a>
      <a class="uni-card" href="https://www.dut.ac.za/" target="_blank" rel="noopener">
        <img src="{{ asset('unilogos/dut.png') }}" alt="Durban University of Technology" loading="lazy">
      </a>
      <a class="uni-card" href="https://www.nwu.ac.za/" target="_blank" rel="noopener">
        <img src="{{ asset('unilogos/nwu.png') }}" alt="North-West University" loading="lazy">
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
<script src="https://cdn.jsdelivr.net/npm/animejs/dist/bundles/anime.umd.min.js"></script>
<script>
(function(){
  var hasAnime = typeof anime !== 'undefined';
  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!hasAnime || reduceMotion) return;

  var animate = anime.animate;
  var stagger = anime.stagger;
  var onScroll = anime.onScroll;
  var splitText = anime.splitText;
  var createTimeline = anime.createTimeline;
  var utils = anime.utils;

  utils.$('.nav-cta').forEach(function(btn){
    btn.addEventListener('mouseenter', function(){ animate(btn, { scale: 1.05, duration: 200, ease: 'outQuad' }); });
    btn.addEventListener('mouseleave', function(){ animate(btn, { scale: 1, duration: 200, ease: 'outQuad' }); });
  });

  animate('.announce .dot', {
    scale: [1, 1.7], opacity: [1, 0.35],
    duration: 1400, loop: true, alternate: true, ease: 'inOutSine'
  });

  var heroH1 = utils.$('.hero h1')[0];
  var heroTimeline = createTimeline({ defaults: { ease: 'outQuart' } });
  if (heroH1) {
    var split = splitText(heroH1, { words: true, chars: false });
    heroTimeline.add(split.words, {
      opacity: [0, 1], translateY: [26, 0], duration: 700, delay: stagger(22)
    }, 0);
  }
  heroTimeline
    .add('.hero .lede', { opacity: [0, 1], translateY: [16, 0], duration: 650 }, 300)
    .add('.cta-banner', { opacity: [0, 1], translateX: [-18, 0], duration: 550, delay: stagger(120) }, 500);

  function reveal(selector, overrides, staggerMs){
    utils.$(selector).forEach(function(el, i){
      animate(el, Object.assign({
        opacity: [0, 1], translateY: [26, 0], duration: 650, ease: 'outQuart',
        delay: staggerMs ? i * staggerMs : 0,
        autoplay: onScroll({ target: el, enter: 'bottom-=8% top', repeat: false })
      }, overrides || {}));
    });
  }

  reveal('.spec-panel', { translateY: [34, 0] });
  reveal('.spec-row', {}, 70);
  reveal('#about .prose', { translateX: [-24, 0], translateY: [0, 0] });
  reveal('#about > .wrap > div:last-child', { translateX: [24, 0], translateY: [0, 0] });
  reveal('.disc-list li', { translateY: [18, 0], scale: [0.96, 1] }, 60);
  reveal('.timeline li', { translateX: [-26, 0], translateY: [0, 0] }, 90);
  reveal('.award-list li', { translateY: [22, 0], scale: [0.94, 1] }, 100);
  reveal('.gallery-item', { translateY: [14, 0], scale: [0.94, 1] }, 80);
  reveal('.uni-card', { translateY: [14, 0], scale: [0.9, 1] }, 60);
  reveal('.venue-list li', { translateX: [-16, 0], translateY: [0, 0] }, 60);
  reveal('footer .foot-grid > div', {}, 90);

  var awardPaths = utils.$('.award-mark svg path');
  awardPaths.forEach(function(path){
    var len = Math.ceil(path.getTotalLength());
    path.style.strokeDasharray = len;
    path.style.strokeDashoffset = len;
  });
  if (awardPaths.length) {
    animate(awardPaths, {
      strokeDashoffset: 0, duration: 900, delay: stagger(120), ease: 'inOutQuad',
      autoplay: onScroll({ target: '#awards', enter: 'bottom-=8% top', repeat: false })
    });
  }

  animate('.timeline .num', {
    scale: [1.4, 1], duration: 500, delay: stagger(90), ease: 'outBack',
    autoplay: onScroll({ target: '.timeline', enter: 'bottom-=8% top', repeat: false })
  });
})();
</script>
@endpush
