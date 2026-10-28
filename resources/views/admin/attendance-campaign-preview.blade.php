<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Attendance confirmation campaign</title></head>
<body style="margin:0; padding:32px; background:#f4f6f2; color:#1d2e1d; font-family:Arial, sans-serif;">
    <main style="max-width:720px; margin:auto; background:#fff; border:1px solid #e3e8df; padding:32px;">
        <h1 style="margin-top:0;">{{ $programmeCampaign ? 'Accepted-abstract programme campaign' : ($acceptedAuthorsOnly ? 'Accepted-abstract author campaign' : ($onlyUnconfirmed ? 'Attendance confirmation reminder' : 'Attendance confirmation campaign')) }}</h1>
        @if (session('status'))<p style="padding:12px; background:#e7f4e4;">{{ session('status') }}</p>@endif
        <p>This campaign will send a personal email to <strong>{{ $recipientCount }}</strong> {{ ($acceptedAuthorsOnly || $programmeCampaign) ? 'author' : 'user' }} {{ Str::plural('account', $recipientCount) }}{{ ($acceptedAuthorsOnly || $programmeCampaign) ? ' with at least one accepted abstract' : ($onlyUnconfirmed ? ' who have not confirmed conference attendance' : '') }}.</p>
        @if ($programmeCampaign)
            <p>Each email includes the official 2026 conference programme as a PDF attachment and presenter preparation guidance.</p>
        @elseif ($acceptedAuthorsOnly)
            <p>Each email confirms the author’s accepted abstract and advises that programme details will follow.</p>
        @else
            <p>Each email contains two secure confirmation buttons:</p>
            <ul><li>Attending the conference</li><li>Attending the conference and gala dinner</li></ul>
        @endif
        <form method="post" action="{{ $programmeCampaign ? route('admin.accepted-abstract-programme-campaign.send') : ($acceptedAuthorsOnly ? route('admin.accepted-authors-campaign.send') : ($onlyUnconfirmed ? route('admin.unconfirmed-attendance-campaign.send') : route('admin.attendance-campaign.send'))) }}">
            @csrf
            <button type="submit" style="padding:12px 18px; border:0; background:#203a20; color:#fff; font-weight:700; cursor:pointer;">Send campaign to {{ $recipientCount }} recipients</button>
            <a href="{{ ($acceptedAuthorsOnly || $programmeCampaign) ? route('filament.admin.resources.submissions.index') : route('filament.admin.resources.users.index') }}" style="margin-left:14px; color:#203a20;">Cancel</a>
        </form>
    </main>
</body>
</html>
