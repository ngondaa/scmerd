<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Accepted abstract authors</title>
    <style>
        @page { margin: 20mm 15mm; }
        body { color: #1d2e1d; font-family: DejaVu Sans, sans-serif; font-size: 11pt; }
        h1 { color: #203a20; font-size: 20pt; margin: 0 0 6px; }
        .meta { color: #526052; font-size: 9pt; margin: 0 0 18px; }
        ol { margin: 0; padding-left: 28px; }
        li { border-bottom: 1px solid #d9e0d5; padding: 8px 4px; }
        .empty { border: 1px solid #d9e0d5; color: #526052; padding: 14px; }
    </style>
</head>
<body>
    <h1>Accepted abstract author names</h1>
    <p class="meta">Generated {{ $generatedAt->format('d F Y, H:i') }} | {{ $authors->count() }} {{ Str::plural('author', $authors->count()) }}</p>

    @if ($authors->isEmpty())
        <p class="empty">There are no linked user accounts for accepted abstracts.</p>
    @else
        <ol>
            @foreach ($authors as $author)
                <li>{{ $author }}</li>
            @endforeach
        </ol>
    @endif
</body>
</html>
