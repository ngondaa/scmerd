:root{
  --crimson:#A41E22;
  --crimson-deep:#7A1418;
  --crimson-tint:#C23A3C;
  --ink:#111111;
  --ink-soft:#5F6368;
  --line:#EAEAEA;
  --paper:#FFFFFF;
  --paper-deep:#FFFFFF;
  --paper-soft:#FFFFFF;
  --brass:#A9812E;
}
*{box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{
  margin:0;background:#FFFFFF;color:var(--ink);
  font-family:'IBM Plex Sans',sans-serif;line-height:1.6;
  -webkit-font-smoothing:antialiased;
}
h1,h2,h3{
  font-family:'Archivo',sans-serif;color:var(--ink);
  margin:0 0 .4em 0;font-weight:800;letter-spacing:-0.015em;line-height:1.05;
}
p{margin:0 0 1em 0;}
a{color:var(--crimson);}
.mono{font-family:'IBM Plex Mono',monospace;}
.wrap{max-width:1120px;margin:0 auto;padding:0 28px;}
.prose{max-width:66ch;}

.announce{background:var(--crimson-deep);color:#fff;padding:20px 0;}
.announce-inner{display:flex;align-items:flex-start;gap:12px;}
.announce .dot{width:11px;height:11px;border-radius:50%;background:var(--crimson-tint);margin-top:6px;flex:none;}
.announce h2{color:#fff;font-size:22px;margin-bottom:4px;}
.announce p{color:#E7B9BA;font-size:15px;margin:0;max-width:60ch;}

header.site{
  position:sticky;top:0;z-index:100;
  background:rgba(255,255,255,0.9);
  backdrop-filter:blur(14px);
  border-bottom:1px solid var(--line);
}
.site-nav{
  display:flex;align-items:center;justify-content:space-between;
  gap:32px;padding:16px 0;
}
.site-nav-logo{
  display:flex;align-items:center;gap:10px;
  text-decoration:none;color:var(--ink);flex-shrink:0;
}
.site-nav-logo-img{height:52px;width:auto;max-width:140px;object-fit:contain;display:block;}
.cp-brand img{height:52px;width:auto;max-width:140px;object-fit:contain;}
/* Auth/header logo sizing fallback for smaller screens */
@media (max-width:720px){
  .site-nav-logo-img{height:44px;max-width:120px}
  .cp-brand img{height:44px;max-width:120px}
}
.site-nav-wordmark{
  font-family:'IBM Plex Sans',sans-serif;
  font-size:14px;font-weight:700;letter-spacing:.04em;
  text-transform:uppercase;color:var(--ink);
}
.site-nav-cluster{
  display:flex;align-items:center;gap:28px;
  margin-left:auto;min-width:0;
}
.nav-links{
  display:flex;align-items:center;gap:22px;
  list-style:none;margin:0;padding:0;
}
.nav-links a{
  color:var(--ink);text-decoration:none;
  font-size:14px;font-weight:400;
  opacity:.72;white-space:nowrap;
  transition:opacity .15s;
}
.nav-links a:hover,.nav-links a.active{opacity:1;}
.nav-right{display:flex;align-items:center;gap:16px;flex-shrink:0;}
.nav-auth{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
.nav-cta{
  display:inline-flex;align-items:center;gap:6px;
  background:var(--ink);color:#fff;
  text-decoration:none;padding:9px 18px;
  font-size:14px;font-weight:500;
  border-radius:999px;white-space:nowrap;
  transition:background .15s, border-color .15s, color .15s;
  border:1px solid var(--ink);
}
.nav-cta:hover{background:#333;color:#fff;}
.nav-cta-light{
  background:#F5F5F3;color:var(--ink);
  border-color:var(--line);
}
.nav-cta-light:hover{background:#EFEFEA;color:var(--ink);}
.nav-toggle{
  display:none;background:none;border:none;
  width:40px;height:40px;padding:0;cursor:pointer;
  flex-direction:column;align-items:center;justify-content:center;gap:6px;
}
.nav-toggle span{
  display:block;width:20px;height:2px;
  background:var(--ink);transition:transform .2s,opacity .2s;
}
.nav-toggle.open span:first-child{transform:translateY(4px) rotate(45deg);}
.nav-toggle.open span:last-child{transform:translateY(-4px) rotate(-45deg);}

.hero h1 .word{display:inline-block;will-change:transform,opacity;}

/* ============================================================
   ADDITIONS — append to the end of your existing central.css
   Fixes: unstyled .awards-grid / .discipline-card / .spec-grid
   Reworks: nav weight, announce bar
   ============================================================ */

/* ---------- Nav: reduce visual weight, condense on scroll ---------- */
header.site{
  background:rgba(255,255,255,0.68);
  backdrop-filter:blur(18px) saturate(160%);
  border-bottom:1px solid rgba(17,17,17,0.06);
  box-shadow:none;
  transition:background .35s ease, box-shadow .35s ease;
}
header.site.is-scrolled{
  background:rgba(255,255,255,0.88);
  box-shadow:0 1px 0 rgba(0,0,0,.04), 0 16px 30px -22px rgba(0,0,0,.18);
}
.site-nav{padding:18px 0;transition:padding .35s ease;}
header.site.is-scrolled .site-nav{padding:11px 0;}

.site-nav-wordmark{font-weight:600;letter-spacing:.05em;opacity:.75;}
.nav-links a{opacity:.55;font-weight:400;}
.nav-links a:hover,.nav-links a.active{opacity:1;}

.nav-cta{
  background:transparent;color:var(--ink);
  border:1px solid rgba(17,17,17,0.16);
  font-weight:500;padding:8px 16px;font-size:13.5px;
  box-shadow:none;
}
.nav-cta:hover{background:var(--ink);color:#fff;border-color:var(--ink);}
.nav-cta-light{background:transparent;border-color:rgba(17,17,17,0.1);}

/* ---------- Announce bar: slim animated status strip ---------- */
.announce{
  padding:13px 0;
  background:linear-gradient(120deg,var(--crimson-deep),var(--crimson) 55%,var(--crimson-deep));
  background-size:220% 220%;
  animation:announceShift 12s ease infinite;
  border-bottom:1px solid rgba(255,255,255,.08);
}
@keyframes announceShift{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
}
.announce-inner{display:flex;align-items:center;gap:14px;flex-wrap:wrap;}
.announce .dot{
  width:8px;height:8px;border-radius:50%;background:#fff;margin:0;flex:none;
  animation:dotPulse 2.4s ease-out infinite;
}
@keyframes dotPulse{
  0%{box-shadow:0 0 0 0 rgba(255,255,255,.5)}
  70%{box-shadow:0 0 0 10px rgba(255,255,255,0)}
  100%{box-shadow:0 0 0 0 rgba(255,255,255,0)}
}
.announce h2{
  color:#fff;font-family:'IBM Plex Mono',monospace;
  font-size:12.5px;font-weight:700;letter-spacing:.08em;
  text-transform:uppercase;margin:0;white-space:nowrap;
}
.announce p{color:rgba(255,255,255,.82);font-size:14px;margin:0;max-width:60ch;}
@media (max-width:720px){.announce-inner{align-items:flex-start;}}

/* ---------- Section background variants used by welcome page ---------- */
.section-light{background:#fff;}
.section-dark{background:#FAFAF8;}
.section-intro{color:var(--ink-soft);font-size:16px;margin-top:-10px;margin-bottom:36px;max-width:58ch;}

/* ---------- Spec grid (Date / Venue / CPD / Deadline) ---------- */
.spec-grid{display:grid;grid-template-columns:repeat(4,1fr);border:1px solid var(--line);}
.spec-item{padding:26px 26px;border-right:1px solid var(--line);}
.spec-item:last-child{border-right:none;}
.spec-label{
  font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.07em;
  text-transform:uppercase;color:var(--ink-soft);margin-bottom:9px;
}
.spec-value{font-size:15.5px;font-weight:600;color:var(--ink);}
@media (max-width:900px){
  .spec-grid{grid-template-columns:repeat(2,1fr);}
  .spec-item{border-bottom:1px solid var(--line);}
  .spec-item:nth-child(2n){border-right:none;}
}

/* ---------- Two-column "about" layout ---------- */
.two-column{display:grid;grid-template-columns:1fr 1fr;gap:56px;}
.feature-list{list-style:none;margin:0;padding:0;}
.feature-list li{
  position:relative;padding:11px 0 11px 20px;
  border-bottom:1px solid var(--line);font-size:14.5px;
}
.feature-list li::before{
  content:'';position:absolute;left:0;top:19px;
  width:7px;height:7px;background:var(--crimson);
}
@media (max-width:900px){.two-column{grid-template-columns:1fr;gap:32px;}}

/* ---------- Disciplines grid ---------- */
.disciplines-grid{
  display:grid;grid-template-columns:repeat(4,1fr);
  gap:1px;background:var(--line);border:1px solid var(--line);
}
.discipline-card{
  background:#fff;padding:26px 20px;font-size:14.5px;font-weight:600;
  display:flex;align-items:center;min-height:88px;
  transition:background .2s ease, color .2s ease;
}
.discipline-card:hover{background:var(--ink);color:#fff;}
@media (max-width:900px){.disciplines-grid{grid-template-columns:repeat(2,1fr);}}

/* ---------- Awards grid ---------- */
.awards-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
.award-item{
  position:relative;border:1px solid var(--line);padding:26px 22px;
  overflow:hidden;
}
.award-item::before{
  content:'';position:absolute;top:0;left:0;width:0;height:2px;
  background:var(--crimson);transition:width .35s ease;
}
.award-item:hover::before{width:100%;}
.award-item h3{font-size:16px;margin-bottom:6px;}
.award-item p{font-size:13.5px;color:var(--ink-soft);margin:0;}
.section-note{margin-top:26px;font-size:13px;color:var(--ink-soft);font-style:italic;}
@media (max-width:900px){.awards-grid{grid-template-columns:repeat(2,1fr);}}
@media (max-width:520px){.awards-grid{grid-template-columns:1fr;}}

/* ---------- Hero word-by-word entrance (targeted by anime.js) ---------- */
.welcome-hero h1 .word{display:inline-block;will-change:transform,opacity;}

.award-mark svg path{stroke-dasharray:1;stroke-dashoffset:0;}

.page-head{padding:64px 0 44px;border-bottom:1px solid var(--line);}
.page-head .kicker{font-family:'IBM Plex Mono',monospace;font-size:12.5px;color:var(--crimson);display:block;margin-bottom:10px;}
.page-head h1{font-size:clamp(32px,4.4vw,48px);max-width:16ch;}
.page-head p{color:var(--ink-soft);font-size:16.5px;max-width:56ch;margin-top:12px;}

.hero{
  position:relative;padding:64px 0 0;
  background:
    linear-gradient(180deg, rgba(255,255,255,0.75), rgba(255,255,255,0.98)),
    url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
}
.hero > .wrap{
  position:relative;z-index:1;
}
.hero h1{font-size:clamp(40px,6.4vw,74px);max-width:18ch;}
.hero .lede{font-size:18px;color:var(--ink-soft);max-width:56ch;margin-top:22px;}

.cta-banner{display:block;text-decoration:none;color:var(--ink);background:var(--paper);transition:box-shadow .15s ease,transform .12s ease;border-top:1px solid var(--line)}
.cta-banner:hover{box-shadow:0 8px 28px rgba(12,24,48,0.06);transform:translateY(-2px)}
.cta-row{display:flex;align-items:center;justify-content:space-between;gap:20px;max-width:1120px;margin:0 auto;padding:22px 28px;}
.cta-row span.label{display:block;font-family:'Archivo',sans-serif;font-weight:800;font-size:19px;color:var(--ink);}
.cta-row span.sub{display:block;font-family:'IBM Plex Sans',sans-serif;font-weight:400;font-size:13.5px;color:var(--ink-soft);margin-top:3px;}
.cta-row .chev{font-size:22px;transition:transform .15s ease;color:var(--ink);flex-shrink:0;line-height:1;}
.cta-banner:hover .chev{transform:translateX(4px);}

section{padding:72px 0;border-bottom:1px solid var(--line);}
section:last-of-type{border-bottom:none;}
.section-head{margin-bottom:36px;}
.section-head .kicker{font-family:'IBM Plex Mono',monospace;font-size:12px;color:var(--crimson);margin-bottom:8px;display:block;}
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:56px;}

.disc-list{list-style:none;margin:0;padding:0;columns:2;column-gap:32px;}
.disc-list li{break-inside:avoid;display:flex;gap:12px;align-items:flex-start;padding:10px 0;border-bottom:1px solid var(--line);font-size:14.5px;}
.disc-list li::before{content:"";width:7px;height:7px;background:var(--crimson);margin-top:6px;flex:none;}

.timeline{position:relative;margin:0;padding:0 0 0 36px;list-style:none;}
.timeline::before{
  content:'';position:absolute;left:6px;top:0;bottom:0;width:2px;
  background:var(--crimson);transform-origin:top;transform:scaleY(0);
}
.timeline.revealed::before{
  transform:scaleY(1);transition:transform .9s cubic-bezier(.2,.9,.2,1);
}
.timeline-year{
  position:relative;margin:0 0 24px -36px;padding-left:36px;
  font-family:'IBM Plex Mono',monospace;font-size:11px;font-weight:600;
  letter-spacing:.08em;text-transform:uppercase;color:var(--crimson);
}
.timeline-year::before{
  content:'';position:absolute;left:6px;top:50%;width:22px;height:2px;
  background:var(--crimson);transform:translateY(-50%);
}
.timeline-item{position:relative;padding:0 0 28px 0;}
.timeline-item:last-child{padding-bottom:0;}
.timeline-marker{
  position:absolute;left:-36px;top:2px;width:14px;height:14px;
  display:flex;align-items:center;justify-content:center;
}
.timeline-dot{
  width:14px;height:14px;border-radius:50%;box-sizing:border-box;
  background:#FAFAF8;border:2.5px solid var(--crimson);
  transform:scale(1);transition:transform .42s cubic-bezier(.2,.9,.2,1);
}
.section-light .timeline-dot{background:#fff;}
.timeline-date{
  font-family:'IBM Plex Mono',monospace;font-size:13px;color:var(--crimson);
  margin-bottom:4px;
}
.timeline-title{
  font-family:'Archivo',sans-serif;font-size:17px;font-weight:700;
  color:var(--ink);margin-bottom:4px;line-height:1.25;
}
.timeline-desc{font-size:14px;color:var(--ink-soft);line-height:1.5;margin:0;}

.award-list{list-style:none;margin:0;padding:0;}
.award-list li{display:grid;grid-template-columns:40px 1fr;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid var(--line);}
.award-mark{width:34px;height:34px;border:1.5px solid var(--crimson);border-radius:50%;display:flex;align-items:center;justify-content:center;}
.award-mark svg{width:15px;height:15px;stroke:var(--crimson);}
.award-list h3{font-size:16px;margin-bottom:3px;font-family:'Archivo',sans-serif;}
.award-list p{font-size:14px;color:var(--ink-soft);margin:0;}

.uni-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:18px;}
.uni-card{
  height:104px;border-radius:6px;display:flex;align-items:center;justify-content:center;
  padding:16px;background:#fff;border:1px solid var(--line);
  text-decoration:none;transition:border-color .15s ease, box-shadow .15s ease;
}
.uni-card:hover{border-color:var(--crimson);box-shadow:0 2px 8px rgba(0,0,0,.06);}
.uni-card img{max-width:100%;max-height:100%;object-fit:contain;}
.uni-note{margin-top:18px;font-size:13.5px;color:var(--ink-soft);font-style:italic;}

.venue-grid{display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:start;}
.venue-list{list-style:none;margin:0;padding:0;}
.venue-list li{display:grid;grid-template-columns:110px 1fr;gap:14px;padding:12px 0;border-bottom:1px solid var(--line);font-size:14.5px;}
.venue-list .k{font-family:'IBM Plex Mono',monospace;font-size:11.5px;color:var(--ink-soft);padding-top:2px;}
.venue-map{border:1px solid var(--line);padding:8px;background:var(--paper-deep);}
.venue-map iframe{width:100%;height:340px;border:none;}

.spec-panel{position:relative;background:var(--paper-deep);border:1px solid var(--line);padding:26px 26px 22px;}
.spec-title{font-family:'IBM Plex Mono',monospace;font-size:11.5px;letter-spacing:.06em;color:var(--crimson);border-bottom:1px solid var(--line);padding-bottom:12px;margin-bottom:16px;}
.spec-row{display:grid;grid-template-columns:88px 1fr;gap:14px;padding:11px 0;border-bottom:1px dashed var(--line);}
.spec-row:last-child{border-bottom:none;}
.spec-label{font-family:'IBM Plex Mono',monospace;font-size:11px;color:var(--ink-soft);padding-top:2px;}
.spec-value{font-size:14.5px;color:var(--ink);}
.spec-value strong{color:var(--ink);}

.gallery-grid{
  display:grid;grid-template-columns:2fr 1fr 1fr;
  grid-template-rows:1fr 1fr;gap:8px;height:520px;
}
.gallery-item{position:relative;overflow:hidden;background:var(--paper-deep);border:1px solid var(--line);}
.gallery-item:first-child{grid-row:span 2;}
.gallery-item img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s ease;}
.gallery-item:hover img{transform:scale(1.04);}
.gallery-label{
  position:absolute;left:0;right:0;bottom:0;padding:14px 16px;
  background:linear-gradient(transparent,rgba(22,22,22,.72));
  font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.06em;
  text-transform:uppercase;color:#fff;
}

/* ---------- Gallery slider (fades between big images) ---------- */
.gallery-slider{position:relative;height:520px;overflow:hidden;border:1px solid var(--line);background:var(--paper);}
.gallery-slider .gallery-grid{display:block;height:100%;}
.gallery-slider .gallery-item{position:absolute;inset:0;opacity:0;transition:opacity .6s ease, transform .6s ease;pointer-events:none}
.gallery-slider .gallery-item:first-child{z-index:1}
.gallery-slider .gallery-item.active{opacity:1;pointer-events:auto;z-index:2}
.gallery-slider .gallery-item img{width:100%;height:100%;object-fit:cover}
.gallery-slider .slider-controls{position:absolute;right:18px;top:18px;display:flex;gap:8px;z-index:4}
.gallery-slider .slider-control{background:rgba(255,255,255,0.9);border-radius:999px;padding:8px 10px;cursor:pointer;border:1px solid rgba(0,0,0,0.06)}
.gallery-slider .slider-dots{position:absolute;left:50%;transform:translateX(-50%);bottom:18px;display:flex;gap:8px;z-index:4}
.gallery-slider .slider-dots button{width:10px;height:10px;border-radius:50%;background:rgba(255,255,255,0.7);border:none;cursor:pointer}
.gallery-slider .slider-dots button.active{background:var(--crimson)}

@media (max-width:900px){.gallery-slider{height:420px}}

/* Pizzazz: subtle reveals and hover polish */
.reveal-init{opacity:0;transform:translateY(18px) scale(0.995);transition:opacity .6s ease, transform .6s cubic-bezier(.2,.9,.2,1);will-change:opacity,transform}
.reveal-init.in-view{opacity:1;transform:none}

.section-head{position:relative}
.section-head::after{content:'';display:block;height:6px;width:56px;background:linear-gradient(90deg,var(--crimson),var(--crimson-tint));border-radius:6px;margin-top:12px;opacity:.95}

.discipline-card, .award-item, .spec-panel, .gallery-item, .uni-card{transition:transform .28s ease, box-shadow .28s ease, border-color .28s ease}
.discipline-card:hover, .award-item:hover, .uni-card:hover{transform:translateY(-8px);box-shadow:0 18px 40px rgba(15,20,30,0.06);border-color:rgba(0,0,0,0.06)}

/* Gallery subtle caption slide */
.gallery-item .gallery-label{transform:translateY(6px);transition:transform .36s ease, opacity .36s ease}
.gallery-item:hover .gallery-label{transform:none;opacity:1}

/* CTA buttons with subtle gradient */
.btn-primary, .btn-register{background:linear-gradient(180deg,var(--crimson),var(--crimson-deep));border-color:var(--crimson-deep);box-shadow:0 8px 22px rgba(164,30,34,0.08)}

/* subtle page-wide faint waves pattern (from Uiverse by romeo_3200) */
.pattern-waves{position:relative;background-clip:padding-box;}
.pattern-waves::before{content:"";position:absolute;inset:0;pointer-events:none;z-index:0;
  background: repeating-radial-gradient(
    circle at 0% 50%,
    rgba(0,0,0,0.04) 0px,
    rgba(0,0,0,0.04) 2px,
    transparent 2px,
    transparent 30px
  );
  opacity:0.06;
}

/* ensure main content stays above the decorative pattern */
header.site, .wrap, footer{position:relative;z-index:1}

.organiser-card{
  display:flex;align-items:center;gap:20px;padding:24px;
  border:1px solid var(--line);background:var(--paper-deep);
}
.organiser-card img{height:56px;width:auto;object-fit:contain;flex:none;}

.btn{display:inline-block;text-decoration:none;font-weight:700;font-size:14.5px;padding:14px 24px;border:1.5px solid var(--ink);cursor:pointer;font-family:'IBM Plex Sans',sans-serif;}
.btn-primary{background:var(--crimson);border-color:var(--crimson);color:#fff;}
.btn-primary:hover{background:var(--crimson-deep);border-color:var(--crimson-deep);color:#fff;}

footer{background:var(--ink);color:#DCDCDC;padding:52px 0 30px;}
footer .foot-grid{display:grid;grid-template-columns:1.3fr 1fr 1fr;gap:40px;margin-bottom:36px;}
footer h4{font-family:'Archivo',sans-serif;color:#fff;font-size:16px;margin:0 0 12px 0;font-weight:800;}
footer p, footer a{color:#B0B0B0;font-size:13.5px;text-decoration:none;line-height:1.7;}
footer a:hover{color:#fff;}
.foot-bottom{border-top:1px solid rgba(255,255,255,0.15);padding-top:20px;display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px;font-size:12.5px;color:#8A8A8A;}

@media (max-width:900px){
  .site-nav{flex-wrap:wrap;}
  .site-nav-cluster{width:100%;justify-content:space-between;}
  .nav-links{
    position:absolute;top:100%;left:0;right:0;
    background:#F9F7F2;flex-direction:column;align-items:stretch;gap:0;
    border-bottom:1px solid var(--line);
    max-height:0;overflow:hidden;transition:max-height .25s ease;z-index:40;
    padding:0 28px;
  }
  .nav-links.open{max-height:480px;padding:8px 28px 16px;}
  .nav-links li{border-top:1px solid var(--line);}
  .nav-links li:first-child{border-top:none;}
  .nav-links a{display:block;padding:14px 0;font-size:15px;opacity:1;}
  .nav-toggle{display:flex;}
  header.site{position:relative;}
  .two-col,.venue-grid{grid-template-columns:1fr;gap:36px;}
  .disc-list{columns:1;}
  footer .foot-grid{grid-template-columns:1fr;gap:28px;}
  .gallery-grid{grid-template-columns:1fr 1fr;grid-template-rows:auto;height:auto;}
  .gallery-item:first-child{grid-row:span 1;}
  .gallery-item,.gallery-item:first-child{height:200px;}
  .organiser-card{flex-direction:column;text-align:center;}
}
