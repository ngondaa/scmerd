<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration payment approved</title>
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
                            <h1 style="margin:10px 0 0; font-size:26px; line-height:1.25;">Your payment has been approved</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px 34px;">
                            <p style="margin:0 0 16px; font-size:16px; line-height:1.6;">Hello {{ $user->name }},</p>
                            <p style="margin:0 0 24px; font-size:16px; line-height:1.6;">We have approved your payment proof. Your conference registration is now confirmed.</p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #e3e8df; border-collapse:collapse; font-size:14px;">
                                <tr>
                                    <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; color:#687568;">Registration package</td>
                                    <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; font-weight:700;">{{ $package['name'] ?? ucfirst((string) $user->registration_package) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; color:#687568;">Includes</td>
                                    <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; font-weight:700;">{{ $package['description'] ?? 'Conference registration' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; color:#687568;">Registration fee</td>
                                    <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; font-weight:700;">{{ $package['display_price'] ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; color:#687568;">Name on certificate</td>
                                    <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; font-weight:700;">{{ $user->certificate_name }}</td>
                                </tr>
                                @if ($user->payment_invoice_number)
                                    <tr>
                                        <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; color:#687568;">Invoice reference</td>
                                        <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; font-weight:700;">{{ $user->payment_invoice_number }}</td>
                                    </tr>
                                @endif
                                @if ($user->ecsa_number)
                                    <tr>
                                        <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; color:#687568;">ECSA number</td>
                                        <td style="padding:12px 14px; border-bottom:1px solid #e3e8df; font-weight:700;">{{ $user->ecsa_number }}</td>
                                    </tr>
                                @endif
                                @if ($user->student_id)
                                    <tr>
                                        <td style="padding:12px 14px; color:#687568;">Student number</td>
                                        <td style="padding:12px 14px; font-weight:700;">{{ $user->student_id }}</td>
                                    </tr>
                                @endif
                            </table>

                            <p style="margin:24px 0 0; font-size:14px; line-height:1.6; color:#526052;">Please keep this email for your records. We look forward to welcoming you at Central Branch.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
