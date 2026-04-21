<x-layouts::app :title="__('Tracks')">
    <div class="mx-auto w-full max-w-5xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Submission Track</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Current scope is limited to abstract submission only.</p>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            @foreach ($tracks as $track)
                <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ $track }}</h2>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">
                        Your submissions: {{ count(array_filter($submissions, fn($s) => $s['track'] === $track)) }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts::app>
