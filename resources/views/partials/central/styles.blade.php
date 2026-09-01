:root{
  --crimson:#A41E22;
  --crimson-deep:#7A1418;
  --crimson-tint:#C23A3C;
  --ink:#161616;
  --ink-soft:#666666;
  --line:#E2E2E2;
  --paper:#FFFFFF;
  --paper-deep:#F4F4F4;
  --brass:#A9812E;
}
*{box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{
  margin:0;background:#F9F7F2;color:var(--ink);
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
  background:#F9F7F2;
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
.site-nav-logo-img{width:28px;height:28px;object-fit:contain;}
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
  background:transparent;color:var(--ink);
  border-color:var(--line);
}
.nav-cta-light:hover{background:var(--paper-deep);color:var(--ink);}
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
.award-mark svg path{stroke-dasharray:1;stroke-dashoffset:0;}

.page-head{padding:64px 0 44px;border-bottom:1px solid var(--line);}
.page-head .kicker{font-family:'IBM Plex Mono',monospace;font-size:12.5px;color:var(--crimson);display:block;margin-bottom:10px;}
.page-head h1{font-size:clamp(32px,4.4vw,48px);max-width:16ch;}
.page-head p{color:var(--ink-soft);font-size:16.5px;max-width:56ch;margin-top:12px;}

.hero{padding:64px 0 0;}
.hero h1{font-size:clamp(40px,6.4vw,74px);max-width:18ch;}
.hero .lede{font-size:18px;color:var(--ink-soft);max-width:56ch;margin-top:22px;}

.cta-banner{display:block;text-decoration:none;background:var(--ink);color:#fff;border-top:1px solid rgba(255,255,255,.15);}
.cta-banner:first-of-type{border-top:1px solid var(--line);margin-top:40px;}
.cta-row{display:flex;align-items:center;justify-content:space-between;padding:26px 0;}
.cta-row span.label{font-family:'Archivo',sans-serif;font-weight:800;font-size:19px;color:#fff;}
.cta-row span.sub{display:block;font-family:'IBM Plex Sans',sans-serif;font-weight:400;font-size:13.5px;color:#B9B9B9;margin-top:3px;}
.cta-row .chev{font-size:22px;transition:transform .15s ease;color:#fff;}
.cta-banner:hover .chev{transform:translateX(4px);}
.cta-banner:hover{background:var(--crimson-deep);}

section{padding:72px 0;border-bottom:1px solid var(--line);}
section:last-of-type{border-bottom:none;}
.section-head{margin-bottom:36px;}
.section-head .kicker{font-family:'IBM Plex Mono',monospace;font-size:12px;color:var(--crimson);margin-bottom:8px;display:block;}
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:56px;}

.disc-list{list-style:none;margin:0;padding:0;columns:2;column-gap:32px;}
.disc-list li{break-inside:avoid;display:flex;gap:12px;align-items:flex-start;padding:10px 0;border-bottom:1px solid var(--line);font-size:14.5px;}
.disc-list li::before{content:"";width:7px;height:7px;background:var(--crimson);margin-top:6px;flex:none;}

.timeline{list-style:none;margin:0;padding:0;}
.timeline li{display:grid;grid-template-columns:52px 1fr;gap:20px;padding:20px 0;border-bottom:1px solid var(--line);}
.timeline li:first-child{padding-top:0;}
.timeline .num{font-family:'IBM Plex Mono',monospace;color:var(--crimson);font-size:14px;padding-top:2px;}
.timeline .t-title{font-size:17px;color:var(--ink);font-weight:700;margin-bottom:3px;font-family:'Archivo',sans-serif;}
.timeline .t-date{font-family:'IBM Plex Mono',monospace;font-size:13px;color:var(--crimson);margin-bottom:4px;}
.timeline .t-desc{font-size:14px;color:var(--ink-soft);}

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
