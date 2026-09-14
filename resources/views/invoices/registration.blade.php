<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice {{ $user->payment_invoice_number }}</title>
    <style>
        body { margin: 0; background: #f5f6f3; color: #1d2e1d; font-family: Arial, sans-serif; }
        .invoice { box-sizing: border-box; max-width: 820px; min-height: 100vh; margin: auto; padding: 52px; background: #fff; }
        .header { display: flex; justify-content: space-between; gap: 24px; padding-bottom: 28px; border-bottom: 3px solid #203a20; }
        .brand { margin: 0; color: #203a20; font-size: 14px; font-weight: 700; letter-spacing: 1.6px; text-transform: uppercase; }
        h1 { margin: 10px 0 0; font-size: 32px; }
        .reference { text-align: right; font-size: 14px; line-height: 1.6; }
        .reference strong { display: block; font-size: 17px; }
        .section { margin-top: 34px; }
        h2 { margin: 0 0 12px; color: #687568; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; }
        p { margin: 4px 0; line-height: 1.5; }
        table { width: 100%; margin-top: 24px; border-collapse: collapse; }
        th, td { padding: 14px; border-bottom: 1px solid #dde4d8; text-align: left; }
        th { background: #f4f6f2; color: #526052; font-size: 12px; text-transform: uppercase; }
        td:last-child, th:last-child { text-align: right; }
        .total td { border-top: 2px solid #203a20; color: #203a20; font-size: 18px; font-weight: 700; }
        .status { display: inline-block; margin-top: 22px; padding: 8px 12px; background: {{ $user->registration_status === 'paid' ? '#eaf5eb' : '#fff6db' }}; color: #203a20; font-size: 13px; font-weight: 700; }
        .bank { margin-top: 38px; padding: 20px; background: #f4f6f2; }
        @media print { body { background: #fff; } .invoice { max-width: none; padding: 0; } }
    </style>
</head>
<body>
    <main class="invoice">
        <header class="header">
            <div>
                <p class="brand">SCMERD Conference</p>
                <h1>Registration invoice</h1>
            </div>
            <div class="reference">
                <span>Invoice reference</span>
                <strong>{{ $user->payment_invoice_number }}</strong>
                <span>Issued {{ $user->created_at?->format('d M Y') }}</span>
            </div>
        </header>

        <section class="section">
            <h2>Bill to</h2>
            <p><strong>{{ $user->name }}</strong></p>
            <p>{{ $user->email }}</p>
            @if ($user->certificate_name)<p>Certificate name: {{ $user->certificate_name }}</p>@endif
            @if ($user->ecsa_number)<p>ECSA number: {{ $user->ecsa_number }}</p>@endif
            @if ($user->student_id)<p>Student number: {{ $user->student_id }}</p>@endif
        </section>

        <table>
            <thead><tr><th>Description</th><th>Amount</th></tr></thead>
            <tbody>
                <tr><td>{{ $package['name'] ?? ucfirst((string) $user->registration_package) }}</td><td>{{ $package['display_price'] ?? '—' }}</td></tr>
                <tr class="total"><td>Total due</td><td>{{ $package['display_price'] ?? '—' }}</td></tr>
            </tbody>
        </table>

        <div class="status">Payment status: {{ ucfirst(str_replace('_', ' ', $user->registration_status)) }}</div>

        <section class="bank">
            <h2>Bank transfer details</h2>
            <p><strong>{{ config('registration.payment.bank_name') }}</strong> · {{ config('registration.payment.account_name') }}</p>
            <p>Account number: {{ config('registration.payment.account_number') }} · Branch code: {{ config('registration.payment.branch_code') }}</p>
            <p>Payment reference: {{ config('registration.payment.reference_prefix') }} - {{ $user->email }}</p>
        </section>
    </main>
</body>
</html>
