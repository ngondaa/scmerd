<x-layouts::auth.simple :title="$title ?? null">
    <div class="min-h-screen bg-[#f5f5f5] px-4 py-10 text-zinc-800">
        <div class="mx-auto flex max-w-[560px] flex-col items-center pt-12">
            <div class="w-full rounded-[28px] border border-zinc-200 bg-white/90 px-5 py-7 shadow-[0_18px_40px_rgba(24,24,27,0.05)] backdrop-blur-sm sm:px-8 sm:py-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts::auth.simple>
