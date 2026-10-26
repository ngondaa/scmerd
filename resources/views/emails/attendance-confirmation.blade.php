<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm your attendance</title>
</head>
<body style="margin:0; padding:24px; background:#f4f6f2; color:#1d2e1d; font-family:Arial, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr><td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:620px; background:#ffffff; border:1px solid #e3e8df;">
                <tr><td style="padding:30px 34px; background:#203a20; color:#ffffff;">
                    <div style="font-size:12px; font-weight:700; letter-spacing:1.4px; text-transform:uppercase;">Central Branch Conference</div>
                    <h1 style="margin:10px 0 0; font-size:26px; line-height:1.25;">Please confirm your plans</h1>
                </td></tr>
                <tr><td style="padding:32px 34px;">
                    <p style="margin:0 0 16px; font-size:16px; line-height:1.6;">Hello {{ $user->name }},</p>
                    @if ($acceptedAbstractAuthor)
                        <p style="margin:0 0 22px; font-size:16px; line-height:1.6;"><strong>Your abstract has been accepted.</strong> We will share presentation and programme details with you shortly.</p>
                    @else
                        <p style="margin:0 0 22px; font-size:16px; line-height:1.6;">Please confirm whether you will attend the conference, with or without the gala dinner.</p>
                        <p style="margin:0 0 14px;"><a href="{{ $attendanceUrl }}" style="display:block; padding:13px 18px; background:#203a20; color:#ffffff; font-weight:700; text-align:center; text-decoration:none;">I am attending the conference</a></p>
                        <p style="margin:0;"><a href="{{ $galaDinnerUrl }}" style="display:block; padding:13px 18px; background:#7a5717; color:#ffffff; font-weight:700; text-align:center; text-decoration:none;">I am attending the conference and gala dinner</a></p>
                        <p style="margin:22px 0 0; font-size:13px; line-height:1.6; color:#526052;">Selecting the gala dinner option also confirms your conference attendance.</p>
                    @endif
                </td></tr>
            </table>
        </td></tr>
    </table>
</body>
</html>
