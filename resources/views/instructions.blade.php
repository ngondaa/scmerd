<x-layouts::app :title="__('Instructions')">

@include('partials.portal.open')

<div class="cp-hero">
    <p class="cp-kicker">Guidelines</p>
    <h1 class="cp-hello">Author instructions</h1>
    <p class="cp-hello-sub">Read before submitting to avoid desk rejection.</p>
</div>

<div class="cp-card cp-card--inset">
    <h2 class="cp-sub-title">Submission guidelines</h2>
    <ul class="cp-list">
        <li>Use the correct track and stage for each submission.</li>
        <li>Provide a clear title, author details, and complete abstract text.</li>
        <li>Upload your manuscript or materials as a single primary attachment.</li>
        <li>Follow deadlines for revisions and camera-ready upload.</li>
        <li>Use rebuttal only to clarify reviewer concerns with evidence.</li>
    </ul>
</div>

@include('partials.portal.close')

</x-layouts::app>
