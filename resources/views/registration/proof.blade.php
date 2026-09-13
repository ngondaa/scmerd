<x-layouts::app :title="__('Submit proof of payment')">

    @push('styles')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/registration-payment.css') }}">
    @endpush

    <div class="rp-page">
        <header class="rp-hero">
            <div class="rp-hero-copy">
                <p class="rp-eyebrow">SCMERD · Registration payment</p>
                <h1 class="rp-title">Invoice &amp; payment proof</h1>
                <p class="rp-lede">Pay by bank transfer, then upload your receipt so we can unlock abstract submission.</p>
            </div>
            <ol class="rp-steps" aria-label="Registration progress">
                <li class="rp-step rp-step--done"><span>1</span> Package</li>
                <li class="rp-step rp-step--current" aria-current="step"><span>2</span> Payment proof</li>
            </ol>
        </header>

        @if(session('status'))
            <p class="rp-flash rp-flash--ok" role="status">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <div class="rp-flash rp-flash--err" role="alert">
                <strong>Please correct the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rp-layout">
            <aside class="rp-aside" aria-label="Invoice and bank details">
                <section class="rp-invoice">
                    <div class="rp-invoice-meta">
                        <div>
                            <p class="rp-label">Invoice</p>
                            <p class="rp-mono rp-invoice-id">{{ $invoiceNumber }}</p>
                        </div>
                        <div class="rp-billto">
                            <p class="rp-label">Bill to</p>
                            <p class="rp-strong">{{ auth()->user()->name }}</p>
                            <p class="rp-muted">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="rp-amount-block">
                        <p class="rp-label">Total due</p>
                        <p class="rp-amount">{{ $package['display_price'] ?? 'R0' }}</p>
                        <p class="rp-package">{{ $package['name'] ?? ucfirst($packageKey) }}</p>
                    </div>

                    <dl class="rp-facts">
                        <div>
                            <dt>Name on certificate</dt>
                            <dd>{{ $certificateName ?: 'Not provided yet' }}</dd>
                        </div>
                    </dl>
                </section>

                <section class="rp-bank">
                    <div class="rp-bank-head">
                        <h2>Bank transfer details</h2>
                        <p>Use this reference exactly so we can match your payment.</p>
                    </div>

                    <dl class="rp-bank-grid">
                        <div>
                            <dt>Bank</dt>
                            <dd>{{ config('registration.payment.bank_name', 'Conference Secretariat Bank') }}</dd>
                        </div>
                        <div>
                            <dt>Account name</dt>
                            <dd>{{ config('registration.payment.account_name', 'SCMERD Conference Registration') }}</dd>
                        </div>
                        <div>
                            <dt>Account number</dt>
                            <dd class="rp-mono">{{ config('registration.payment.account_number', '0000000000') }}</dd>
                        </div>
                        <div>
                            <dt>Branch code</dt>
                            <dd class="rp-mono">{{ config('registration.payment.branch_code', '000000') }}</dd>
                        </div>
                        <div class="rp-bank-grid__full">
                            <dt>Payment reference</dt>
                            <dd class="rp-mono rp-reference">{{ config('registration.payment.reference_prefix', 'SCMERD') }} - {{ auth()->user()->email }}</dd>
                        </div>
                    </dl>
                </section>
            </aside>

            <section class="rp-panel" aria-label="Submit payment proof">
                <form class="rp-form" method="POST" action="{{ route('registration.proof.store') }}" enctype="multipart/form-data" id="rp-proof-form">
                    @csrf
                    <input type="hidden" name="package" value="{{ $packageKey }}">

                    <div class="rp-form-intro">
                        <h2>Confirm &amp; upload</h2>
                        <p>Fill in your certificate details, then attach the transfer receipt.</p>
                    </div>

                    <label class="rp-field">
                        <span class="rp-field-label">Name on certificate</span>
                        <input class="rp-input" type="text" name="certificate_name" value="{{ old('certificate_name', $certificateName) }}" placeholder="Enter your full name" required autocomplete="name">
                        <span class="rp-help">This is how your name will appear on your certificate.</span>
                    </label>

                    <label class="rp-check">
                        <input type="hidden" name="ecsa_accredited" value="0">
                        <input type="checkbox" name="ecsa_accredited" value="1" id="rp-ecsa-toggle" @checked(old('ecsa_accredited', $ecsaAccredited))>
                        <span>
                            <strong>I require ECSA CPD recognition</strong>
                            <small>Provide your ECSA number if you are claiming CPD points.</small>
                        </span>
                    </label>

                    <label class="rp-field rp-field--ecsa" id="rp-ecsa-field" @if(! old('ecsa_accredited', $ecsaAccredited)) hidden @endif>
                        <span class="rp-field-label">ECSA number <em>Required when claiming CPD</em></span>
                        <input class="rp-input" type="text" name="ecsa_number" value="{{ old('ecsa_number', $ecsaNumber) }}" placeholder="e.g. 2020123456" autocomplete="off">
                    </label>

                    <label class="rp-field">
                        <span class="rp-field-label">Proof of payment</span>
                        <span class="rp-upload" id="rp-upload">
                            <span class="rp-upload-icon" aria-hidden="true">↑</span>
                            <span class="rp-upload-copy">
                                <strong id="rp-upload-title">Drop your document here</strong>
                                <span id="rp-upload-sub">or browse · PDF, DOC, DOCX, JPG, PNG, WebP · max 10 MB</span>
                            </span>
                            <input class="rp-upload-input" id="rp-proof-input" type="file" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp" required>
                        </span>
                    </label>

                    <div class="rp-actions">
                        <p>Your registration is confirmed after payment is verified.</p>
                        <button class="rp-submit" type="submit">Submit proof of payment <span aria-hidden="true">→</span></button>
                    </div>
                </form>
            </section>
        </div>
    </div>

    @push('scripts')
        <script>
            (() => {
                const toggle = document.getElementById('rp-ecsa-toggle');
                const field = document.getElementById('rp-ecsa-field');
                const input = document.getElementById('rp-proof-input');
                const title = document.getElementById('rp-upload-title');
                const sub = document.getElementById('rp-upload-sub');
                const zone = document.getElementById('rp-upload');

                if (toggle && field) {
                    const sync = () => {
                        field.hidden = !toggle.checked;
                    };
                    toggle.addEventListener('change', sync);
                    sync();
                }

                if (input && title && sub && zone) {
                    const showFile = () => {
                        if (!input.files?.length) {
                            title.textContent = 'Drop your document here';
                            sub.textContent = 'or browse · PDF, JPG, PNG, WebP · max 10 MB';
                            zone.classList.remove('is-filled');
                            return;
                        }
                        title.textContent = input.files[0].name;
                        sub.textContent = 'Ready to submit · click to replace';
                        zone.classList.add('is-filled');
                    };
                    input.addEventListener('change', showFile);
                    ['dragenter', 'dragover'].forEach((eventName) => {
                        zone.addEventListener(eventName, (event) => {
                            event.preventDefault();
                            zone.classList.add('is-dragover');
                        });
                    });
                    ['dragleave', 'drop'].forEach((eventName) => {
                        zone.addEventListener(eventName, (event) => {
                            event.preventDefault();
                            zone.classList.remove('is-dragover');
                        });
                    });
                }
            })();
        </script>
    @endpush
</x-layouts::app>
