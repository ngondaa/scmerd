<style>
:root {
    --cp-bg: #FFFFFF;
    --cp-paper: #FFFFFF;
    --cp-ink: #141413;
    --cp-ink-soft: #6B6B6B;
    --cp-ink-faint: #9B9B9B;
    --cp-line: #E8E8E4;
    --cp-line-strong: #D4D4CF;
    --cp-hover: #FFFFFF;
    --cp-serif: 'Newsreader', Georgia, 'Times New Roman', serif;
    --cp-sans: 'Inter', ui-sans-serif, system-ui, sans-serif;
}

.portal-body {
    margin: 0;
    background: var(--cp-bg);
    color: var(--cp-ink);
    font-family: var(--cp-sans);
    font-size: 15px;
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
}

.portal-main {
    min-height: 100vh;
}

.cp-shell {
    max-width: 1080px;
    margin: 0 auto;
    padding: 0 28px 64px;
}

.cp-shell--narrow { max-width: 760px; }

/* ── Header / topbar (Anthropic-style) ── */
.cp-header {
    position: sticky;
    top: 0;
    z-index: 100;
    background: var(--cp-bg);
    border-bottom: 1px solid var(--cp-line);
    margin: 0 -28px 48px;
    padding: 0 28px;
}

.cp-header-inner {
    max-width: 1080px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
    padding: 16px 0;
}

.cp-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: var(--cp-ink);
    flex-shrink: 0;
}

.cp-brand img {
    height: 52px;
    width: auto;
    max-width: 140px;
    object-fit: contain;
}

.cp-brand-wordmark {
    font-family: var(--cp-sans);
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: var(--cp-ink);
}

.cp-nav-cluster {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-left: auto;
    min-width: 0;
}

.cp-nav {
    display: flex;
    align-items: center;
    gap: 18px;
}

.cp-nav-item {
    font-size: 14px;
    font-weight: 400;
    color: var(--cp-ink);
    text-decoration: none;
    opacity: 0.72;
    white-space: nowrap;
    transition: opacity 0.15s;
}

.cp-nav-item:hover,
.cp-nav-item.active {
    opacity: 1;
}

.cp-nav-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
}

.cp-nav-logout {
    display: inline-flex;
    align-items: center;
    margin: 0;
}

.cp-nav-logout-button {
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font: inherit;
}

.cp-nav-secondary {
    font-size: 14px;
    font-weight: 400;
    color: var(--cp-ink);
    text-decoration: none;
    opacity: 0.72;
    white-space: nowrap;
    transition: opacity 0.15s;
}

.cp-nav-secondary:hover {
    opacity: 1;
}

.cp-nav-cta {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--cp-ink);
    color: #fff;
    padding: 9px 18px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
    transition: background 0.15s;
}

.cp-nav-cta:hover {
    background: #333;
    color: #fff;
}

.cp-nav-toggle {
    display: none;
    background: none;
    border: none;
    width: 40px;
    height: 40px;
    padding: 0;
    cursor: pointer;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.cp-nav-toggle span {
    display: block;
    width: 20px;
    height: 2px;
    background: var(--cp-ink);
    transition: transform 0.2s, opacity 0.2s;
}

.cp-nav-toggle.open span:first-child {
    transform: translateY(4px) rotate(45deg);
}

.cp-nav-toggle.open span:last-child {
    transform: translateY(-4px) rotate(-45deg);
}

/* ── Page hero ── */
.cp-hero {
    margin-bottom: 40px;
    padding-bottom: 32px;
    border-bottom: 1px solid var(--cp-line);
}

.cp-hero--row {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
}

.cp-kicker {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--cp-ink-faint);
    margin-bottom: 10px;
}

.cp-hello {
    font-family: var(--cp-serif);
    font-size: clamp(32px, 4vw, 44px);
    font-weight: 500;
    color: var(--cp-ink);
    letter-spacing: -0.02em;
    line-height: 1.1;
    margin: 0;
}

.cp-hello-sub {
    font-size: 15px;
    color: var(--cp-ink-soft);
    margin-top: 10px;
    max-width: 52ch;
}

.cp-big-stats {
    display: flex;
    gap: 32px;
}

