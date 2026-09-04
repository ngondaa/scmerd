@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <flux:heading size="xl" class="!text-zinc-950">{{ $title }}</flux:heading>
    <flux:subheading class="!text-zinc-700">{{ $description }}</flux:subheading>
</div>
