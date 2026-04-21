<x-layouts::app :title="__('Abstracts')">
    <div class="mx-auto w-full max-w-5xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Abstract Review</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
                Track each abstract's review process and reviewer comments.
            </p>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-700/60 dark:bg-emerald-900/20 dark:text-emerald-300">
                {{ session('status') }}
            </div>
        @endif

        @if (count($submissions) === 0)
            <div class="rounded-xl border border-dashed border-zinc-300 p-8 text-center dark:border-zinc-700">
                <p class="text-sm text-zinc-600 dark:text-zinc-300">No abstracts submitted yet.</p>
                <a href="{{ route('submit') }}" class="mt-3 inline-block text-sm font-medium text-blue-600 hover:text-blue-500">
                    Submit your first abstract
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($submissions as $submission)
                    <div class="rounded-xl border border-neutral-200 p-5 dark:border-neutral-700">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">{{ $submission['title'] }}</h2>
                                <p class="text-sm text-zinc-600 dark:text-zinc-300">Author: {{ $submission['author'] }} | Track: {{ $submission['track'] }}</p>
                            </div>
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                                {{ $submission['status'] }}
                            </span>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-sm font-semibold uppercase tracking-wide text-zinc-700 dark:text-zinc-300">Submission Lifecycle</h3>
                            <div class="mt-2 grid gap-2 md:grid-cols-4">
                                @foreach (['Abstract Submitted', 'Under Review', 'Rebuttal', 'Decision'] as $step)
                                    <div class="rounded-md border border-zinc-200 px-2 py-1 text-xs dark:border-zinc-700">
                                        {{ $step }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-sm font-semibold uppercase tracking-wide text-zinc-700 dark:text-zinc-300">Abstract</h3>
                            <p class="mt-2 whitespace-pre-line text-sm text-zinc-700 dark:text-zinc-200">{{ $submission['abstract'] }}</p>
                        </div>

                        <div class="mt-5">
                            <h3 class="text-sm font-semibold uppercase tracking-wide text-zinc-700 dark:text-zinc-300">Review Process & Comments</h3>
                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-zinc-700 dark:text-zinc-200">
                                @foreach ($submission['comments'] as $comment)
                                    <li>{{ $comment }}</li>
                                @endforeach
                            </ul>
                            <p class="mt-3 text-xs text-zinc-500 dark:text-zinc-400">Submitted: {{ $submission['submitted_at'] }}</p>
                        </div>

                        <div class="mt-5 flex flex-wrap gap-3">
                            @if (!empty($submission['attachment_path']))
                                <a href="{{ route('downloads.attachment', $submission['id']) }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                    Download Attachment
                                </a>
                            @endif
                            <a href="{{ route('rebuttals') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                Open Rebuttal
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts::app>