.cp-big-num {
    font-family: var(--cp-serif);
    font-size: 36px;
    font-weight: 500;
    color: var(--cp-ink);
    line-height: 1;
}

.cp-big-label {
    font-size: 12px;
    color: var(--cp-ink-faint);
    margin-top: 4px;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

/* ── Layout grids ── */
.cp-main-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: var(--cp-line);
    border: 1px solid var(--cp-line);
    margin-bottom: 1px;
}

.cp-bottom-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: var(--cp-line);
    border: 1px solid var(--cp-line);
    border-top: none;
}

.cp-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1px;
    background: var(--cp-line);
    border: 1px solid var(--cp-line);
}

.cp-module-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: var(--cp-line);
    border: 1px solid var(--cp-line);
    margin-top: 20px;
}

/* ── Cards ── */
.cp-card {
    background: var(--cp-paper);
    padding: 28px;
}

.cp-card--inset {
    margin-bottom: 16px;
    border: 1px solid var(--cp-line);
}

.cp-card-title {
    font-family: var(--cp-serif);
    font-size: 18px;
    font-weight: 500;
    color: var(--cp-ink);
    margin-bottom: 4px;
}

.cp-card-desc {
    font-size: 13px;
    color: var(--cp-ink-soft);
    margin-bottom: 0;
}

.cp-card-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--cp-line);
}

.cp-card-dark {
    background: var(--cp-ink);
    color: var(--cp-paper);
    padding: 28px;
}

.cp-card-dark .cp-card-title {
    color: var(--cp-paper);
}

.cp-card-dark .cp-card-desc {
    color: rgba(255, 255, 255, 0.62);
}

/* ── Module tiles ── */
.cp-mod-card {
    display: block;
    background: var(--cp-paper);
    padding: 20px;
    text-decoration: none;
    transition: background 0.15s;
}

.cp-mod-card:hover {
    background: var(--cp-hover);
}

.cp-mod-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--cp-ink);
    margin-bottom: 4px;
}

.cp-mod-desc {
    font-size: 13px;
    color: var(--cp-ink-soft);
}

/* ── Quick actions ── */
.cp-qa-list {
    margin-top: 20px;
}

.cp-qa-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.12);
    text-decoration: none;
    transition: opacity 0.15s;
}

.cp-qa-item:first-child {
    border-top: none;
    padding-top: 0;
}

.cp-qa-item:hover {
    opacity: 0.78;
}

.cp-qa-title {
    font-size: 14px;
    font-weight: 500;
    color: var(--cp-paper);
}

.cp-qa-sub {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.5);
    margin-top: 2px;
}

.cp-qa-chev {
    color: rgba(255, 255, 255, 0.45);
    font-size: 18px;
}

/* ── Submissions list ── */
.cp-sub-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    padding: 14px 0;
    border-bottom: 1px solid var(--cp-line);
}

.cp-sub-row:last-child {
    border-bottom: none;
}

.cp-sub-title {
    font-family: var(--cp-serif);
    font-size: 20px;
    font-weight: 500;
    color: var(--cp-ink);
    margin: 0;
}

.cp-sub-meta {
    font-size: 13px;
    color: var(--cp-ink-soft);
    margin-top: 4px;
}

.cp-item-title {
    font-size: 15px;
    font-weight: 500;
    color: var(--cp-ink);
}

.cp-item-meta {
    font-size: 13px;
    color: var(--cp-ink-soft);
    margin-top: 4px;
}

/* ── Badges (monochrome) ── */
.cp-badge {
    font-size: 11px;
    font-weight: 500;
    padding: 3px 10px;
    border: 1px solid var(--cp-line-strong);
    color: var(--cp-ink-soft);
    white-space: nowrap;
    letter-spacing: 0.03em;
    text-transform: uppercase;
}

.cp-badge-review {
    background: var(--cp-hover);
    color: var(--cp-ink);
    border-color: var(--cp-line-strong);
}

.cp-badge-rebuttal {
    background: var(--cp-paper);
    color: var(--cp-ink);
    border-color: var(--cp-ink);
}

.cp-badge-accepted {
    background: var(--cp-ink);
    color: var(--cp-paper);
    border-color: var(--cp-ink);
}

