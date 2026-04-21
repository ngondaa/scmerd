<x-layouts::app :title="__('Instructions')">
    <div class="mx-auto w-full max-w-4xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Author Instructions</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Read before submitting to avoid desk rejection.</p>
        </div>

        <div class="rounded-xl border border-neutral-200 p-5 dark:border-neutral-700">
            <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Submission Guidelines</h2>
            <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-zinc-700 dark:text-zinc-300">
                <li>Use the correct track and stage for each submission.</li>
                <li>Provide a clear title, author details, and complete abstract text.</li>
                <li>Upload your manuscript/materials as a single primary attachment.</li>
                <li>Follow deadlines for revisions and camera-ready upload.</li>
                <li>Use rebuttal only to clarify reviewer concerns with evidence.</li>
            </ul>
        </div>
    </div>
</x-layouts::app>
