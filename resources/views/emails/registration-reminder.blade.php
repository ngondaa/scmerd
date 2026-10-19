<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete your registration</title>
</head>
<body style="margin:0; padding:24px; background:#f4f6f2; color:#1d2e1d; font-family:Arial, sans-serif;">
    @php($package = config('registration.packages.'.$user->registration_package, []))
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:620px; background:#ffffff; border:1px solid #e3e8df;">
                    <tr>
                        <td style="padding:30px 34px; background:#203a20; color:#ffffff;">
                            <div style="font-size:12px; font-weight:700; letter-spacing:1.4px; text-transform:uppercase;">Central Branch Conference</div>
                            <h1 style="margin:10px 0 0; font-size:26px; line-height:1.25;">Complete your registration</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px 34px;">
                            <p style="margin:0 0 16px; font-size:16px; line-height:1.6;">Hello {{ $user->name }},</p>
                            <p style="margin:0 0 16px; font-size:16px; line-height:1.6;">This is a friendly reminder to complete your Central Branch Conference registration.</p>
                            @if ($package)
                                <p style="margin:0 0 16px; font-size:16px; line-height:1.6;">Your selected package is <strong>{{ $package['name'] }}</strong>.</p>
                            @endif
                            <p style="margin:0 0 24px; font-size:16px; line-height:1.6;">Please sign in to choose a package if needed and upload your proof of payment so that we can confirm your place.</p>
                            <p style="margin:0;">
                                <a href="{{ url('/dashboard') }}" style="display:inline-block; padding:12px 18px; background:#203a20; color:#ffffff; font-size:15px; font-weight:700; text-decoration:none;">Complete registration</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
