<h1>Invoice and payment proof received</h1>

<p>This payment-review record and its attached proof belong together. Match the proof against the invoice number below before approving payment.</p>

<table cellpadding="6" cellspacing="0" border="0">
    <tr><th align="left">Invoice</th><td>{{ $user->payment_invoice_number }}</td></tr>
    <tr><th align="left">Delegate</th><td>{{ $user->name }}</td></tr>
    <tr><th align="left">Email</th><td>{{ $user->email }}</td></tr>
    <tr><th align="left">Package</th><td>{{ config('registration.packages.'.$user->registration_package.'.name', ucfirst((string) $user->registration_package)) }}</td></tr>
    <tr><th align="left">Amount due</th><td>{{ config('registration.packages.'.$user->registration_package.'.display_price') }}</td></tr>
    <tr><th align="left">Certificate name</th><td>{{ $user->certificate_name }}</td></tr>
    @if ($user->ecsa_accredited)
        <tr><th align="left">ECSA number</th><td>{{ $user->ecsa_number }}</td></tr>
    @endif
    @if ($user->student_id)
        <tr><th align="left">Student number</th><td>{{ $user->student_id }}</td></tr>
    @endif
</table>

<p>The uploaded payment proof is attached to this email. Replying to this message reaches {{ $user->name }} directly.</p>

<p>Approve or reject it in the administration panel after matching the attachment to invoice <strong>{{ $user->payment_invoice_number }}</strong>.</p>
