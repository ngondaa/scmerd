<x-layouts::auth.simple :title="$title ?? null">
    <div class="min-h-screen bg-zinc-50 px-4 py-10 text-zinc-800">
        <div class="mx-auto max-w-md pt-8">
            {{ $slot }}
        </div>
    </div>
</x-layouts::auth.simple>
