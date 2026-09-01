@php($shellClass = 'cp-shell' . (isset($narrow) && $narrow ? ' cp-shell--narrow' : ''))

<div class="{{ $shellClass }}">
    @include('partials.topbar')
