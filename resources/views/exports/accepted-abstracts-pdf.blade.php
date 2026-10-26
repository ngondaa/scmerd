<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Accepted abstracts</title>
    <style>
        @page { margin: 20mm 15mm; }
        body { color: #1d2e1d; font-family: DejaVu Sans, sans-serif; font-size: 10pt; }
        h1 { color: #203a20; font-size: 20pt; margin: 0 0 6px; }
        .meta { color: #526052; font-size: 9pt; margin: 0 0 18px; }
        table { border-collapse: collapse; width: 100%; }
        th { background: #203a20; color: #fff; font-size: 9pt; text-align: left; }
        th, td { border: 1px solid #d9e0d5; padding: 8px; vertical-align: top; }
        td { line-height: 1.4; }
        tr:nth-child(even) td { background: #f4f6f2; }
        .empty { border: 1px solid #d9e0d5; color: #526052; padding: 14px; }
    </style>
</head>
<body>
    <h1>Accepted abstracts</h1>
    <p class="meta">Generated {{ $generatedAt->format('d F Y, H:i') }} | {{ $submissions->count() }} accepted {{ Str::plural('abstract', $submissions->count()) }}</p>

    @if ($submissions->isEmpty())
        <p class="empty">There are no accepted abstracts.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th style="width: 47%;">Abstract title</th>
                    <th style="width: 28%;">Author</th>
                    <th style="width: 25%;">Field</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($submissions as $submission)
                    <tr>
                        <td>{{ $submission->title }}</td>
                        <td>{{ $submission->author }}</td>
                        <td>{{ $submission->track }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
