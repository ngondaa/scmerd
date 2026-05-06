<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2026 SAIMechE Central Branch Postgraduate Conference</title>
    <meta name="description"
        content="2026 SAIMechE Central Branch Postgraduate Conference on Mechanical Engineering and Related Disciplines. University of the Witwatersrand, Johannesburg.">

    <link rel="preconnect" href="https://api.fontshare.com">
    <link href="https://api.fontshare.com/css?f[]=clash-display@400,500,600,700&f[]=satoshi@300,400,500,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy:    #001A2D;
            --navy-2:  #05192b;
            --teal:    #70ABAF;
            --orange:  #F86624;
            --purple:  #6B58E1;
            --cream:   #FFF3E3;
            --cream-2: #FFF9F1;
            --white:   #ffffff;
            /* i-lab inspired accent — a crisp near-white rule colour */
            --rule:    rgba(112,171,175,.18);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            background: var(--navy-2);
            color: var(--cream);
            font-family: 'Satoshi', sans-serif;
            font-size: 18px;
            line-height: 1.5;
            overflow-x: hidden;
        }

        /* ── NAV ── */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background: rgba(5,25,43,.96);
            border-bottom: 1px solid var(--rule);
        }
        .nav-inner {
            max-width: 1200px; margin: 0 auto;
            padding: 14px 40px;
            display: flex; align-items: center; justify-content: space-between; gap: 24px;
        }
        .nav-brand { text-decoration: none; display: flex; flex-direction: column; line-height: 1.2; }
        .nav-brand-name { font-family: 'Clash Display', sans-serif; font-weight: 700; font-size: 1.15rem; color: var(--cream); letter-spacing: -.5px; }
        .nav-brand-sub  { font-size: .72rem; color: var(--teal); font-weight: 500; letter-spacing: .04em; text-transform: uppercase; }
        .nav-links { display: flex; align-items: center; gap: 32px; list-style: none; }
        .nav-links a { color: rgba(255,243,227,.7); text-decoration: none; font-size: .85rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; transition: color .2s; }
        .nav-links a:hover { color: var(--cream); }
        .btn-nav {
            background: transparent;
            border: 1px solid rgba(107,88,225,.7);
            color: var(--cream) !important;
            padding: 7px 20px;
            border-radius: 4px;
            font-weight: 700 !important;
            font-size: .78rem !important;
            letter-spacing: .06em;
            text-transform: uppercase;
            transition: background .2s, border-color .2s !important;
        }
        .btn-nav:hover { background: rgba(107,88,225,.2) !important; border-color: var(--purple) !important; }
        .nav-auth-actions { display: flex; gap: 8px; align-items: center; }

        /* ── HERO ── */
        #hero {
            min-height: 100vh;
            display: flex; flex-direction: column; justify-content: flex-end;
            padding: 0 0 80px;
            position: relative; overflow: hidden;
            background: var(--navy);
        }
        /* Large typographic background number — i-lab style */
        .hero-bg-num {
            position: absolute;
            right: -40px; bottom: -80px;
            font-family: 'Clash Display', sans-serif;
            font-size: clamp(260px, 30vw, 420px);
            font-weight: 700;
            color: rgba(112,171,175,.04);
            line-height: 1;
            user-select: none; pointer-events: none;
            letter-spacing: -10px;
        }
        .hero-grid {
            position: relative; z-index: 1;
            max-width: 1200px; margin: 0 auto; width: 100%;
            padding: 0 40px;
        }
        .hero-eyebrow {
            font-size: .78rem; font-weight: 700; letter-spacing: .16em;
            text-transform: uppercase; color: var(--teal);
            margin-bottom: 28px; display: block;
        }
        .hero-title {
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: clamp(2.8rem, 6vw, 5.2rem);
            line-height: 1.0;
            color: var(--cream);
            letter-spacing: -.02em;
            max-width: 900px;
            margin-bottom: 36px;
        }
        /* Horizontal rule divider — i-lab signature */
        .hero-rule {
            width: 100%;
            border: none;
            border-top: 1px solid var(--rule);
            margin: 40px 0;
        }
        .hero-bottom-row {
            display: flex; align-items: flex-end; justify-content: space-between; gap: 40px;
        }
        .hero-meta {
            display: flex; gap: 48px;
        }
        .hero-meta-item {}
        .hero-meta-label { font-size: .7rem; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,243,227,.4); margin-bottom: 4px; }
        .hero-meta-value { font-family: 'Clash Display', sans-serif; font-size: 1rem; font-weight: 600; color: var(--cream); }
        .hero-cta-group { display: flex; gap: 12px; align-items: center; flex-shrink: 0; }
        .btn-hero-primary {
            display: inline-block;
            background: var(--orange);
            color: var(--navy);
            font-family: 'Satoshi', sans-serif; font-weight: 700;
            font-size: .85rem; letter-spacing: .06em; text-transform: uppercase;
            padding: 14px 32px; border-radius: 4px;
            text-decoration: none; transition: background .2s;
        }
        .btn-hero-primary:hover { background: #e55a1a; color: var(--navy); }
        .btn-hero-ghost {
            display: inline-block;
            background: transparent;
            border: 1px solid rgba(255,243,227,.25);
            color: var(--cream);
            font-family: 'Satoshi', sans-serif; font-weight: 700;
            font-size: .85rem; letter-spacing: .06em; text-transform: uppercase;
            padding: 14px 32px; border-radius: 4px;
            text-decoration: none; transition: border-color .2s, background .2s;
        }
        .btn-hero-ghost:hover { border-color: rgba(255,243,227,.55); background: rgba(255,243,227,.05); }

        /* ── MARQUEE ── */
        .marquee-wrap { overflow: hidden; }
        .marquee-track { display: flex; width: max-content; animation: marquee-slide 35s linear infinite; }
        .marquee-wrap:hover .marquee-track { animation-play-state: paused; }
        .marquee-item {
            display: flex; align-items: center; gap: 64px;
            padding: 18px 64px 18px;
            white-space: nowrap;
            font-family: 'Clash Display', sans-serif; font-weight: 500; font-size: 1rem;
        }
        .marquee-sep { opacity: .4; }
        .marquee-purple { background: var(--purple); }
        .marquee-teal   { background: var(--teal); color: var(--navy); }
        .marquee-orange { background: var(--orange); color: #fff; }
        @keyframes marquee-slide { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

        /* ── SECTION COMMONS ── */
        section { padding: 100px 40px; }
        .section-inner { max-width: 1200px; margin: 0 auto; }

        /* ── ABOUT — i-lab style: full-text, no image, bold type, stark layout ── */
        #about { background: var(--navy); padding: 120px 40px; }

        .about-top {
            display: flex; align-items: baseline; justify-content: space-between;
            gap: 40px;
            padding-bottom: 48px;
            border-bottom: 1px solid var(--rule);
            margin-bottom: 72px;
        }
        .about-eyebrow {
            font-size: .72rem; font-weight: 700; letter-spacing: .16em;
            text-transform: uppercase; color: var(--teal);
        }
        .about-year {
            font-family: 'Clash Display', sans-serif;
            font-size: .85rem; font-weight: 600;
            color: rgba(255,243,227,.3);
            letter-spacing: .06em;
        }

        /* Giant statement heading — i-lab signature move */
        .about-statement {
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: clamp(2.2rem, 4.5vw, 4rem);
            line-height: 1.08;
            letter-spacing: -.02em;
            color: var(--cream);
            max-width: 900px;
            margin-bottom: 72px;
        }
        .about-statement em {
            font-style: normal;
            color: var(--teal);
        }

        /* Two-column body grid */
        .about-body-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            padding-top: 0;
            border-top: none;
        }

        .about-body-left {}

        .about-body-para {
            font-size: 1rem;
            line-height: 1.85;
            color: rgba(255,243,227,.68);
            margin-bottom: 24px;
        }

        /* i-lab style blockquote: flush left, giant leading mark */
        .about-quote {
            margin-top: 8px;
        }
        .about-quote-mark {
            font-family: 'Clash Display', sans-serif;
            font-size: 4rem;
            line-height: .6;
            color: var(--orange);
            margin-bottom: 16px;
            display: block;
        }
        .about-quote p {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.25rem;
            font-weight: 500;
            color: var(--cream);
            line-height: 1.45;
            margin-bottom: 16px;
        }
        .about-quote cite {
            font-size: .75rem; color: var(--teal); font-style: normal;
            font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        }

        /* Right column: stat pillars — i-lab style vertical list */
        .about-body-right {}

        .about-stats-list {
            list-style: none;
            display: flex; flex-direction: column;
        }
        .about-stat-row {
            display: flex; align-items: baseline; gap: 20px;
            padding: 28px 0;
            border-bottom: 1px solid var(--rule);
        }
        .about-stat-row:first-child { border-top: 1px solid var(--rule); }
        .about-stat-num {
            font-family: 'Clash Display', sans-serif;
            font-size: 2.4rem; font-weight: 700;
            color: var(--cream); line-height: 1;
            min-width: 110px; flex-shrink: 0;
        }
        .about-stat-desc {
            font-size: .88rem; color: rgba(255,243,227,.55);
            line-height: 1.5;
        }
        .about-stat-desc strong { color: var(--cream); font-weight: 600; display: block; margin-bottom: 2px; }

        /* ── THEMES ── */
        #themes { background: var(--cream); padding: 100px 40px; }
        #themes .section-tag { font-size: .72rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase; color: #2c5b5f; margin-bottom: 48px; display: block; }
        #themes .section-heading { color: var(--navy); font-family: 'Clash Display', sans-serif; font-weight: 700; font-size: clamp(1.6rem,3vw,2.6rem); margin-bottom: 48px; }

        .themes-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: rgba(0,26,45,.12); border: 1px solid rgba(0,26,45,.12); border-radius: 12px; overflow: hidden; }
        .theme-card {
            background: var(--cream-2);
            padding: 36px 28px;
            transition: background .2s;
        }
        .theme-card:hover { background: #fff; }
        .theme-num { font-family: 'Clash Display', sans-serif; font-size: .75rem; font-weight: 700; color: rgba(0,26,45,.2); letter-spacing: .1em; margin-bottom: 20px; }
        .theme-card h4 { font-family: 'Clash Display', sans-serif; font-weight: 600; font-size: 1.05rem; color: var(--navy); margin-bottom: 0; }

        /* ── GALLERY — i-lab editorial grid ── */
        #gallery { background: var(--navy-2); padding: 120px 40px; }

        .gallery-header {
            display: flex; align-items: flex-end; justify-content: space-between;
            gap: 40px; margin-bottom: 64px;
            padding-bottom: 40px;
            border-bottom: 1px solid var(--rule);
        }
        .gallery-header-left {}
        .gallery-eyebrow { font-size: .72rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase; color: var(--teal); margin-bottom: 12px; display: block; }
        .gallery-title {
            font-family: 'Clash Display', sans-serif; font-weight: 700;
            font-size: clamp(2rem,4vw,3.2rem); line-height: 1.05;
            letter-spacing: -.02em; color: var(--cream);
        }
        .gallery-count {
            font-family: 'Clash Display', sans-serif;
            font-size: 5rem; font-weight: 700;
            color: rgba(255,243,227,.08);
            line-height: 1; flex-shrink: 0;
        }

        /* i-lab inspired grid: 1 large + 2 stacked + 2 stacked */
        .photo-editorial {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 8px;
            height: 580px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .pe-item {
            position: relative; overflow: hidden;
            background: rgba(112,171,175,.06);
            cursor: pointer;
        }
        .pe-item:first-child { grid-row: span 2; border-radius: 8px 0 0 8px; }
        .pe-item:nth-child(2) { border-radius: 0 8px 0 0; }
        .pe-item:nth-child(3) { border-radius: 0 0 8px 0; }
        .pe-item:nth-child(4) { border-radius: 0; }
        .pe-item:nth-child(5) { border-radius: 0; }

        .pe-item img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .5s ease; }
        .pe-item:hover img { transform: scale(1.05); }

        /* Hover overlay — i-lab minimal */
        .pe-overlay {
            position: absolute; inset: 0;
            background: rgba(0,26,45,.0);
            transition: background .3s;
            display: flex; align-items: flex-end; padding: 20px;
        }
        .pe-item:hover .pe-overlay { background: rgba(0,26,45,.55); }
        .pe-overlay-label {
            font-size: .72rem; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: var(--cream);
            opacity: 0; transform: translateY(6px);
            transition: opacity .3s, transform .3s;
        }
        .pe-item:hover .pe-overlay-label { opacity: 1; transform: translateY(0); }

        /* Placeholder for missing images */
        .pe-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            background: rgba(112,171,175,.06);
        }
        .pe-placeholder span {
            font-size: .72rem; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: rgba(255,243,227,.18);
        }

        /* Gallery footer */
        .gallery-footer {
            display: flex; align-items: center; justify-content: space-between;
            gap: 32px; margin-top: 40px; padding-top: 32px;
            border-top: 1px solid var(--rule);
            max-width: 1200px; margin-left: auto; margin-right: auto;
        }
        .gallery-footer-text { font-size: .88rem; color: rgba(255,243,227,.5); line-height: 1.6; max-width: 520px; }
        .gallery-footer-text a { color: var(--teal); font-weight: 600; text-decoration: none; }
        .gallery-footer-text a:hover { text-decoration: underline; }

        /* ── CTA ── */
        #cta { background: var(--orange); padding: 80px 40px; }
        .cta-inner { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 48px; }
        .cta-left h2 {
            font-family: 'Clash Display', sans-serif; font-weight: 700;
            font-size: clamp(1.8rem,3.5vw,3rem); color: #fff;
            line-height: 1.1; letter-spacing: -.02em;
        }
        .cta-right-wrap { flex-shrink: 0; text-align: right; }
        .cta-date-label { font-size: .72rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,.6); margin-bottom: 4px; }
        .cta-date-value { font-family: 'Clash Display', sans-serif; font-size: 2.4rem; font-weight: 700; color: #fff; line-height: 1; margin-bottom: 20px; }
        .btn-cta-white {
            display: inline-block;
            background: #fff; color: var(--orange);
            font-family: 'Satoshi', sans-serif; font-weight: 700;
            font-size: .85rem; letter-spacing: .06em; text-transform: uppercase;
            padding: 14px 36px; border-radius: 4px;
            text-decoration: none; transition: background .2s;
        }
        .btn-cta-white:hover { background: rgba(255,255,255,.88); color: var(--orange); }

        /* ── VENUE ── */
        #venue { background: var(--navy-2); }
        .venue-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: center; margin-top: 48px; }
        .venue-eyebrow { font-size: .72rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase; color: var(--teal); margin-bottom: 12px; display: block; }
        .venue-heading { font-family: 'Clash Display', sans-serif; font-weight: 700; font-size: clamp(1.6rem,3vw,2.4rem); color: var(--cream); margin-bottom: 8px; line-height: 1.1; letter-spacing: -.01em; }
        .venue-sub { color: var(--teal); font-weight: 500; font-size: .9rem; margin-bottom: 24px; letter-spacing: .02em; }
        .venue-address { font-size: .92rem; color: rgba(255,243,227,.55); line-height: 2; margin-bottom: 0; }
        .venue-map { border-radius: 10px; overflow: hidden; border: 1px solid var(--rule); padding: 8px; }
        .venue-map iframe { width: 100%; height: 340px; border: none; border-radius: 6px; }

        /* ── PARTNERS ── */
        #partners { background: var(--navy); }
        .partners-eyebrow { font-size: .72rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase; color: var(--teal); margin-bottom: 12px; display: block; text-align: center; }
        .partners-heading { font-family: 'Clash Display', sans-serif; font-weight: 700; font-size: clamp(1.6rem,3vw,2.4rem); color: var(--cream); margin-bottom: 12px; text-align: center; }
        .partners-sub { text-align: center; color: rgba(255,243,227,.5); max-width: 600px; margin: 0 auto 52px; font-size: .9rem; line-height: 1.7; }
        .partners-logo-grid { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 16px; }
        .partner-logo-card {
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;
            min-height: 120px; padding: 16px 14px; border-radius: 8px;
            background: #fff; border: 1px solid rgba(255,255,255,.15);
            text-decoration: none; transition: transform .2s;
        }
        .partner-logo-card:hover { transform: translateY(-2px); }
        .partner-logo-image { width: 100%; height: 52px; object-fit: contain; object-position: center; display: block; }
        .partner-logo-name { color: #304250; font-size: .72rem; text-align: center; line-height: 1.3; font-weight: 600; }

        /* ── CONTACT ── */
        #contact { background: var(--cream); }
        .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: start; margin-top: 64px; }
        .contact-eyebrow { font-size: .72rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase; color: #2f536b; margin-bottom: 12px; display: block; }
        .contact-heading { font-family: 'Clash Display', sans-serif; font-weight: 700; font-size: clamp(1.8rem,3vw,2.8rem); color: var(--navy); margin-bottom: 24px; line-height: 1.1; letter-spacing: -.02em; }
        .contact-info p { color: rgba(0,26,45,.65); font-size: .95rem; line-height: 1.8; margin-bottom: 32px; }
        .contact-email {
            display: inline-flex; align-items: center; gap: 12px;
            background: transparent; border: 1px solid rgba(0,26,45,.2);
            border-radius: 4px; padding: 16px 24px;
            text-decoration: none; color: var(--navy); font-weight: 700; font-size: .95rem;
            transition: border-color .2s, background .2s;
        }
        .contact-email:hover { border-color: var(--teal); background: rgba(112,171,175,.1); color: var(--navy); }
        .contact-details { display: flex; flex-direction: column; gap: 0; border: 1px solid rgba(0,26,45,.12); border-radius: 8px; overflow: hidden; }
        .contact-card { padding: 24px 28px; border-bottom: 1px solid rgba(0,26,45,.1); background: var(--cream-2); }
        .contact-card:last-child { border-bottom: none; }
        .contact-card strong { display: block; color: var(--teal); font-size: .72rem; margin-bottom: 8px; text-transform: uppercase; letter-spacing: .1em; font-weight: 700; }
        .contact-card p { font-size: .9rem; color: rgba(0,26,45,.68); line-height: 1.7; }

        /* ── FOOTER ── */
        footer {
            background: var(--navy);
            border-top: 1px solid var(--rule);
            padding: 56px 40px 32px;
        }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer-top {
            display: flex; justify-content: space-between; align-items: flex-start;
            gap: 48px; margin-bottom: 48px; padding-bottom: 48px;
            border-bottom: 1px solid var(--rule);
        }
        .footer-brand-name { font-family: 'Clash Display', sans-serif; font-weight: 700; font-size: 1.3rem; color: var(--cream); margin-bottom: 4px; }
        .footer-brand-sub  { font-size: .72rem; color: var(--teal); margin-bottom: 14px; text-transform: uppercase; letter-spacing: .08em; }
        .footer-contact    { font-size: .85rem; color: rgba(255,243,227,.45); }
        .footer-contact a  { color: var(--teal); text-decoration: none; }
        .footer-links-col h4 { font-size: .65rem; text-transform: uppercase; letter-spacing: .14em; color: rgba(255,243,227,.3); margin-bottom: 16px; font-weight: 700; }
        .footer-links-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-links-col a { font-size: .85rem; color: rgba(255,243,227,.55); text-decoration: none; transition: color .2s; }
        .footer-links-col a:hover { color: var(--cream); }
        .footer-bottom { display: flex; justify-content: space-between; align-items: center; font-size: .75rem; color: rgba(255,243,227,.25); }
        .footer-badge { background: rgba(107,88,225,.25); border: 1px solid rgba(107,88,225,.4); color: rgba(255,243,227,.6); font-size: .68rem; font-weight: 700; padding: 4px 12px; border-radius: 4px; letter-spacing: .06em; text-transform: uppercase; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            section { padding: 80px 32px; }
            #hero   { padding: 0 0 64px; }
            #about  { padding: 80px 32px; }
            #gallery { padding: 80px 32px; }
            #cta    { padding: 64px 32px; }
            .hero-grid, .about-body-grid, .venue-grid, .contact-grid { gap: 40px; }
            .about-body-grid { grid-template-columns: 1fr; }
            .venue-grid, .contact-grid { grid-template-columns: 1fr; }
            .photo-editorial { grid-template-columns: 1fr 1fr; grid-template-rows: 1fr 1fr 1fr; height: auto; }
            .pe-item:first-child { grid-row: span 1; border-radius: 8px 8px 0 0; }
            .pe-item:first-child, .pe-item:nth-child(2), .pe-item:nth-child(3), .pe-item:nth-child(4), .pe-item:nth-child(5) { border-radius: 0; }
            .photo-editorial .pe-item { height: 220px; }
            .themes-grid { grid-template-columns: 1fr 1fr; }
            .partners-logo-grid { grid-template-columns: repeat(2, 1fr); }
            .cta-inner { flex-direction: column; text-align: center; }
            .cta-right-wrap { text-align: center; }
            footer { padding: 48px 32px 28px; }
            .footer-top { flex-direction: column; gap: 32px; }
            .nav-inner { padding: 14px 24px; }
        }

        @media (max-width: 768px) {
            section { padding: 60px 20px; }
            #about  { padding: 60px 20px; }
            #gallery { padding: 60px 20px; }
            #cta    { padding: 56px 20px; }
            .hero-grid { padding: 0 20px; }
            .hero-bottom-row { flex-direction: column; align-items: flex-start; gap: 24px; }
            .about-top { flex-direction: column; gap: 8px; }
            .gallery-header { flex-direction: column; align-items: flex-start; gap: 8px; }
            .gallery-count { display: none; }
            .photo-editorial { grid-template-columns: 1fr; height: auto; }
            .photo-editorial .pe-item { height: 240px; border-radius: 8px !important; }
            .nav-links { display: none; }
            .themes-grid { grid-template-columns: 1fr; }
            footer { padding: 40px 20px 24px; }
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav class="nav">
        <div class="nav-inner">
            <a class="nav-brand" href="#">
                <span class="nav-brand-name">SAIMechE 2026</span>
                <span class="nav-brand-sub">Johannesburg · South Africa</span>
            </a>
            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#venue">Venue</a></li>
                <li><a href="#contact">Contact</a></li>
                <li>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-nav">Dashboard</a>
                    @else
                        <div class="nav-auth-actions">
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn-nav">Login</a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-nav">Register</a>
                            @endif
                        </div>
                    @endauth
                </li>
            </ul>
        </div>
    </nav>

    <!-- ═══ HERO ═══ -->
    <section id="hero">
        <div class="hero-bg-num" aria-hidden="true">2026</div>
        <div class="hero-grid">
            <span class="hero-eyebrow">University of the Witwatersrand · SAIMechE Central Branch</span>
            <h1 class="hero-title">Postgraduate Conference on Mechanical Engineering &amp; Related Disciplines</h1>
            <hr class="hero-rule">
            <div class="hero-bottom-row">
                <div class="hero-meta">
                    <div class="hero-meta-item">
                        <div class="hero-meta-label">Date</div>
                        <div class="hero-meta-value">TBC · 2026</div>
                    </div>
                    <div class="hero-meta-item">
                        <div class="hero-meta-label">Location</div>
                        <div class="hero-meta-value">East Campus · Johannesburg</div>
                    </div>
                    <div class="hero-meta-item">
                        <div class="hero-meta-label">Submissions open</div>
                        <div class="hero-meta-value">6 January 2026</div>
                    </div>
                </div>
                <div class="hero-cta-group">
                    <a class="btn-hero-primary" href="https://cmt3.research.microsoft.com/SCMERD2025" target="_blank">Submit Paper</a>
                    <a class="btn-hero-ghost" href="#about">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- MARQUEE -->
    <div class="marquee-wrap marquee-purple">
        <div class="marquee-track">
            <div class="marquee-item">
                <span>Design It. Build It.</span><span class="marquee-sep">|</span>
                <span>2026 Postgraduate Conference</span><span class="marquee-sep">|</span>
                <span>Mechanical Engineering</span><span class="marquee-sep">|</span>
                <span>Industrial Engineering</span><span class="marquee-sep">|</span>
                <span>Aeronautical Engineering</span><span class="marquee-sep">|</span>
                <span>Wits University · East Campus</span><span class="marquee-sep">|</span>
            </div>
            <div class="marquee-item" aria-hidden="true">
                <span>Design It. Build It.</span><span class="marquee-sep">|</span>
                <span>2026 Postgraduate Conference</span><span class="marquee-sep">|</span>
                <span>Mechanical Engineering</span><span class="marquee-sep">|</span>
                <span>Industrial Engineering</span><span class="marquee-sep">|</span>
                <span>Aeronautical Engineering</span><span class="marquee-sep">|</span>
                <span>Wits University · East Campus</span><span class="marquee-sep">|</span>
            </div>
        </div>
    </div>

    <!-- ═══ ABOUT ═══ -->
    <section id="about">
        <div class="section-inner">

            <div class="about-top">
                <span class="about-eyebrow">About the Conference</span>
                <span class="about-year">Est. SAIMechE Central Branch · Wits</span>
            </div>

            <!-- Giant statement — i-lab signature -->
            <p class="about-statement">
                A platform where <em>rigorous inquiry</em> meets industry ambition — bringing South Africa's finest postgraduate engineers together to present, debate, and publish original work.
            </p>

            <!-- Two-column: prose left, stat pillars right -->
            <div class="about-body-grid">
                <div class="about-body-left">
                    <p class="about-body-para">
                        The SAIMechE Central Branch Postgraduate Conference is the premier annual gathering for postgraduate students, researchers, and industry practitioners across mechanical, industrial, and aeronautical engineering disciplines in South Africa.
                    </p>
                    <p class="about-body-para">
                        Hosted at the University of the Witwatersrand's East Campus, the conference provides a rigorous peer-reviewed forum for emerging engineers to present cutting-edge research, receive critical feedback from leading academics, and forge connections with industry partners driving South Africa's engineering future.
                    </p>
                    <blockquote class="about-quote">
                        <span class="about-quote-mark">&ldquo;</span>
                        <p>Innovation in engineering begins with rigorous inquiry and the courage to challenge the conventional.</p>
                        <cite>Dr Tiyamike Ngonda &mdash; Conference Chair, Wits University</cite>
                    </blockquote>
                </div>

                <div class="about-body-right">
                    <ul class="about-stats-list">
                        <li class="about-stat-row">
                            <span class="about-stat-num">8+</span>
                            <div class="about-stat-desc">
                                <strong>Partner Universities</strong>
                                Including Wits, UJ, UP, UNISA, TUT, VUT, DUT, and NWU
                            </div>
                        </li>
                       
                        <li class="about-stat-row">
                            <span class="about-stat-num">DHET</span>
                            <div class="about-stat-desc">
                                <strong>Accredited Publication</strong>
                                Double-blind peer review process
                            </div>
                        </li>
                        <li class="about-stat-row">
                            <span class="about-stat-num">6</span>
                            <div class="about-stat-desc">
                                <strong>Research Tracks</strong>
                                Mechanical Design, Fluid Mechanics, Mechatronics, Materials, Energy, Operations
                            </div>
                        </li>
                        <li class="about-stat-row">
                            <span class="about-stat-num">Oct 8</span>
                            <div class="about-stat-desc">
                                <strong>Submission Deadline</strong>
                                Abstracts open from 6 January 2026
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- THEMES -->
    <section id="themes">
        <div class="section-inner">
            <span class="section-tag">Conference Themes</span>
            <h2 class="section-heading">Research areas we cover</h2>
            <div class="themes-grid">
                <div class="theme-card"><div class="theme-num">01</div><h4>Mechanical Design</h4></div>
                <div class="theme-card"><div class="theme-num">02</div><h4>Fluid Mechanics</h4></div>
                <div class="theme-card"><div class="theme-num">03</div><h4>Mechatronics</h4></div>
                <div class="theme-card"><div class="theme-num">04</div><h4>Materials Science</h4></div>
                <div class="theme-card"><div class="theme-num">05</div><h4>Energy Systems</h4></div>
                <div class="theme-card"><div class="theme-num">06</div><h4>Operations Research</h4></div>
            </div>
        </div>
    </section>

    <!-- MARQUEE 2 -->
    <div class="marquee-wrap marquee-teal">
        <div class="marquee-track">
            <div class="marquee-item">
                <span>Submission Deadline: 8 October 2026</span><span class="marquee-sep">|</span>
                <span>Camera-Ready: 23 October 2026</span><span class="marquee-sep">|</span>
              
                <span>DHET Accredited</span><span class="marquee-sep">|</span>
                <span>Blind Peer Review</span><span class="marquee-sep">|</span>
            </div>
            <div class="marquee-item" aria-hidden="true">
                <span>Submission Deadline: 8 October 2026</span><span class="marquee-sep">|</span>
                <span>Camera-Ready: 23 October 2026</span><span class="marquee-sep">|</span>
              
                <span>DHET Accredited</span><span class="marquee-sep">|</span>
                <span>Blind Peer Review</span><span class="marquee-sep">|</span>
            </div>
        </div>
    </div>

    <!-- ═══ GALLERY ═══ -->
    <section id="gallery">
        <div class="section-inner">

            <div class="gallery-header">
                <div class="gallery-header-left">
                    <span class="gallery-eyebrow">Conference Moments</span>
                    <h2 class="gallery-title">Scenes from past sessions,<br>labs &amp; keynotes</h2>
                </div>
                <div class="gallery-count" aria-hidden="true">8+</div>
            </div>

            <!-- i-lab editorial grid: 1 large left, 2×2 right -->
            <div class="photo-editorial">

                <div class="pe-item">
                    <img src="/images/3.jpeg" alt="Keynote presentation"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="pe-placeholder" style="display:none"><span>Keynote</span></div>
                    <div class="pe-overlay"><span class="pe-overlay-label">Keynote Presentation</span></div>
                </div>

                <div class="pe-item">
                    <img src="/images/4.jpeg" alt="Research presentations"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="pe-placeholder" style="display:none"><span>Research</span></div>
                    <div class="pe-overlay"><span class="pe-overlay-label">Research Presentations</span></div>
                </div>

                <div class="pe-item">
                    <img src="/images/5.jpeg" alt="Wits East Campus"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="pe-placeholder" style="display:none"><span>Campus</span></div>
                    <div class="pe-overlay"><span class="pe-overlay-label">Wits East Campus</span></div>
                </div>

                <div class="pe-item">
                    <img src="/images/6.jpeg" alt="Award ceremony"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="pe-placeholder" style="display:none"><span>Awards</span></div>
                    <div class="pe-overlay"><span class="pe-overlay-label">Award Ceremony</span></div>
                </div>

                <div class="pe-item">
                    <img src="/images/7.jpeg" alt="Panel discussion"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="pe-placeholder" style="display:none"><span>Panel</span></div>
                    <div class="pe-overlay"><span class="pe-overlay-label">Panel Discussion</span></div>
                </div>

            </div>

            <div class="gallery-footer">
                <p class="gallery-footer-text">
                    Moments from previous SAIMechE Central Branch postgraduate conferences at Wits University — where ideas become impact.<br>
                    <a href="#contact">Share your conference photos &rarr;</a>
                </p>
            </div>

        </div>
    </section>

    <!-- CTA -->
    <section id="cta" style="padding: 80px 40px;">
        <div class="cta-inner">
            <div class="cta-left">
                <h2>Get your name on the delegate list now</h2>
            </div>
            <div class="cta-right-wrap">
                <div class="cta-date-label">Abstract Submission Opens</div>
                <div class="cta-date-value">6 Jan 2026</div>
                <a class="btn-cta-white" href="https://cmt3.research.microsoft.com/SCMERD2025" target="_blank">Submit Your Paper</a>
            </div>
        </div>
    </section>

    <!-- VENUE -->
    <section id="venue">
        <div class="section-inner">
            <span class="venue-eyebrow">Conference Venue</span>
            <div class="venue-grid" style="margin-top:32px;">
                <div class="venue-info">
                    <h2 class="venue-heading">South West Engineering Building</h2>
                    <div class="venue-sub">University of the Witwatersrand · East Campus</div>
                    <div class="venue-address">
                        1 Jan Smuts Avenue<br>
                        Braamfontein<br>
                        Johannesburg, 2000<br>
                        South Africa
                    </div>
                </div>
                <div class="venue-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3580.1522852615117!2d28.029332999999998!3d-26.191723999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjbCsDExJzMwLjIiUyAyOMKwMDEnNDUuNiJF!5e0!3m2!1sen!2smw!4v1747369293879!5m2!1sen!2smw"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- PARTNERS -->
    <section id="partners">
        <div class="section-inner">
            <span class="partners-eyebrow">Partner Universities</span>
            <h2 class="partners-heading">Partner Universities</h2>
            <p class="partners-sub">A collaboration of leading South African universities and engineering schools supporting postgraduate innovation.</p>
            <div class="partners-logo-grid">
                <a class="partner-logo-card" href="https://www.uj.ac.za/" target="_blank">
                    <img class="partner-logo-image" src="/unilogos/uj.jpg" alt="University of Johannesburg logo">
                    <span class="partner-logo-name">University of Johannesburg</span>
                </a>
                <a class="partner-logo-card" href="https://www.up.ac.za/" target="_blank">
                    <img class="partner-logo-image" src="/unilogos/up.png" alt="University of Pretoria logo">
                    <span class="partner-logo-name">University of Pretoria</span>
                </a>
                <a class="partner-logo-card" href="https://www.unisa.ac.za/" target="_blank">
                    <img class="partner-logo-image" src="/unilogos/unisa.png" alt="University of South Africa logo">
                    <span class="partner-logo-name">University of South Africa</span>
                </a>
                <a class="partner-logo-card" href="https://www.tut.ac.za/" target="_blank">
                    <img class="partner-logo-image" src="/unilogos/TUT.jpg" alt="Tshwane University of Technology logo">
                    <span class="partner-logo-name">Tshwane University of Technology</span>
                </a>
                <a class="partner-logo-card" href="https://vut.ac.za/" target="_blank">
                    <img class="partner-logo-image" src="/unilogos/Vaal-University-of-Technology.webp" alt="Vaal University of Technology logo">
                    <span class="partner-logo-name">Vaal University of Technology</span>
                </a>
                <a class="partner-logo-card" href="https://www.dut.ac.za/" target="_blank">
                    <img class="partner-logo-image" src="/unilogos/dut.jpg" alt="Durban University of Technology logo">
                    <span class="partner-logo-name">Durban University of Technology</span>
                </a>
                <a class="partner-logo-card" href="https://www.nwu.ac.za/" target="_blank">
                    <img class="partner-logo-image" src="/unilogos/nwu.jpg" alt="North-West University logo">
                    <span class="partner-logo-name">North-West University</span>
                </a>
                <a class="partner-logo-card" href="https://www.wits.ac.za/" target="_blank">
                    <img class="partner-logo-image" src="/unilogos/wits-logo.jpg" alt="University of the Witwatersrand logo">
                    <span class="partner-logo-name">University of the Witwatersrand (Host)</span>
                </a>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact">
        <div class="section-inner">
            <span class="contact-eyebrow">Get in Touch</span>
            <div class="contact-grid">
                <div class="contact-info">
                    <h2 class="contact-heading">Contact us</h2>
                    <p>For queries about submissions, registration, speaker invitations, or any other conference-related matters — we are here to help.</p>
                    <a class="contact-email" href="mailto:info@scmerd.org">
                        <span>@</span> info@scmerd.org
                    </a>
                </div>
                <div class="contact-details">
                    <div class="contact-card">
                        <strong>Organised by</strong>
                        <p>SAIMechE Central Branch<br>School of Mechanical, Industrial &amp; Aeronautical Engineering<br>University of the Witwatersrand</p>
                    </div>
                    <div class="contact-card">
                        <strong>Conference Chair</strong>
                        <p>Dr Tiyamike Ngonda<br>University of the Witwatersrand, Johannesburg</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div>
                    <div class="footer-brand-name">SAIMechE PGC 2026</div>
                    <div class="footer-brand-sub">2026 · Johannesburg, South Africa</div>
                    <div class="footer-contact"><a href="mailto:info@scmerd.org">info@scmerd.org</a></div>
                </div>
                <div class="footer-links-col">
                    <h4>Conference</h4>
                    <ul>
                        <li><a href="#about">About</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#themes">Themes</a></li>
                    </ul>
                </div>
                <div class="footer-links-col">
                    <h4>Authors</h4>
                    <ul>
                        <li><a href="https://cmt3.research.microsoft.com/SCMERD2025" target="_blank">Submit Paper</a></li>
                        <li><a href="/SAIMechE conference flyer 2025.pdf" target="_blank">2026 Flyer</a></li>
                    </ul>
                </div>
                <div class="footer-links-col">
                    <h4>Venue</h4>
                    <ul>
                        <li><a href="#venue">Location</a></li>
                        <li><a href="#partners">Partners</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>&copy; 2026 SAIMechE Central Branch. All rights reserved.</span>
                <span class="footer-badge">SAIMechE PGC 2026</span>
            </div>
        </div>
    </footer>

</body>
</html>