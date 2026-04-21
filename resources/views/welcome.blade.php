<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2026 SAIMechE Central Branch Postgraduate Conference</title>
    <meta name="description"
        content="2026 SAIMechE Central Branch Postgraduate Conference on Mechanical Engineering and Related Disciplines. University of the Witwatersrand, Johannesburg.">

    <link rel="preconnect" href="https://api.fontshare.com">
    <link
        href="https://api.fontshare.com/css?f[]=clash-display@400,500,600,700&f[]=satoshi@300,400,500,700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --navy: #001A2D;
            --navy-2: #05192b;
            --teal: #70ABAF;
            --orange: #F86624;
            --purple: #6B58E1;
            --cream: #FFF3E3;
            --cream-2: #FFF9F1;
            --white: #ffffff;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background:
                radial-gradient(circle at 15% 10%, rgba(255, 243, 227, .09) 0%, transparent 38%),
                radial-gradient(circle at 85% 0%, rgba(255, 243, 227, .08) 0%, transparent 34%),
                var(--navy-2);
            color: var(--cream);
            font-family: 'Satoshi', sans-serif;
            font-size: 18px;
            line-height: 1.5;
            overflow-x: hidden;
        }

        /* ── NAV ── */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background: rgba(0, 26, 45, .95);
            border-bottom: 1px solid rgba(112, 171, 175, .12);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .nav-brand {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .nav-brand-name {
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--cream);
            letter-spacing: -.5px;
        }

        .nav-brand-sub {
            font-size: .78rem;
            color: var(--teal);
            font-weight: 500;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            list-style: none;
        }

        .nav-links a {
            color: var(--cream);
            text-decoration: none;
            font-size: .95rem;
            font-weight: 500;
            opacity: .85;
            transition: opacity .2s;
        }

        .nav-links a:hover {
            opacity: 1;
            color: var(--teal);
        }

        .btn-nav {
            background: var(--purple);
            color: var(--cream) !important;
            padding: 8px 24px;
            border-radius: 50px;
            font-weight: 700 !important;
            opacity: 1 !important;
            transition: background .2s !important;
        }

        .btn-nav:hover {
            background: #5649c0 !important;
        }

        /* guest nav buttons: outlined instead of filled */
        .nav-auth-actions .btn-nav {
            background: transparent;
            border: 1px solid rgba(107, 88, 225, .85);
            color: var(--cream) !important;
        }

        .nav-auth-actions .btn-nav:hover {
            background: rgba(107, 88, 225, .18) !important;
            border-color: rgba(107, 88, 225, 1);
        }

        .btn-nav-square {
            border-radius: 8px;
            padding: 8px 16px;
        }

        .nav-auth-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* ── HERO ── */
        #hero {
            
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 120px 64px 80px;
            position: relative;
            overflow: hidden;
        }
        

        .hero-bg {
            
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 60% 40%, rgba(112, 171, 175, .08) 0%, transparent 70%),
                radial-gradient(ellipse 50% 50% at 20% 80%, rgba(107, 88, 225, .06) 0%, transparent 60%);
            z-index: 0;
        }

        /* playful doodle layer */
        .hero-doodles {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            user-select: none;
        }

        .hero-doodle {
            position: absolute;
            width: 520px;
            height: 260px;
            opacity: .85;
            transform: rotate(-10deg);
            filter: saturate(1.1) contrast(1.05) blur(.15px);
            mix-blend-mode: screen;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
        }

        .hero-doodle.is-orange {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='900' height='420' viewBox='0 0 900 420'%3E%3Cg fill='none' stroke='%23F86624' stroke-linecap='round'%3E%3Cpath d='M80 265 C 175 125, 290 365, 410 205 S 660 95, 820 235' stroke-width='42' opacity='.52'/%3E%3Cpath d='M98 290 C 200 150, 300 380, 420 220 S 670 120, 800 250' stroke-width='22' opacity='.65'/%3E%3Cpath d='M110 250 C 220 110, 320 340, 450 185 S 640 90, 790 215' stroke-width='10' opacity='.8'/%3E%3C/g%3E%3C/svg%3E");
        }

        .hero-doodle.is-teal {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='900' height='420' viewBox='0 0 900 420'%3E%3Cg fill='none' stroke='%2370ABAF' stroke-linecap='round'%3E%3Cpath d='M70 170 C 190 55, 300 290, 445 160 S 675 40, 835 150' stroke-width='36' opacity='.42'/%3E%3Cpath d='M86 195 C 210 70, 320 305, 465 175 S 685 65, 818 165' stroke-width='18' opacity='.6'/%3E%3Cpath d='M98 155 C 230 35, 345 270, 495 145 S 650 35, 800 140' stroke-width='9' opacity='.75'/%3E%3C/g%3E%3C/svg%3E");
        }

        .hero-doodle.is-purple {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='900' height='420' viewBox='0 0 900 420'%3E%3Cg fill='none' stroke='%236B58E1' stroke-linecap='round'%3E%3Cpath d='M95 305 C 245 430, 315 110, 480 235 S 700 365, 835 255' stroke-width='34' opacity='.38'/%3E%3Cpath d='M110 322 C 255 440, 335 120, 500 250 S 705 355, 815 265' stroke-width='16' opacity='.58'/%3E%3Cpath d='M125 292 C 265 412, 360 115, 520 230 S 690 340, 790 255' stroke-width='8' opacity='.75'/%3E%3C/g%3E%3C/svg%3E");
        }

        .hero-doodle.is-red {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='900' height='420' viewBox='0 0 900 420'%3E%3Cg fill='none' stroke='%23ff2d55' stroke-linecap='round'%3E%3Cpath d='M70 255 C 210 95, 330 370, 470 205 S 700 60, 850 240' stroke-width='36' opacity='.42'/%3E%3Cpath d='M92 276 C 235 120, 350 385, 495 220 S 705 85, 830 258' stroke-width='18' opacity='.62'/%3E%3Cpath d='M105 240 C 250 80, 375 340, 520 190 S 690 70, 805 225' stroke-width='8' opacity='.78'/%3E%3C/g%3E%3C/svg%3E");
        }

       

        .hero-doodle.d1 {
            left: -120px;
            top: 80px;
            transform: rotate(-18deg);
            opacity: .85;
        }

        .hero-doodle.d2 {
            right: -180px;
            top: 120px;
            transform: rotate(12deg);
            opacity: .75;
        }

        .hero-doodle.d3 {
            left: 40%;
            bottom: -140px;
            transform: translateX(-50%) rotate(-6deg);
            width: 640px;
            height: 320px;
            opacity: .6;
        }

        /* center accents */
        .hero-doodle.d4 {
            left: 44%;
            top: 210px;
            transform: translateX(-50%) rotate(8deg);
            width: 520px;
            height: 260px;
            opacity: .55;
        }

        .hero-doodle.d5 {
            left: 62%;
            top: 320px;
            transform: translateX(-50%) rotate(-14deg);
            width: 520px;
            height: 260px;
            opacity: .5;
        }

        .hero-doodle.d6 {
            left: 52%;
            top: 110px;
            transform: translateX(-50%) rotate(-6deg);
            width: 460px;
            height: 230px;
            opacity: .48;
        }

        .hero-doodle.d7 {
            left: 48%;
            top: 430px;
            transform: translateX(-50%) rotate(18deg);
            width: 420px;
            height: 210px;
            opacity: .38;
        }

        .hero-grid {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            align-items: flex-start;
            gap: 40px;
        }

        .hero-media {
            width: 100%;
            max-width: 430px;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(112, 171, 175, .2);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .25);
        }

        .hero-media img {
            width: 100%;
            height: 100%;
            max-height: 280px;
            object-fit: cover;
            display: block;
        }

        .hero-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .hero-tag {
            font-family: 'Satoshi', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            color: var(--teal);
            letter-spacing: .02em;
        }

        .hero-title {
            font-family: 'Clash Display', sans-serif;
            font-weight: 500;
            font-size: clamp(2.2rem, 4vw, 3.6rem);
            line-height: 1.1;
            color: var(--cream);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--teal);
            font-family: 'Clash Display', sans-serif;
            font-weight: 500;
        }

        .hero-desc {
            font-size: 1rem;
            color: rgba(255, 238, 219, .7);
            max-width: 520px;
            line-height: 1.6;
        }

        /* ticket card */
        .ticket-card {
            background: var(--purple);
            border-radius: 24px;
            padding: 32px 24px;
            width: 100%;
            max-width: 480px;
            flex-shrink: 0;
            position: relative;
            overflow: visible;
        }

        .ticket-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 24px;
        }

        .ticket-label {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--cream);
        }

        .ticket-sublabel {
            font-size: .9rem;
            color: rgba(255, 238, 219, .7);
            margin-top: 4px;
        }

        .ticket-badge {
            background: var(--orange);
            color: #fff;
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: .8rem;
            padding: 6px 14px;
            border-radius: 50px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .ticket-price-row {
            display: flex;
            align-items: flex-end;
            gap: 12px;
            margin-bottom: 8px;
        }

        .ticket-price {
            font-family: 'Clash Display', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            color: var(--cream);
            line-height: 1;
        }

        .ticket-price-was {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.4rem;
            color: rgba(255, 238, 219, .45);
            text-decoration: line-through;
        }

        .ticket-note {
            font-size: .85rem;
            color: rgba(255, 238, 219, .6);
            margin-bottom: 20px;
        }

        .ticket-deadline {
            font-size: .9rem;
            color: var(--cream);
            background: rgba(255, 238, 219, .12);
            border-radius: 8px;
            padding: 8px 12px;
            margin-bottom: 20px;
        }

        .btn-ticket {
            display: inline-block;
            background: var(--orange);
            color: var(--navy) !important;
            font-family: 'Satoshi', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            transition: background .2s, transform .15s;
            border: none;
            cursor: pointer;
        }

        .btn-ticket:hover {
            background: #e55a1a;
            transform: translateY(-1px);
        }

        .btn-ticket-square {
            border-radius: 8px;
            padding: 12px 18px;
        }

        .btn-ticket-outline {
            background: transparent;
            color: var(--cream) !important;
            border: 1px solid rgba(255, 238, 219, .35);
        }

        /* corner decoration */
        .ticket-corner {
            position: absolute;
            top: -36px;
            right: -36px;
            width: 90px;
            height: 90px;
            background: rgba(248, 102, 36, .18);
            border-radius: 50%;
            z-index: 2;
        }

        /* ── MARQUEE ── */
        .marquee-wrap {
            overflow: hidden;
            padding: 0;
        }

        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee-slide 35s linear infinite;
        }

        .marquee-wrap:hover .marquee-track {
            animation-play-state: paused;
        }

        .marquee-item {
            display: flex;
            align-items: center;
            gap: 64px;
            padding: 22px 1px 22px 64px;
            white-space: nowrap;
            font-family: 'Clash Display', sans-serif;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .marquee-sep {
            opacity: .4;
            margin: 0 8px;
        }

        .marquee-purple {
            background: var(--purple);
        }

        .marquee-teal {
            background: var(--teal);
            color: var(--navy);
        }

        .marquee-orange {
            background: var(--orange);
            color: #fff;
        }

        @keyframes marquee-slide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* ── SECTION COMMONS ── */
        section {
            padding: 100px 64px;
        }

        .section-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-tag {
            font-size: .95rem;
            font-weight: 500;
            color: var(--teal);
            margin-bottom: 16px;
            display: block;
        }

        .section-heading {
            font-family: 'Clash Display', sans-serif;
            font-weight: 500;
            font-size: clamp(1.8rem, 3vw, 3rem);
            line-height: 1.2;
            color: var(--cream);
            margin-bottom: 24px;
        }

        #themes .section-heading {
            color: var(--navy);
        }

        #themes .section-tag {
            color: #2c5b5f;
        }

        .section-body {
            color: rgba(255, 238, 219, .75);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 600px;
        }

        /* ── ABOUT ── */
        #about {
            background: var(--navy);
        }

        .about-grid {
            display: flex;
            gap: 80px;
            align-items: center;
        }

        .about-text {
            flex: 1;
        }

        .about-img-wrap {
            flex: 1;
            position: relative;
        }

        .about-img-box {
            background:
                linear-gradient(135deg, rgba(0, 26, 45, .5) 0%, rgba(0, 26, 45, .15) 100%),
                url('/images/2.jpeg') center/cover no-repeat;
            border-radius: 20px;
            aspect-ratio: 4/3;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Clash Display', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: rgba(255, 238, 219, .3);
            letter-spacing: -2px;
            overflow: hidden;
            position: relative;
        }

        .about-img-box::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(107, 88, 225, .4) 0%, rgba(112, 171, 175, .2) 100%);
        }

        .about-img-text {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 24px;
        }

        .about-img-text h3 {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--cream);
            margin-bottom: 8px;
        }

        .about-img-text p {
            color: rgba(255, 238, 219, .7);
            font-size: .95rem;
        }

        .about-img-badge {
            position: absolute;
            bottom: -20px;
            right: -20px;
            background: var(--orange);
            color: #fff;
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: .85rem;
            padding: 14px 20px;
            border-radius: 14px;
            text-align: center;
            line-height: 1.3;
        }

        /* ── THEMES ── */
        #themes {
            background: var(--cream);
        }

        .themes-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 48px;
        }

        .theme-card {
            background: var(--cream-2);
            border: 1px solid rgba(0, 26, 45, .12);
            border-radius: 16px;
            padding: 28px 24px;
            transition: border-color .25s, background .25s;
        }

        .theme-card:hover {
            border-color: rgba(0, 26, 45, .3);
            background: #ffffff;
        }

        .theme-icon {
            font-size: .78rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--orange);
            font-weight: 700;
            margin-bottom: 14px;
        }

        .theme-card h4 {
            font-family: 'Clash Display', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            color: var(--navy-2);
            margin-bottom: 8px;
        }

        .theme-card p {
            font-size: .88rem;
            color: rgba(0, 26, 45, .72);
            line-height: 1.5;
        }

        /* ── DATES ── */
        #dates {
            background: var(--navy);
        }

        .dates-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            margin-top: 48px;
        }

        .date-card {
            background: rgba(255, 238, 219, .04);
            border: 1px solid rgba(112, 171, 175, .15);
            border-radius: 20px;
            padding: 32px 28px;
            transition: transform .25s, border-color .25s;
            position: relative;
            overflow: hidden;
        }

        .date-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--teal);
        }

        .date-card:nth-child(2)::before {
            background: var(--purple);
        }

        .date-card:nth-child(3)::before {
            background: var(--orange);
        }

        .date-card:hover {
            transform: translateY(-4px);
            border-color: var(--teal);
        }

        .date-card-label {
            font-size: .85rem;
            font-weight: 600;
            color: var(--teal);
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 12px;
        }

        .date-card h3 {
            font-family: 'Clash Display', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--cream);
            margin-bottom: 12px;
        }

        .date-card-value {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--orange);
            margin-bottom: 8px;
        }

        .date-card p {
            font-size: .88rem;
            color: rgba(255, 238, 219, .55);
            line-height: 1.5;
        }

        /* ── SPEAKERS ── */
        #speakers {
            background: var(--navy-2);
        }

        .speakers-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 28px;
            margin-top: 48px;
        }

        .speaker-card {
            background: rgba(255, 238, 219, .04);
            border: 1px solid rgba(112, 171, 175, .12);
            border-radius: 20px;
            padding: 28px;
            display: flex;
            gap: 20px;
            align-items: flex-start;
            transition: border-color .25s, background .25s;
        }

        .speaker-card:hover {
            border-color: rgba(112, 171, 175, .4);
            background: rgba(112, 171, 175, .05);
        }

        .speaker-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--purple), var(--teal));
            flex-shrink: 0;
            overflow: hidden;
            border: 2px solid rgba(255, 238, 219, .25);
        }

        .speaker-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .speaker-time {
            display: inline-block;
            font-size: .78rem;
            font-weight: 600;
            color: var(--teal);
            background: rgba(112, 171, 175, .12);
            padding: 3px 10px;
            border-radius: 50px;
            margin-bottom: 8px;
        }

        .speaker-talk {
            font-family: 'Clash Display', sans-serif;
            font-weight: 500;
            font-size: 1rem;
            color: var(--cream);
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .speaker-name {
            font-size: .9rem;
            color: var(--orange);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .speaker-bio {
            font-size: .82rem;
            color: rgba(255, 238, 219, .55);
            line-height: 1.5;
        }

        /* ── PROGRAM ── */
        #program {
            background: var(--navy);
        }

        .program-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-top: 48px;
        }

        .program-col h3 {
            font-family: 'Clash Display', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            color: var(--teal);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(112, 171, 175, .2);
        }

        .program-item {
            display: flex;
            gap: 16px;
            margin-bottom: 18px;
            position: relative;
        }

        .program-item::before {
            content: '';
            position: absolute;
            left: 52px;
            top: 24px;
            bottom: -18px;
            width: 1px;
            background: rgba(112, 171, 175, .15);
        }

        .program-item:last-child::before {
            display: none;
        }

        .program-time {
            font-size: .78rem;
            font-weight: 700;
            color: var(--teal);
            white-space: nowrap;
            min-width: 52px;
            padding-top: 3px;
        }

        .program-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--teal);
            flex-shrink: 0;
            margin-top: 6px;
            border: 2px solid var(--navy);
            box-shadow: 0 0 0 2px rgba(112, 171, 175, .3);
        }

        .program-dot.break {
            background: var(--orange);
            box-shadow: 0 0 0 2px rgba(248, 102, 36, .3);
        }

        .program-title {
            font-family: 'Clash Display', sans-serif;
            font-size: .95rem;
            font-weight: 600;
            color: var(--cream);
            margin-bottom: 4px;
        }

        .program-detail {
            font-size: .8rem;
            color: rgba(255, 238, 219, .5);
            line-height: 1.4;
        }

        .program-sessions {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 6px;
        }

        .program-session-pill {
            background: rgba(107, 88, 225, .15);
            border: 1px solid rgba(107, 88, 225, .3);
            color: #a89ef5;
            font-size: .75rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 50px;
        }

        /* ── CTA ── */
        #cta {
            background: var(--cream);
        }

        .cta-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .cta-card {
            display: flex;
            align-items: center;
            gap: 0;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .2);
        }

        .cta-left {
            background: var(--cream);
            flex: 1;
            padding: 52px 48px;
        }

        .cta-left h2 {
            font-family: 'Clash Display', sans-serif;
            font-weight: 500;
            font-size: clamp(1.8rem, 3vw, 2.8rem);
            color: var(--navy);
            margin-bottom: 28px;
            line-height: 1.15;
        }

        .btn-cta {
            display: inline-block;
            background: var(--orange);
            color: #fff;
            font-family: 'Satoshi', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            padding: 16px 40px;
            border-radius: 50px;
            text-decoration: none;
            transition: background .2s, transform .15s;
        }

        .btn-cta:hover {
            background: #e55a1a;
            transform: translateY(-2px);
            color: #fff;
        }

        .cta-perforation {
            width: 24px;
            background: var(--cream);
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .cta-perforation::before,
        .cta-perforation::after {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--cream-2);
        }

        .cta-perforation::before {
            top: -12px;
        }

        .cta-perforation::after {
            bottom: -12px;
        }

        .perf-dots {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .perf-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: rgba(0, 26, 45, .2);
        }

        .cta-right {
            background: var(--cream-2);
            width: 240px;
            flex-shrink: 0;
            padding: 40px 32px;
            text-align: center;
            border-left: 1px dashed rgba(0, 26, 45, .15);
        }

        .cta-right-label {
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .cta-right-price {
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: 2.8rem;
            color: var(--navy);
            line-height: 1;
            margin-bottom: 4px;
        }

        .cta-right-from {
            font-size: .85rem;
            color: rgba(0, 26, 45, .5);
            margin-bottom: 4px;
        }

        .cta-right-was {
            font-size: 1rem;
            color: rgba(0, 26, 45, .35);
            text-decoration: line-through;
            font-family: 'Clash Display', sans-serif;
        }

        /* ── FEATURES ── */
        #features {
            background: var(--navy);
        }

        .features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1px;
            border: 1px solid rgba(112, 171, 175, .15);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 48px;
        }

        .feature-cell {
            padding: 48px 40px;
            border-right: 1px solid rgba(112, 171, 175, .15);
            border-bottom: 1px solid rgba(112, 171, 175, .15);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .feature-cell:nth-child(2),
        .feature-cell:nth-child(4) {
            border-right: none;
        }

        .feature-cell:nth-child(3),
        .feature-cell:nth-child(4) {
            border-bottom: none;
        }

        .feature-num {
            font-family: 'Clash Display', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: rgba(112, 171, 175, .15);
            line-height: 1;
        }

        .feature-icon {
            font-size: 2rem;
        }

        .feature-cell h3 {
            font-family: 'Clash Display', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--cream);
        }

        .feature-cell p {
            font-size: .9rem;
            color: rgba(255, 238, 219, .55);
            line-height: 1.6;
        }

        /* ── SUBMISSION ── */
        #submission {
            background: var(--navy-2);
        }

        .submission-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-top: 48px;
        }

        .submission-info {}

        .submission-info ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 24px;
        }

        .submission-info li {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding: 16px;
            background: rgba(255, 238, 219, .03);
            border: 1px solid rgba(112, 171, 175, .1);
            border-radius: 12px;
        }

        .submission-info li span:first-child {
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .submission-info li .li-text {
            font-size: .9rem;
            color: rgba(255, 238, 219, .7);
            line-height: 1.5;
        }

        .submission-info li .li-text strong {
            color: var(--cream);
        }

        .submission-side {}

        .template-card {
            background: rgba(255, 238, 219, .04);
            border: 1px solid rgba(112, 171, 175, .15);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            transition: border-color .2s;
        }

        .template-card:hover {
            border-color: var(--teal);
        }

        .template-name {
            font-size: .9rem;
            font-weight: 600;
            color: var(--cream);
        }

        .template-detail {
            font-size: .8rem;
            color: rgba(255, 238, 219, .5);
            margin-top: 2px;
        }

        .btn-dl {
            background: var(--purple);
            color: var(--cream);
            font-size: .8rem;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 50px;
            text-decoration: none;
            white-space: nowrap;
            transition: background .2s;
        }

        .btn-dl:hover {
            background: #5649c0;
            color: var(--cream);
        }

        .submit-cta-box {
            background: var(--purple);
            border-radius: 16px;
            padding: 32px 28px;
            text-align: center;
        }

        .submit-cta-box h3 {
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--cream);
            margin-bottom: 8px;
        }

        .submit-cta-box p {
            font-size: .88rem;
            color: rgba(255, 238, 219, .7);
            margin-bottom: 20px;
        }

        .btn-submit {
            display: inline-block;
            background: var(--orange);
            color: #fff;
            font-weight: 700;
            font-size: .95rem;
            padding: 14px 36px;
            border-radius: 50px;
            text-decoration: none;
            transition: background .2s;
        }

        .btn-submit:hover {
            background: #e55a1a;
            color: #fff;
        }

        /* ── REGISTRATION ── */
        #registration {
            background: var(--navy);
        }

        .reg-table-wrap {
            margin-top: 48px;
            overflow-x: auto;
            border-radius: 20px;
            border: 1px solid rgba(112, 171, 175, .15);
        }

        .reg-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .9rem;
        }

        .reg-table th {
            background: rgba(112, 171, 175, .08);
            color: var(--teal);
            font-weight: 700;
            font-family: 'Clash Display', sans-serif;
            font-size: .85rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            padding: 18px 24px;
            text-align: left;
            border-bottom: 1px solid rgba(112, 171, 175, .15);
        }

        .reg-table td {
            padding: 18px 24px;
            color: rgba(255, 238, 219, .8);
            border-bottom: 1px solid rgba(112, 171, 175, .08);
            vertical-align: top;
            line-height: 1.6;
        }

        .reg-table tr:last-child td {
            border-bottom: none;
        }

        .reg-table tr:hover td {
            background: rgba(112, 171, 175, .04);
        }

        .price-highlight {
            color: var(--orange);
            font-weight: 700;
            font-family: 'Clash Display', sans-serif;
        }

        .reg-note {
            margin-top: 24px;
            background: rgba(248, 102, 36, .08);
            border: 1px solid rgba(248, 102, 36, .2);
            border-radius: 12px;
            padding: 16px 20px;
            font-size: .88rem;
            color: rgba(255, 238, 219, .7);
        }

        /* ── VENUE ── */
        #venue {
            background: var(--navy-2);
        }

        .venue-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
            margin-top: 48px;
        }

        .venue-info h3 {
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--cream);
            margin-bottom: 8px;
        }

        .venue-info .venue-sub {
            color: var(--teal);
            font-weight: 500;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .venue-address {
            font-size: .95rem;
            color: rgba(255, 238, 219, .65);
            line-height: 1.8;
            margin-bottom: 32px;
        }

        .venue-map {
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(112, 171, 175, .15);
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 12px;
        }

        .venue-map iframe {
            width: 100%;
            height: 340px;
            border: none;
            border-radius: 14px;
        }

        .venue-photo {
            border-radius: 20px;
            overflow: hidden;
            height: 220px;
            margin-bottom: 16px;
            border: 1px solid rgba(112, 171, 175, .15);
        }

        .venue-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* ── PARTNERS ── */
        #partners {
            background: var(--navy);
        }

        .partners-heading {
            text-align: center;
            margin-bottom: 14px;
        }

        .partners-sub {
            text-align: center;
            color: rgba(255, 238, 219, .68);
            max-width: 780px;
            margin: 0 auto 42px;
            line-height: 1.6;
            font-size: .95rem;
        }

        .partners-logo-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .partner-logo-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 126px;
            padding: 16px 14px;
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid rgba(255, 255, 255, .2);
            box-shadow: 0 2px 12px rgba(0, 0, 0, .08);
            text-decoration: none;
            transition: transform .2s, box-shadow .2s;
        }

        .partner-logo-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .16);
        }

        .partner-logo-image {
            width: 100%;
            height: 54px;
            object-fit: contain;
            object-position: center;
            display: block;
        }

        .partner-logo-name {
            color: #304250;
            font-size: .76rem;
            text-align: center;
            line-height: 1.35;
            font-weight: 600;
        }

        .publishing-row {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .publishing-pill {
            border: 1px solid rgba(248, 102, 36, .35);
            color: var(--orange);
            background: rgba(248, 102, 36, .08);
            border-radius: 999px;
            padding: 10px 16px;
            font-size: .82rem;
            font-weight: 700;
        }

        .photo-carousel {
            width: min(100%, 1200px);
            position: relative;
            left: auto;
            right: auto;
            margin-left: auto;
            margin-right: auto;
            margin-top: 42px;
            overflow: hidden;
            border: 1px solid rgba(112, 171, 175, .2);
            border-radius: 16px;
            background: rgba(3, 23, 40, .8);
        }

        .photo-track {
            display: flex;
            transition: transform .45s ease;
            will-change: transform;
        }

        .photo-slide {
            min-width: 100%;
            aspect-ratio: 16 / 9;
            height: auto;
            position: relative;
        }

        .photo-slide img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            background: #081c2f;
        }

        .photo-caption {
            position: absolute;
            left: 20px;
            bottom: 20px;
            background: rgba(0, 0, 0, .45);
            color: var(--cream);
            font-size: .85rem;
            border-radius: 8px;
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, .2);
        }

        .photo-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .25);
            background: rgba(2, 19, 33, .7);
            color: var(--cream);
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 2;
        }

        .photo-control:hover {
            background: rgba(2, 19, 33, .9);
        }

        .photo-control-prev {
            left: 14px;
        }

        .photo-control-next {
            right: 14px;
        }

        .photo-dots {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 2;
        }

        .photo-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .55);
            background: transparent;
            cursor: pointer;
            padding: 0;
        }

        .photo-dot.is-active {
            background: var(--orange);
            border-color: var(--orange);
        }

        /* ── CONTACT ── */
        #contact {
            background: var(--cream);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
            margin-top: 48px;
        }

        #contact .section-tag {
            color: #2f536b;
        }

        #contact .section-heading {
            color: var(--navy);
        }

        .contact-info p {
            color: rgba(0, 26, 45, .72);
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .contact-email {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: rgba(0, 26, 45, .03);
            border: 1px solid rgba(0, 26, 45, .16);
            border-radius: 14px;
            padding: 18px 24px;
            text-decoration: none;
            color: var(--navy);
            font-weight: 700;
            font-size: 1.05rem;
            transition: border-color .2s, background .2s;
        }

        .contact-email:hover {
            border-color: var(--teal);
            background: rgba(112, 171, 175, .16);
            color: var(--navy);
        }

        .contact-email-icon {
            font-size: 1.3rem;
        }

        .contact-details {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .contact-card {
            background: var(--cream);
            border: 1px solid rgba(0, 26, 45, .12);
            border-radius: 14px;
            padding: 20px 22px;
        }

        .contact-photo {
            border-radius: 14px;
            overflow: hidden;
            height: 150px;
            border: 1px solid rgba(112, 171, 175, .12);
        }

        .contact-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .contact-card strong {
            display: block;
            color: var(--teal);
            font-size: .85rem;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .contact-card p {
            font-size: .95rem;
            color: rgba(0, 26, 45, .72);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--navy);
            border-top: 1px solid rgba(112, 171, 175, .1);
            padding: 48px 64px 32px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 48px;
            margin-bottom: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(112, 171, 175, .1);
        }

        .footer-brand-name {
            font-family: 'Clash Display', sans-serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--cream);
            margin-bottom: 6px;
        }

        .footer-brand-sub {
            font-size: .85rem;
            color: var(--teal);
            margin-bottom: 16px;
        }

        .footer-contact {
            font-size: .9rem;
            color: rgba(255, 238, 219, .6);
        }

        .footer-contact a {
            color: var(--teal);
            text-decoration: none;
        }

        .footer-links-col h4 {
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: rgba(255, 238, 219, .4);
            margin-bottom: 14px;
            font-weight: 700;
        }

        .footer-links-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-links-col a {
            font-size: .9rem;
            color: rgba(255, 238, 219, .65);
            text-decoration: none;
            transition: color .2s;
        }

        .footer-links-col a:hover {
            color: var(--cream);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: .82rem;
            color: rgba(255, 238, 219, .3);
        }

        .footer-badge {
            background: var(--purple);
            color: var(--cream);
            font-size: .75rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 50px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            section {
                padding: 80px 40px;
            }

            #hero {
                padding: 120px 40px 60px;
            }

            .hero-grid {
                flex-direction: column;
            }

            .ticket-card {
                max-width: 100%;
            }

            .about-grid,
            .speakers-grid,
            .program-grid,
            .submission-grid,
            .venue-grid,
            .contact-grid,
            .features-grid,
            .dates-grid,
            .themes-grid,
            .partners-logo-grid {
                grid-template-columns: 1fr;
            }

            .cta-card {
                flex-direction: column;
            }

            .cta-right {
                width: 100%;
                border-left: none;
                border-top: 1px dashed rgba(0, 26, 45, .15);
            }

            .cta-perforation {
                display: none;
            }

            footer {
                padding: 48px 40px 32px;
            }

            .footer-top {
                flex-direction: column;
                gap: 32px;
            }
        }

        @media (max-width: 768px) {
            section {
                padding: 60px 20px;
            }

            #hero {
                padding: 100px 20px 48px;
            }

            .hero-doodle {
                opacity: .45;
                width: 420px;
                height: 220px;
            }

            .hero-doodle.d1 {
                left: -210px;
                top: 90px;
            }

            .hero-doodle.d2 {
                right: -260px;
                top: 140px;
            }

            .hero-doodle.d3 {
                bottom: -220px;
                width: 520px;
                height: 260px;
            }

            .hero-doodle.d4 {
                left: 52%;
                top: 240px;
                width: 420px;
                height: 220px;
                opacity: .38;
            }

            .hero-doodle.d5 {
                left: 58%;
                top: 380px;
                width: 420px;
                height: 220px;
                opacity: .34;
            }

            .hero-doodle.d6 {
                left: 56%;
                top: 150px;
                width: 380px;
                height: 200px;
                opacity: .3;
            }

            .hero-doodle.d7 {
                left: 50%;
                top: 520px;
                width: 360px;
                height: 190px;
                opacity: .26;
            }

            .nav-inner {
                padding: 12px 20px;
            }

            .nav-links {
                display: none;
            }

            footer {
                padding: 40px 20px 24px;
            }
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav class="nav">
        <div class="nav-inner">
            <a class="nav-brand" href="#">
                <span class="nav-brand-name">SAIMechE 2026</span>
                <span class="nav-brand-sub">2026 · Johannesburg, South Africa</span>
            </a>
            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <!--
                <li><a href="#dates">Key Dates</a></li>
                <li><a href="#speakers">Speakers</a></li>
                <li><a href="#program">Program</a></li>
                -->
                <li><a href="#venue">Venue</a></li>
                <li><a href="#contact">Contact</a></li>
                
                <li>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-nav btn-nav-square">Dashboard</a>
                    @else
                        <div class="nav-auth-actions">
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn-nav btn-nav-square">Login</a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-nav btn-nav-square">Register</a>
                            @endif
                        </div>
                    @endauth
                </li>
            </ul>
        </div>
    </nav>

    <!-- HERO -->
    <section id="hero">
        <div class="hero-bg"></div>
        <div class="hero-doodles" aria-hidden="true">
            <div class="hero-doodle d1 is-teal"></div>
            <div class="hero-doodle d2 is-orange"></div>
            <div class="hero-doodle d3 is-purple"></div>
           
            <div class="hero-doodle d6 is-yellow"></div>
            <div class="hero-doodle d7 is-red"></div>
        </div>
        <div class="hero-grid">
            <div class="hero-left">
                <span class="hero-tag">University of the Witwatersrand</span>
                <h1 class="hero-title">2026 SAIMechE Central Branch Postgraduate Conference</h1>
                <p class="hero-subtitle">Actionable insights for postgraduate engineers, researchers and industry
                    collaborators</p>

            </div>
            
        </div>
    </section>

    <!-- MARQUEE 1 -->
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

    <!-- ABOUT -->
    <section id="about">
        <div class="section-inner">
            <div class="about-grid">
                <div class="about-text">
                    <span class="section-tag">About the Conference</span>
                    <h2 class="section-heading">SAIMechE Postgraduate Conference explores advanced engineering research.
                    </h2>
                   
                   
                    
                </div>
                <div class="about-img-wrap">
                    <div class="about-img-box">
                        <div class="about-img-text">
                            <h3>University of the Witwatersrand</h3>
                            <p>South West Engineering Building<br>East Campus · Jan Smuts Avenue<br>Braamfontein,
                                Johannesburg</p>
                        </div>
                    </div>
                    
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
                <div class="theme-card">
                  
                    <h4>Mechanical Design</h4>
                    
                </div>
                <div class="theme-card">
                    
                    <h4>Fluid Mechanics</h4>
                    
                </div>
                <div class="theme-card">
                    
                    <h4>Mechatronics</h4>
               
                </div>
                <div class="theme-card">
                    
                    <h4>Materials Science</h4>
                    
                </div>
                <div class="theme-card">
                  
                    <h4>Energy Systems</h4>
                    
                </div>
                <div class="theme-card">
                    
                    <h4>Operations Research</h4>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- MARQUEE 2 -->
    <div class="marquee-wrap marquee-teal">
        <div class="marquee-track">
            <div class="marquee-item">
                <span>Submission Deadline: 8 October 2026</span><span class="marquee-sep">|</span>
                <span>Camera-Ready: 23 October 2026</span><span class="marquee-sep">|</span>
                <span>Published in EPJ and Engineering Proceedings</span><span class="marquee-sep">|</span>
                <span>Scopus Indexed</span><span class="marquee-sep">|</span>
                <span>DHET Accredited</span><span class="marquee-sep">|</span>
                <span>Blind Peer Review</span><span class="marquee-sep">|</span>
            </div>
            <div class="marquee-item" aria-hidden="true">
                <span>Submission Deadline: 8 October 2026</span><span class="marquee-sep">|</span>
                <span>Camera-Ready: 23 October 2026</span><span class="marquee-sep">|</span>
                <span>Published in EPJ and Engineering Proceedings</span><span class="marquee-sep">|</span>
                <span>Scopus Indexed</span><span class="marquee-sep">|</span>
                <span>DHET Accredited</span><span class="marquee-sep">|</span>
                <span>Blind Peer Review</span><span class="marquee-sep">|</span>
            </div>
        </div>
    </div>

    <!-- IMPORTANT DATES 
    <section id="dates">
        <div class="section-inner">
            <span class="section-tag">Important Dates</span>
            <h2 class="section-heading">Mark your calendar</h2>
            <div class="dates-grid">
                <div class="date-card">
                    <div class="date-card-label">Submissions</div>
                    <h3>Closing date for all submissions</h3>
                    <div class="date-card-value">8 Oct 2026</div>
                    <p>Final deadline for all paper submissions including abstracts, extended abstracts, and full
                        papers.</p>
                </div>
                <div class="date-card">
                    <div class="date-card-label">Acceptance</div>
                    <h3>Notice of acceptance</h3>
                    <div class="date-card-value" style="color: var(--purple); font-size:1.2rem; padding-top:4px;">
                        Rolling notice</div>
                    <p>Authors will be notified of acceptance on an ongoing basis as peer reviews are completed.</p>
                </div>
                <div class="date-card">
                    <div class="date-card-label">Camera-Ready</div>
                    <h3>Final manuscript submission</h3>
                    <div class="date-card-value">23 Oct 2026</div>
                    <p>Accepted papers must be submitted in camera-ready format by this date for publication.</p>
                </div>
            </div>
        </div>
    </section>
    -->

    <!-- SPEAKERS 