.cp-badge-pending {
    background: transparent;
    color: var(--cp-ink-faint);
}

/* ── Sections ── */
.cp-section-title {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--cp-ink-faint);
    margin-bottom: 12px;
}

.cp-lifecycle {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1px;
    background: var(--cp-line);
    border: 1px solid var(--cp-line);
    margin-bottom: 24px;
}

.cp-step {
    background: var(--cp-paper);
    padding: 10px 8px;
    font-size: 11px;
    text-align: center;
    color: var(--cp-ink-soft);
}

.cp-text {
    font-size: 14px;
    color: var(--cp-ink);
    line-height: 1.65;
    margin-bottom: 24px;
    white-space: pre-wrap;
}

.cp-list {
    font-size: 14px;
    color: var(--cp-ink);
    line-height: 1.65;
    padding-left: 20px;
    margin-bottom: 20px;
}

.cp-list li {
    margin-bottom: 6px;
}

.cp-meta-text {
    font-size: 12px;
    color: var(--cp-ink-faint);
    margin-top: -12px;
    margin-bottom: 20px;
}

.cp-actions {
    display: flex;
    gap: 20px;
    padding-top: 16px;
    border-top: 1px solid var(--cp-line);
}

/* ── Forms ── */
.cp-two-col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: start;
}

.cp-col {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.cp-form-group {
    margin-bottom: 0;
}

.cp-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--cp-ink);
    margin-bottom: 8px;
}

.cp-input,
.cp-textarea,
.cp-select {
    width: 100%;
    border: 1px solid var(--cp-line-strong);
    border-radius: 0;
    padding: 11px 14px;
    font-size: 14px;
    font-family: inherit;
    color: var(--cp-ink);
    background: var(--cp-paper);
    outline: none;
    box-sizing: border-box;
    transition: border-color 0.15s;
}

.cp-input:focus,
.cp-textarea:focus,
.cp-select:focus {
    border-color: var(--cp-ink);
}

.cp-textarea {
    resize: vertical;
    min-height: 340px;
    line-height: 1.6;
}

.cp-input-file {
    font-size: 13px;
    color: var(--cp-ink-soft);
}

.cp-input-file::file-selector-button {
    background: var(--cp-ink);
    color: var(--cp-paper);
    border: none;
    padding: 8px 14px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    margin-right: 12px;
    font-family: inherit;
}

.cp-footer {
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--cp-line);
}

.cp-error {
    font-size: 12px;
    color: #8B2E2E;
    margin-top: 6px;
}

.cp-help-text {
    font-size: 12px;
    color: var(--cp-ink-faint);
    margin-top: 6px;
}

/* ── Buttons & links ── */
.cp-btn-primary {
    display: inline-block;
    background: var(--cp-ink);
    color: var(--cp-paper);
    border: 1px solid var(--cp-ink);
    padding: 11px 22px;
    font-size: 14px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s, color 0.15s;
}

.cp-btn-primary:hover {
    background: transparent;
    color: var(--cp-ink);
}

.cp-btn-link {
    font-size: 14px;
    font-weight: 500;
    color: var(--cp-ink);
    text-decoration: none;
    border-bottom: 1px solid var(--cp-line-strong);
    padding-bottom: 1px;
    transition: border-color 0.15s;
}

.cp-btn-link:hover {
    border-bottom-color: var(--cp-ink);
}

/* ── Empty & alerts ── */
.cp-empty {
    text-align: center;
    padding: 48px 28px;
    background: var(--cp-paper);
    border: 1px dashed var(--cp-line-strong);
}

.cp-empty-text {
    font-size: 14px;
    color: var(--cp-ink-soft);
    margin-bottom: 16px;
}

.cp-status-alert {
    background: var(--cp-hover);
    color: var(--cp-ink);
    padding: 14px 18px;
    font-size: 14px;
    margin-bottom: 28px;
    border: 1px solid var(--cp-line);
    border-left: 3px solid var(--cp-ink);
}

.cp-summary {
    font-size: 14px;
    color: var(--cp-ink-soft);
    line-height: 1.7;
}

@media (max-width: 960px) {
    .cp-nav-secondary {
        display: none;
    }

    .cp-nav {
        gap: 16px;
    }
}

