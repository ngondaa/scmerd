<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0..72,400;0..72,500;0..72,600;1..72,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        @include('partials.portal.styles')
    </head>
    <body class="portal-body">
        <main class="portal-main">
            {{ $slot }}
        </main>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
        @include('partials.portal.scripts')
    </body>
</html>