<section id="speakers">
    <div class="section-inner">
        <span class="section-tag">Keynote Speakers</span>
        <h2 class="section-heading">Learn from industry leaders</h2>
        <div class="speakers-grid">
            <div class="speaker-card">
                <div class="speaker-avatar"><img src="/images/11.jpeg" alt="Speaker portrait"></div>
                <div>
                    <span class="speaker-time">09:00 AM · East Campus 1</span>
                    <div class="speaker-talk">The application of computational modelling in cardiovascular engineering</div>
                    <div class="speaker-name">Dr Kamran Hassani</div>
                    <div class="speaker-bio">Associate Professor, School of Mechanical, Industrial and Aeronautical Engineering, Wits University. Research expertise in biomechanics, cardiovascular engineering, and CFD/FSI modelling.</div>
                </div>
            </div>
            <div class="speaker-card">
                <div class="speaker-avatar"><img src="/images/12.jpeg" alt="Speaker portrait"></div>
                <div>
                    <span class="speaker-time">10:00 AM · East Campus 1</span>
                    <div class="speaker-talk">Advanced mechanical design through structural dynamic finite element model updating</div>
                    <div class="speaker-name">Prof. Shankar Sehgal</div>
                    <div class="speaker-bio">Professor & Head, Mechanical Engineering Dept., UIET, Panjab University. World's Top 2% Scientists (Elsevier, 2022). Scopus h-index: 26.</div>
                </div>
            </div>
            <div class="speaker-card">
                <div class="speaker-avatar"><img src="/images/13.jpeg" alt="Speaker portrait"></div>
                <div>
                    <span class="speaker-time">11:00 AM · East Campus 1</span>
                    <div class="speaker-talk">The Architect of Tomorrow: Innovation in Power Generation and Engineering Excellence</div>
                    <div class="speaker-name">Tebogo Mokoena</div>
                    <div class="speaker-bio">Senior Engineer, Turbine Department, Eskom Medupi Power Station. MEng (UJ). Registered Professional with ECSA. International experience at European Synchrotron Facility, France.</div>
                </div>
            </div>
            <div class="speaker-card">
                <div class="speaker-avatar"><img src="/images/14.jpeg" alt="Speaker portrait"></div>
                <div>
                    <span class="speaker-time">13:00 PM · East Campus 1</span>
                    <div class="speaker-talk">Determination if fueled with zeal travels with passion and its destination is success</div>
                    <div class="speaker-name">Benjamin Kgomotso Rahlogo</div>
                    <div class="speaker-bio">Professional Technologist (ECSA). MSc Technology Management (UP). Former Naval Assistant Marine Engineering Officer, SANDF. Senior Engineer at Eskom Medupi Power Station.</div>
                </div>
            </div>
        </div>
    </div>
