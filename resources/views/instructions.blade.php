<x-layouts::app :title="__('Instructions')">
<style>
    .cp-shell { background: #f0f0f5; border-radius: 20px; padding: 16px; font-family: var(--font-sans, ui-sans-serif, system-ui, sans-serif); max-width: 1000px; margin: 0 auto; }
    .cp-hero { margin-bottom: 24px; padding: 0 4px; }
    .cp-hello { font-size: 28px; font-weight: 500; color: #1a1a2e; letter-spacing: -0.02em; line-height: 1.15; }
    .cp-hello-sub { font-size: 13px; color: #888; margin-top: 4px; }
    .cp-card { background: #fff; border-radius: 16px; padding: 20px; margin-bottom: 16px; }
    .cp-sub-title { font-size: 18px; font-weight: 500; color: #1a1a2e; margin-bottom: 12px; }
    .cp-list { font-size: 13px; color: #1a1a2e; line-height: 1.5; padding-left: 20px; }
    .cp-list li { margin-bottom: 8px; }
</style>

<div class="cp-shell">
    @include('partials.topbar')
    <div class="cp-hero">
        <h1 class="cp-hello">Author Instructions</h1>
        <p class="cp-hello-sub">Read before submitting to avoid desk rejection.</p>
    </div>

    <div class="cp-card">
        <h2 class="cp-sub-title">Submission Guidelines</h2>
        <ul class="cp-list">
            <li>Use the correct track and stage for each submission.</li>
            <li>Provide a clear title, author details, and complete abstract text.</li>
            <li>Upload your manuscript/materials as a single primary attachment.</li>
            <li>Follow deadlines for revisions and camera-ready upload.</li>
            <li>Use rebuttal only to clarify reviewer concerns with evidence.</li>
        </ul>
    </div>
</div>
</x-layouts::app>
