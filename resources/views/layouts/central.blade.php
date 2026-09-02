<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.central.head')
</head>
<body class="pattern-waves">
    @hasSection('announce')
        @yield('announce')
    @else
        @include('partials.central.announce')
    @endif

    @include('partials.central.header')

    @yield('content')

    @include('partials.central.footer')
    @include('partials.central.scripts')
</body>
</html>