@media (max-width: 768px) {
    .cp-shell {
        padding: 0 20px 48px;
    }

    .cp-header {
        margin: 0 -20px 36px;
        padding: 0 20px;
    }

    .cp-header-inner {
        flex-wrap: wrap;
        padding: 14px 0;
    }

    .cp-nav-cluster {
        width: 100%;
        flex-direction: column;
        align-items: stretch;
        gap: 0;
    }

    .cp-nav {
        display: none;
        flex-direction: column;
        align-items: stretch;
        gap: 0;
        width: 100%;
        border-top: 1px solid var(--cp-line);
        padding: 8px 0 0;
        margin-top: 12px;
    }

    .cp-nav.open {
        display: flex;
    }

    .cp-nav-item {
        padding: 12px 0;
        font-size: 15px;
        opacity: 1;
        border-bottom: 1px solid var(--cp-line);
    }

    .cp-nav-item:last-child {
        border-bottom: none;
    }

    .cp-nav-actions {
        width: 100%;
        justify-content: space-between;
        margin-top: 12px;
    }

    .cp-nav-toggle {
        display: flex;
    }

    .cp-nav-cta {
        flex: 1;
        justify-content: center;
    }

    .cp-main-grid,
    .cp-bottom-row,
    .cp-grid,
    .cp-two-col {
        grid-template-columns: 1fr;
    }

    .cp-lifecycle {
        grid-template-columns: 1fr 1fr;
    }

    .cp-hero--row {
        flex-direction: column;
        align-items: flex-start;
    }
}

/* ── Package Selection Grid ── */
.cp-card-highlight {
    background: #FFFFFF;
    border: 2px solid #A41E22;
}

.package-form {
    display: contents;
}

.packages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-top: 24px;
}

.package-option {
    display: contents;
}

.package-option input[type="radio"] {
    display: none;
}

