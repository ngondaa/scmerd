<x-layouts::auth.card :title="$title ?? null">
    <div class="min-h-screen bg-white px-4 py-10 text-black">
        <div class="mx-auto max-w-md pt-8 text-black">
            {{ $slot }}
        </div>
    </div>
</x-layouts::auth.card>