</section>
-->

    <!-- PROGRAM 
<section id="program">
    <div class="section-inner">
        <span class="section-tag">Provisional Program</span>
        <h2 class="section-heading">A full day of engineering inspiration</h2>
        <p class="section-body" style="margin-bottom:0;">The detailed final programme will be released on <strong style="color:var(--orange)">10 October 2026</strong>.</p>
        <div class="program-grid">
            <div class="program-col">
                <h3>Morning Sessions</h3>
                <div class="program-item">
                    <div class="program-time">08:00</div>
                    <div class="program-dot"></div>
                    <div><div class="program-title">Registration</div></div>
                </div>
                <div class="program-item">
                    <div class="program-time">08:30</div>
                    <div class="program-dot"></div>
                    <div><div class="program-title">Welcome Remarks</div><div class="program-detail">Head of School, Mechanical, Industrial & Aeronautical Engineering</div></div>
                </div>
                <div class="program-item">
                    <div class="program-time">08:45</div>
                    <div class="program-dot"></div>
                    <div><div class="program-title">Opening Remarks</div><div class="program-detail">Chairman of SAIMechE Central Branch / CEO of SAIMechE</div></div>
                </div>
                <div class="program-item">
                    <div class="program-time">09:00</div>
                    <div class="program-dot"></div>
                    <div><div class="program-title">Keynote Speaker 1</div><div class="program-detail">Dr Kamran Hassani · Computational Modelling in Cardiovascular Engineering</div></div>
                </div>
                <div class="program-item">
                    <div class="program-time">09:35</div>
                    <div class="program-dot"></div>
                    <div>
                        <div class="program-title">Parallel Sessions 1</div>
                        <div class="program-sessions">
                            <span class="program-session-pill">Session 1a · 5 presentations</span>
                            <span class="program-session-pill">Session 1b · 5 presentations</span>
                            <span class="program-session-pill">Session 1c · 5 presentations</span>
                        </div>
                    </div>
                </div>
                <div class="program-item">
                    <div class="program-time">10:50</div>
                    <div class="program-dot break"></div>
                    <div><div class="program-title" style="color:var(--orange);">Tea Break</div></div>
                </div>
                <div class="program-item">
                    <div class="program-time">11:05</div>
                    <div class="program-dot"></div>
                    <div>
                        <div class="program-title">Parallel Sessions 2</div>
                        <div class="program-sessions">
                            <span class="program-session-pill">Session 2a · 6 presentations</span>
                            <span class="program-session-pill">Session 2b · 6 presentations</span>
                            <span class="program-session-pill">Session 2c · 6 presentations</span>
                        </div>
                    </div>
                </div>
                <div class="program-item">
                    <div class="program-time">12:35</div>
                    <div class="program-dot break"></div>
                    <div><div class="program-title" style="color:var(--orange);">Lunch Break</div></div>
                </div>
            </div>
            <div class="program-col">
                <h3>Afternoon Sessions</h3>
                <div class="program-item">
                    <div class="program-time">13:35</div>
                    <div class="program-dot"></div>
                    <div>
                        <div class="program-title">Parallel Sessions 3</div>
                        <div class="program-sessions">
                            <span class="program-session-pill">Session 3a · 6 presentations</span>
                            <span class="program-session-pill">Session 3b · 6 presentations</span>
                            <span class="program-session-pill">Session 3c · 6 presentations</span>
                        </div>
                    </div>
                </div>
                <div class="program-item">
                    <div class="program-time">15:05</div>
                    <div class="program-dot break"></div>
                    <div><div class="program-title" style="color:var(--orange);">Tea Break</div></div>
                </div>
                <div class="program-item">
                    <div class="program-time">15:20</div>
                    <div class="program-dot"></div>
                    <div>
                        <div class="program-title">Parallel Sessions 4</div>
                        <div class="program-sessions">
                            <span class="program-session-pill">Session 4a · 3 presentations</span>
                            <span class="program-session-pill">Session 4b · 3 presentations</span>
                            <span class="program-session-pill">Session 4c · 3 presentations</span>
                        </div>
                    </div>
                </div>
                <div class="program-item">
                    <div class="program-time">16:05</div>
                    <div class="program-dot"></div>
                    <div><div class="program-title">Keynote Speaker 2</div><div class="program-detail">Benjamin Kgomotso Rahlogo · Closing Keynote</div></div>
                </div>
                <div class="program-item">
                    <div class="program-time">16:35</div>
                    <div class="program-dot"></div>
                    <div><div class="program-title">Closing Remarks</div></div>
                </div>
            </div>
        </div>
    </div>