.package-card {
    display: block;
    padding: 24px;
    border: 2px solid var(--cp-line-strong);
    border-radius: 8px;
    background: var(--cp-paper);
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.package-option input[type="radio"]:checked + .package-card {
    border-color: #A41E22;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(164, 30, 34, 0.1);
}

.package-card:hover {
    border-color: #A41E22;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.package-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}

.package-header h3 {
    margin: 0;
    font-family: var(--cp-sans);
    font-size: 16px;
    font-weight: 600;
    color: var(--cp-ink);
}

.package-price {
    font-family: var(--cp-sans);
    font-size: 18px;
    font-weight: 700;
    color: #A41E22;
}

.package-desc {
    margin: 8px 0 16px;
    font-size: 13px;
    color: var(--cp-ink-soft);
}

.package-features {
    list-style: none;
    margin: 0;
    padding: 0;
    font-size: 13px;
}

.package-features li {
    padding: 6px 0;
    padding-left: 20px;
    position: relative;
    color: var(--cp-ink-soft);
    border-bottom: 1px solid var(--cp-line);
}

.package-features li:last-child {
    border-bottom: none;
}

.package-features li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #A41E22;
    font-weight: bold;
}

.btn {
    display: inline-block;
    text-decoration: none;
    font-weight: 700;
    font-size: 14.5px;
    padding: 14px 24px;
    border: 1.5px solid var(--cp-ink);
    cursor: pointer;
    font-family: var(--cp-sans);
    background: white;
    color: var(--cp-ink);
    border-radius: 4px;
    transition: all 0.15s ease;
}

.btn:hover {
    background: var(--cp-ink);
    color: white;
}

.btn-primary {
    background: #A41E22;
    color: white;
    border-color: #A41E22;
}

.btn-primary:hover {
    background: #7A1418;
    border-color: #7A1418;
}

.btn-secondary {
    background: white;
    color: #A41E22;
    border-color: #A41E22;
}

.btn-secondary:hover {
    background: #A41E22;
    color: white;
}

@media (max-width: 640px) {
    .packages-grid {
        grid-template-columns: 1fr;
    }
}

/* ── Reviewer workspace ── */
.reviewer-page { max-width: 960px; margin: 0 auto; padding-bottom: 64px; }
.reviewer-page h1, .reviewer-page h2 { font-family: var(--cp-serif); font-weight: 500; color: var(--cp-ink); }
.reviewer-page-header { display:flex; justify-content:space-between; align-items:flex-end; gap:24px; padding-bottom:24px; margin-bottom:24px; border-bottom:1px solid var(--cp-line); }
.reviewer-page-header h1 { margin:0; font-size:36px; line-height:1.15; letter-spacing:-.02em; }
.reviewer-page-header p { color:var(--cp-ink-soft); margin:8px 0 0; }
.reviewer-header-actions, .reviewer-form-actions { display:flex; align-items:flex-end; gap:8px; flex-wrap:wrap; }
.reviewer-button { display:inline-flex; align-items:center; justify-content:center; min-height:42px; box-sizing:border-box; border:1px solid var(--cp-ink); border-radius:6px; padding:10px 16px; color:var(--cp-ink); background:#fff; font-size:13px; font-weight:650; text-decoration:none; cursor:pointer; font-family:inherit; }
.reviewer-button:hover { background:#f6f6f4; }
.reviewer-button--dark { background:var(--cp-ink); color:#fff; }
.reviewer-button--dark:hover { background:#30302d; color:#fff; }
.reviewer-button--maroon { background:#9b1c1f; color:#fff; border-color:#9b1c1f; }
.reviewer-button--maroon:hover { background:#7d171a; color:#fff; }
.reviewer-toolbar { display:flex; align-items:center; gap:8px; padding:16px; border:1px solid var(--cp-line); border-radius:8px; margin-bottom:16px; }
.reviewer-search { flex:1 1 260px; }.reviewer-search input, .reviewer-select-wrap select, .reviewer-comment-form textarea, .reviewer-comment-form select { width:100%; box-sizing:border-box; border:1px solid var(--cp-line-strong); border-radius:6px; background:#fff; color:var(--cp-ink); font:inherit; font-size:14px; padding:10px 12px; }
.reviewer-search input:focus, .reviewer-select-wrap select:focus, .reviewer-comment-form textarea:focus, .reviewer-comment-form select:focus, .reviewer-row:focus-visible, .reviewer-button:focus-visible, .reviewer-back-link:focus-visible, .reviewer-adjacent-nav a:focus-visible { outline:3px solid #9b1c1f; outline-offset:3px; }
.reviewer-select-wrap { flex:0 1 150px; }.reviewer-filter-button { padding:10px 14px; background:#fff; border:1px solid var(--cp-line-strong); border-radius:6px; font:inherit; font-weight:600; cursor:pointer; }.reviewer-count { margin:0 0 0 auto; color:var(--cp-ink-soft); font-size:13px; white-space:nowrap; }
.reviewer-list { border:1px solid var(--cp-line); border-radius:8px; overflow:hidden; }.reviewer-row { display:flex; align-items:center; justify-content:space-between; gap:24px; padding:24px; border-bottom:1px solid var(--cp-line); text-decoration:none; color:inherit; transition:background .15s; }.reviewer-row:last-child { border-bottom:0; }.reviewer-row:hover { background:#fafaf8; }.reviewer-row-copy { min-width:0; }.reviewer-row h2 { font-size:22px; line-height:1.25; margin:0; }.reviewer-excerpt { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; margin:8px 0; color:var(--cp-ink-soft); line-height:1.55; }.reviewer-meta { margin:0; color:var(--cp-ink-faint); font-size:13px; }.reviewer-attachment { display:inline-block; margin-left:8px; color:var(--cp-ink); font-weight:700; transform:rotate(-35deg); }.reviewer-row-aside { display:flex; align-items:center; gap:16px; flex-shrink:0; }.reviewer-chevron { color:var(--cp-ink-faint); font-size:28px; line-height:1; }.reviewer-status { display:inline-block; border-radius:999px; padding:5px 9px; font-size:11px; font-weight:700; line-height:1.2; white-space:nowrap; background:#f2f2ef; color:var(--cp-ink); }.reviewer-status--accepted { color:#fff; background:var(--cp-ink); }.reviewer-status--rejected { border:1px solid var(--cp-ink); background:#fff; }.reviewer-status--revisions-requested { background:#eeeae5; }.reviewer-empty { padding:56px 24px; border:1px dashed var(--cp-line-strong); border-radius:8px; text-align:center; }.reviewer-empty h2 { margin:0; font-size:24px; }.reviewer-empty p { color:var(--cp-ink-soft); margin:8px auto 20px; max-width:46ch; }.reviewer-toast { padding:12px 16px; border-left:3px solid #9b1c1f; border:1px solid var(--cp-line); border-left-color:#9b1c1f; margin-bottom:16px; }.reviewer-pagination { margin-top:24px; }
.reviewer-back-link { display:inline-block; color:var(--cp-ink); font-size:14px; font-weight:600; text-decoration:none; margin-bottom:24px; }.reviewer-back-link:hover, .reviewer-adjacent-nav a:hover { text-decoration:underline; }.reviewer-detail-header { border-bottom:1px solid var(--cp-line); padding-bottom:24px; }.reviewer-detail-title-line { display:flex; align-items:flex-start; gap:16px; flex-wrap:wrap; }.reviewer-detail-title-line h1 { font-size:36px; line-height:1.15; margin:0; }.reviewer-detail-meta { margin:12px 0 0; color:var(--cp-ink-soft); }.reviewer-download-bar { display:flex; justify-content:space-between; align-items:center; gap:16px; padding:16px; margin-top:24px; border:1px solid var(--cp-line); border-radius:8px; }.reviewer-download-bar strong, .reviewer-download-bar span { display:block; }.reviewer-download-bar span { color:var(--cp-ink-soft); font-size:13px; margin-top:2px; }.reviewer-detail-section { margin-top:40px; }.reviewer-detail-section h2, .reviewer-comment-form h2 { font-size:24px; margin:0 0 16px; }.reviewer-abstract-panel { max-width:72ch; white-space:pre-wrap; padding:24px; border:1px solid var(--cp-line); border-radius:8px; background:#fafaf8; line-height:1.75; }.reviewer-timeline { border-left:1px solid var(--cp-line-strong); margin-left:6px; padding-left:24px; }.reviewer-comment { position:relative; padding-bottom:24px; }.reviewer-comment:before { content:""; position:absolute; width:9px; height:9px; border-radius:50%; background:#9b1c1f; left:-29px; top:6px; }.reviewer-comment-head { display:flex; gap:12px; flex-wrap:wrap; }.reviewer-comment time, .reviewer-muted, .reviewer-comment-status { color:var(--cp-ink-soft); font-size:13px; }.reviewer-comment p { margin:6px 0; white-space:pre-wrap; }.reviewer-comment-form { padding:24px; margin-top:32px; border:1px solid var(--cp-line); border-radius:8px; }.reviewer-comment-form label { display:block; font-size:13px; font-weight:700; margin-bottom:8px; }.reviewer-comment-form textarea { resize:vertical; min-height:140px; }.reviewer-form-actions { justify-content:space-between; margin-top:16px; }.reviewer-form-actions select { min-width:220px; }.reviewer-error { margin:6px 0 0; color:#9b1c1f; font-size:13px; }.reviewer-adjacent-nav { display:flex; justify-content:space-between; margin-top:40px; padding-top:24px; border-top:1px solid var(--cp-line); }.reviewer-adjacent-nav a { color:var(--cp-ink); font-size:14px; font-weight:650; text-decoration:none; }
@media (max-width: 700px) { .reviewer-page-header { align-items:flex-start; flex-direction:column; }.reviewer-header-actions { width:100%; }.reviewer-header-actions .reviewer-button { flex:1; }.reviewer-toolbar { flex-wrap:wrap; }.reviewer-select-wrap { flex:1 1 145px; }.reviewer-count { width:100%; margin:0; }.reviewer-row { padding:20px 16px; align-items:flex-start; }.reviewer-row-aside { gap:8px; }.reviewer-row h2 { font-size:20px; }.reviewer-detail-title-line h1, .reviewer-page-header h1 { font-size:30px; }.reviewer-download-bar { align-items:flex-start; flex-direction:column; }.reviewer-form-actions { align-items:stretch; flex-direction:column; }.reviewer-form-actions .reviewer-button { width:100%; }.reviewer-form-actions select { min-width:0; } }
</style>
