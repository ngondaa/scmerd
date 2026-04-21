<x-layouts::app :title="__('Downloads')">
    <div class="mx-auto w-full max-w-5xl space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Downloads and Export</h1>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Download uploaded files or export all submission records.</p>
            </div>
            <a href="{{ route('exports.submissions') }}" class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-300">
                Export CSV
            </a>
        </div>

        @if (count($submissions) === 0)
            <div class="rounded-xl border border-dashed border-zinc-300 p-8 text-center text-sm text-zinc-600 dark:border-zinc-700 dark:text-zinc-300">
                No files available yet.
            </div>
        @else
            <div class="space-y-3">
                @foreach ($submissions as $submission)
                    <div class="rounded-lg border border-zinc-200 px-4 py-3 dark:border-zinc-700">
                        <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $submission['title'] }}</p>
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ $submission['track'] }} | {{ $submission['stage'] }}</p>
                        @if (!empty($submission['attachment_path']))
                            <a href="{{ route('downloads.attachment', $submission['id']) }}" class="mt-2 inline-block text-sm font-medium text-blue-600 hover:text-blue-500">
                                Download {{ $submission['attachment_name'] ?? 'attachment' }}
                            </a>
                        @else
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">No attachment uploaded.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts::app>
