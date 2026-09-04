<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-100 text-zinc-950 antialiased">
        <main class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-6">
            <div class="w-full max-w-md">
                <a href="{{ route('home') }}" class="mb-6 flex justify-center" wire:navigate aria-label="Home">
                    <x-app-logo-icon class="h-16 w-auto max-w-[180px]" />
                    <span class="sr-only">SAIMechE</span>
                </a>

                <div class="rounded-xl border border-zinc-300 bg-white p-7 shadow-lg shadow-zinc-950/10 sm:p-10">
                    {{ $slot }}
                </div>
            </div>
        </main>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