</section>
-->

    <!-- MARQUEE 3 
    <div class="marquee-wrap marquee-orange">
        <div class="marquee-track">
            <div class="marquee-item">
                <span>Wits University</span><span class="marquee-sep">|</span>
                <span>University of Johannesburg</span><span class="marquee-sep">|</span>
                <span>University of Pretoria</span><span class="marquee-sep">|</span>
                <span>UNISA</span><span class="marquee-sep">|</span>
                <span>Tshwane University of Technology</span><span class="marquee-sep">|</span>
                <span>Vaal University of Technology</span><span class="marquee-sep">|</span>
                <span>Durban University of Technology</span><span class="marquee-sep">|</span>
                <span>North West University</span><span class="marquee-sep">|</span>
            </div>
            <div class="marquee-item" aria-hidden="true">
                <span>Wits University</span><span class="marquee-sep">|</span>
                <span>University of Johannesburg</span><span class="marquee-sep">|</span>
                <span>University of Pretoria</span><span class="marquee-sep">|</span>
                <span>UNISA</span><span class="marquee-sep">|</span>
                <span>Tshwane University of Technology</span><span class="marquee-sep">|</span>
                <span>Vaal University of Technology</span><span class="marquee-sep">|</span>
                <span>Durban University of Technology</span><span class="marquee-sep">|</span>
                <span>North West University</span><span class="marquee-sep">|</span>
            </div>
        </div>
    </div>

    -->

    
    
    <section id="gallery">
        <div class="section-inner">
            <span class="section-tag">Conference Moments</span>
            <h2 class="section-heading">Photos from past sessions and labs</h2>
        </div>
        <div class="photo-carousel" data-carousel>
            <button class="photo-control photo-control-prev" type="button" aria-label="Previous slide"
                data-carousel-prev>&lsaquo;</button>
            <button class="photo-control photo-control-next" type="button" aria-label="Next slide"
                data-carousel-next>&rsaquo;</button>
            <div class="photo-track" data-carousel-track>
                <div class="photo-slide"><img src="/images/3.jpeg" alt="Conference moment 1"><span
                        class="photo-caption">Conference moment 1</span></div>
                <div class="photo-slide"><img src="/images/4.jpeg" alt="Conference moment 2"><span
                        class="photo-caption">Conference moment 2</span></div>
                <div class="photo-slide"><img src="/images/5.jpeg" alt="Conference moment 3"><span
                        class="photo-caption">Conference moment 3</span></div>
                <div class="photo-slide"><img src="/images/6.jpeg" alt="Conference moment 4"><span
                        class="photo-caption">Conference moment 4</span></div>
                <div class="photo-slide"><img src="/images/7.jpeg" alt="Conference moment 5"><span
                        class="photo-caption">Conference moment 5</span></div>
                <div class="photo-slide"><img src="/images/8.jpeg" alt="Conference moment 6"><span
                        class="photo-caption">Conference moment 6</span></div>
                <div class="photo-slide"><img src="/images/9.jpeg" alt="Conference moment 7"><span
                        class="photo-caption">Conference moment 7</span></div>
                <div class="photo-slide"><img src="/images/10.jpeg" alt="Conference moment 8"><span
                        class="photo-caption">Conference moment 8</span></div>
            </div>
            <div class="photo-dots" data-carousel-dots></div>
        </div>
    </section>

    <!-- CTA TICKET -->
    <section id="cta" style="padding: 80px 64px;">
        <div class="cta-inner">
            <div class="cta-card">
                <div class="cta-left">
                    <h2>Get your name on the delegate list now</h2>
                    <a class="btn-cta" href="https://cmt3.research.microsoft.com/SCMERD2025" target="_blank">Submit Your
                        Paper</a>
                </div>
                <div class="cta-perforation">
                    <div class="perf-dots">
                        @for ($i = 0; $i < 20; $i++)
                            <div class="perf-dot"></div>
                        @endfor
                    </div>
                </div>
                <div class="cta-right">
                    <div class="cta-right-label">Abstract Submission</div>
                    <div class="cta-right-from">from</div>
                    <div class="cta-right-price">6 Jan</div>
                    
                </div>
            </div>
        </div>
    </section>


   

   
    <!-- VENUE -->
    <section id="venue">
        <div class="section-inner">
            <span class="section-tag">Conference Venue</span>
            <h2 class="section-heading">Dynamic learning in the heart of Johannesburg</h2>
            <div class="venue-grid">
                <div class="venue-info">
                    <h3>South West Engineering Building</h3>
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
            <span class="section-tag partners-heading">Partner Universities</span>
            <h2 class="section-heading partners-heading">Partner Universities</h2>
            <p class="partners-sub">A collaboration of leading South African universities and engineering schools
                supporting postgraduate innovation.</p>

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
                    <img class="partner-logo-image" src="/unilogos/Vaal-University-of-Technology.webp"
                        alt="Vaal University of Technology logo">
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
                    <img class="partner-logo-image" src="/unilogos/wits-logo.jpg"
                        alt="University of the Witwatersrand logo">
                    <span class="partner-logo-name">University of the Witwatersrand (Host)</span>
                </a>
            </div>

           
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact">
        <div class="section-inner">
            <div class="contact-grid">
                <div class="contact-info">
                    <span class="section-tag">Get in Touch</span>
                    <h2 class="section-heading">Contact us</h2>
                    <p>For any queries or questions regarding the conference, we are here to assist you with information
                        about submissions, registration, speaker invitations, or any other conference-related matters.
                    </p>
                    <a class="contact-email" href="mailto:info@scmerd.org">
                        <span class="contact-email-icon">@</span>
                        info@scmerd.org
                    </a>
                </div>
                <div class="contact-details">
                    <div class="contact-card">
                        <strong>Organised by</strong>
                        <p>SAIMechE Central Branch<br>School of Mechanical, Industrial & Aeronautical
                            Engineering<br>University of the Witwatersrand</p>
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
                    <div class="footer-contact">
                        <a href="mailto:info@scmerd.org">info@scmerd.org</a>
                    </div>
                </div>
                <div class="footer-links-col">
                    <h4>Conference</h4>
                    <ul>
                        <li><a href="#about">About</a></li>
                        <li><a href="#dates">Key Dates</a></li>
                        <li><a href="#speakers">Speakers</a></li>
                        <li><a href="#program">Programme</a></li>
                    </ul>
                </div>
                <div class="footer-links-col">
                    <h4>Authors</h4>
                    <ul>
                        <li><a href="#submission">Submission</a></li>
                        <li><a href="#registration">Registration</a></li>
                        <li><a href="/SAIMechE conference flyer 2025.pdf" target="_blank">2026 Conference Flyer</a></li>
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
                <span>© 2026 SAIMechE Central Branch. All rights reserved.</span>
                <span class="footer-badge">SAIMechE PGC 2026</span>
            </div>
        </div>
    </footer>

    <script>
        (() => {
            const carousel = document.querySelector('[data-carousel]');
            if (!carousel) return;

            const track = carousel.querySelector('[data-carousel-track]');
            const slides = Array.from(track.children);
            const prev = carousel.querySelector('[data-carousel-prev]');
            const next = carousel.querySelector('[data-carousel-next]');
            const dotsWrap = carousel.querySelector('[data-carousel-dots]');
            let current = 0;
            let timer = null;
            let touchStartX = 0;

            const dots = slides.map((_, i) => {
                const b = document.createElement('button');
                b.type = 'button';
                b.className = 'photo-dot' + (i === 0 ? ' is-active' : '');
                b.setAttribute('aria-label', `Go to slide ${i + 1}`);
                b.addEventListener('click', () => goTo(i, true));
                dotsWrap.appendChild(b);
                return b;
            });

            function goTo(index, resetTimer = false) {
                current = (index + slides.length) % slides.length;
                track.style.transform = `translateX(-${current * 100}%)`;
                dots.forEach((d, i) => d.classList.toggle('is-active', i === current));
                if (resetTimer) startAuto();
            }

            function startAuto() {
                if (timer) clearInterval(timer);
                timer = setInterval(() => goTo(current + 1), 4500);
            }

            prev.addEventListener('click', () => goTo(current - 1, true));
            next.addEventListener('click', () => goTo(current + 1, true));

            carousel.addEventListener('mouseenter', () => timer && clearInterval(timer));
            carousel.addEventListener('mouseleave', startAuto);

            carousel.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].clientX;
            }, { passive: true });

            carousel.addEventListener('touchend', (e) => {
                const delta = e.changedTouches[0].clientX - touchStartX;
                if (Math.abs(delta) > 40) goTo(current + (delta < 0 ? 1 : -1), true);
            }, { passive: true });

            goTo(0);
            startAuto();
        })();
    </script>
</body>

</html>