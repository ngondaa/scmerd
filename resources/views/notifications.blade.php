<x-layouts::app :title="__('Notifications')">
    <div class="mx-auto w-full max-w-4xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Author Notifications</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Recent updates on your submissions and actions.</p>
        </div>

        @if (count($notifications) === 0)
            <div class="rounded-xl border border-dashed border-zinc-300 p-8 text-center text-sm text-zinc-600 dark:border-zinc-700 dark:text-zinc-300">
                No notifications yet.
            </div>
        @else
            <div class="space-y-3">
                @foreach ($notifications as $notification)
                    <div class="rounded-lg border border-zinc-200 px-4 py-3 dark:border-zinc-700">
                        <p class="text-sm text-zinc-800 dark:text-zinc-100">{{ $notification['message'] }}</p>
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ $notification['at'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts::app>
