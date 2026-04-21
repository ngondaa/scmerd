<x-layouts::app :title="__('Dashboard')">
    <div class="mx-auto flex h-full w-full max-w-5xl flex-1 flex-col gap-6 rounded-xl">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Author Dashboard</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
                Submit abstracts, track review updates, manage rebuttals, and download your files.
            </p>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
                <p class="text-sm text-zinc-600 dark:text-zinc-300">Total Submissions</p>
                <p class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $stats['total'] ?? 0 }}</p>
            </div>
            <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
                <p class="text-sm text-zinc-600 dark:text-zinc-300">Under Review</p>
                <p class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $stats['under_review'] ?? 0 }}</p>
            </div>
            <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
                <p class="text-sm text-zinc-600 dark:text-zinc-300">Rebuttal / Accepted</p>
                <p class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ ($stats['rebuttal_open'] ?? 0) + ($stats['accepted'] ?? 0) }}</p>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <a href="{{ route('submit') }}" class="rounded-xl border border-neutral-200 p-5 transition hover:bg-zinc-50 dark:border-neutral-700 dark:hover:bg-zinc-900/40">
                <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Customizable Submission Form</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Abstract submission with metadata and optional file upload.</p>
            </a>
            <a href="{{ route('abstracts') }}" class="rounded-xl border border-neutral-200 p-5 transition hover:bg-zinc-50 dark:border-neutral-700 dark:hover:bg-zinc-900/40">
                <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Full Submission Life Cycle</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Track status timeline, review process, and comments.</p>
            </a>
            <a href="{{ route('tracks') }}" class="rounded-xl border border-neutral-200 p-5 transition hover:bg-zinc-50 dark:border-neutral-700 dark:hover:bg-zinc-900/40">
                <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Submission Track</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">This portal currently runs the Abstract Submission track only.</p>
            </a>
            <a href="{{ route('rebuttals') }}" class="rounded-xl border border-neutral-200 p-5 transition hover:bg-zinc-50 dark:border-neutral-700 dark:hover:bg-zinc-900/40">
                <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Rebuttal and Discussion</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Respond to review comments and keep author-side discussion.</p>
            </a>
            <a href="{{ route('notifications') }}" class="rounded-xl border border-neutral-200 p-5 transition hover:bg-zinc-50 dark:border-neutral-700 dark:hover:bg-zinc-900/40">
                <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Author Notifications</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Receive updates for submissions and rebuttal events.</p>
            </a>
            <a href="{{ route('downloads') }}" class="rounded-xl border border-neutral-200 p-5 transition hover:bg-zinc-50 dark:border-neutral-700 dark:hover:bg-zinc-900/40">
                <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Export and Download</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Download uploaded files and export your submission list to CSV.</p>
            </a>
        </div>

        <div class="rounded-xl border border-neutral-200 p-5 dark:border-neutral-700">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Recent Submissions</h3>
            @if (empty($submissions))
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">No submissions yet. Start from the submit page.</p>
            @else
                <div class="mt-3 space-y-2">
                    @foreach (array_slice($submissions, 0, 3) as $submission)
                        <div class="rounded-lg border border-zinc-200 px-3 py-2 text-sm dark:border-zinc-700">
                            <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $submission['title'] }}</span>
                            <span class="text-zinc-500 dark:text-zinc-400">- {{ $submission['status'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>
