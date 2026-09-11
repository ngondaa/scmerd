@props(['errors' => $errors])

@if ($errors->any())
    <div class="rounded-md border border-red-300 bg-red-50 px-4 py-3 text-sm font-medium text-red-800" role="alert">
        <ul class="list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
