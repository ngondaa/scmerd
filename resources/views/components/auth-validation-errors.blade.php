@props(['exclude' => []])

@php
    $messages = collect($errors->getMessages())
        ->except($exclude)
        ->flatten();
@endphp

@if ($messages->isNotEmpty())
    <div class="rounded-md border border-red-300 bg-red-50 px-4 py-3 text-sm font-medium text-red-800" role="alert">
        <ul class="list-disc space-y-1 pl-5">
            @foreach ($messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
