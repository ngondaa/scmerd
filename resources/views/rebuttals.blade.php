<x-layouts::app :title="__('Rebuttals')">
    <div class="mx-auto w-full max-w-5xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Rebuttal</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Respond to review comments from the author side.</p>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-700/60 dark:bg-emerald-900/20 dark:text-emerald-300">
                {{ session('status') }}
            </div>
        @endif

        @if (count($submissions) === 0)
            <div class="rounded-xl border border-dashed border-zinc-300 p-8 text-center text-sm text-zinc-600 dark:border-zinc-700 dark:text-zinc-300">
                No submissions available for rebuttal yet.
            </div>
        @else
            <div class="space-y-4">
                @foreach ($submissions as $submission)
                    <div class="rounded-xl border border-neutral-200 p-5 dark:border-neutral-700">
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">{{ $submission['title'] }}</h2>
                        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Current status: {{ $submission['status'] }}</p>

                        <div class="mt-4">
                            <h3 class="text-sm font-semibold uppercase tracking-wide text-zinc-700 dark:text-zinc-300">Reviewer Comments</h3>
                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-zinc-700 dark:text-zinc-200">
                                @foreach ($submission['comments'] as $comment)
                                    <li>{{ $comment }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <form method="POST" action="{{ route('rebuttals.store', $submission['id']) }}" class="mt-4">
                            @csrf
                            <label for="rebuttal-{{ $submission['id'] }}" class="block text-sm font-medium text-zinc-800 dark:text-zinc-100">Your Rebuttal</label>
                            <textarea
                                id="rebuttal-{{ $submission['id'] }}"
                                name="rebuttal"
                                rows="4"
                                class="mt-1 w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-500 focus:outline-none dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100"
                            >{{ $submission['rebuttal'] ?? '' }}</textarea>
                            @error('rebuttal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="mt-3 inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-300">
                                Submit Rebuttal
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts::app>
