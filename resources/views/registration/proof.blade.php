<x-layouts::app :title="__('Submit proof of payment')">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    <div class="cp-main-grid">
        <div class="cp-card">
            <h2 class="cp-card-title">Invoice & payment proof</h2>

            @if(session('status'))
                <p style="color:#1a7f37;">{{ session('status') }}</p>
            @endif

            <div style="display:grid; gap:18px; margin-bottom:22px;">
                <div style="border:1px solid #eaeaea; border-radius:10px; background:#fafaf8; padding:20px;">
                    <div style="display:flex; justify-content:space-between; gap:16px; align-items:flex-start; flex-wrap:wrap; margin-bottom:18px;">
                        <div>
                            <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666;">Invoice</div>
                            <div style="font-size:22px; font-weight:700; margin-top:4px;">{{ $invoiceNumber }}</div>
                        </div>
                        <div style="text-align:right; font-size:14px; color:#333;">
                            <div><strong>Bill to:</strong> {{ auth()->user()->name }}</div>
                            <div>{{ auth()->user()->email }}</div>
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:16px;">
                        <div>
                            <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666; margin-bottom:5px;">Package</div>
                            <div style="font-weight:700; font-size:18px;">{{ $package['name'] ?? ucfirst($packageKey) }}</div>
                        </div>
                        <div>
                            <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666; margin-bottom:5px;">Name on certificate</div>
                            <div style="font-weight:600;">{{ $certificateName ?: 'Not provided yet' }}</div>
                        </div>
                        <div>
                            <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666; margin-bottom:5px;">Total due</div>
                            <div style="font-weight:700; font-size:20px; color:#1d1d1d;">{{ $package['display_price'] ?? 'R0' }}</div>
                        </div>
                    </div>
                </div>

                <div style="border:1px solid #eaeaea; border-radius:10px; background:#fff; padding:20px;">
                    <h3 style="margin:0 0 12px; font-size:18px;">Bank transfer details</h3>
                    <div style="display:grid; gap:8px; font-size:14px; color:#2b2b2b;">
                        <div><strong>Bank:</strong> {{ config('registration.payment.bank_name', 'Conference Secretariat Bank') }}</div>
                        <div><strong>Account name:</strong> {{ config('registration.payment.account_name', 'SCMERD Conference Registration') }}</div>
                        <div><strong>Account number:</strong> {{ config('registration.payment.account_number', '0000000000') }}</div>
                        <div><strong>Branch code:</strong> {{ config('registration.payment.branch_code', '000000') }}</div>
                        <div><strong>Reference:</strong> {{ config('registration.payment.reference_prefix', 'SCMERD') }} - {{ auth()->user()->email }}</div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('registration.proof.store') }}" enctype="multipart/form-data">
                @csrf
                <div style="display:flex; gap:12px; flex-direction:column;">
                    <input type="hidden" name="package" value="{{ $packageKey }}">

                    <label>Name on certificate
                        <input type="text" name="certificate_name" value="{{ old('certificate_name', $certificateName) }}" required>
                    </label>

                    <label>Proof of payment (upload image/pdf)
                        <input type="file" name="proof" required>
                    </label>

                    <div
                        class="cf-turnstile"
                        data-sitekey="{{ config('services.turnstile.site_key') }}"
                        data-action="payment_proof_upload"
                    ></div>

                    <button class="btn btn-primary" type="submit">Submit proof of payment</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
