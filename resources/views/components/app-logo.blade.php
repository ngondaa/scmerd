@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand {{ $attributes }}>
        <x-slot name="logo">
            <x-app-logo-icon class="!h-9 !w-auto !max-w-[120px]" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand {{ $attributes }}>
        <x-slot name="logo">
            <x-app-logo-icon class="!h-9 !w-auto !max-w-[120px]" />
        </x-slot>
    </flux:brand>
@endif
