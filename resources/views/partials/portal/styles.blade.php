<style>
:root {
    --cp-bg: #F9F7F2;
    --cp-paper: #FFFFFF;
    --cp-ink: #141413;
    --cp-ink-soft: #6B6B6B;
    --cp-ink-faint: #9B9B9B;
    --cp-line: #E8E8E4;
    --cp-line-strong: #D4D4CF;
    --cp-hover: #F3F3F0;
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
    width: 28px;
    height: 28px;
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
    gap: 28px;
    margin-left: auto;
    min-width: 0;
}

.cp-nav {
    display: flex;
    align-items: center;
    gap: 22px;
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
    gap: 16px;
    flex-shrink: 0;
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
</style>
