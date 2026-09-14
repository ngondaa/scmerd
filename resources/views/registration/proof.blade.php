<x-layouts::app :title="__($isJustAttend ? 'Complete attendance registration' : 'Submit proof of payment')">
    @push('styles')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Lora:wght@500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/registration-payment.css') }}">
    @endpush

    <div class="rp-page">
        <header class="rp-hero">
            <p class="rp-eyebrow">SCMERD · Conference registration</p>
            <h1>{{ $isJustAttend ? 'Complete your attendance registration' : 'Submit your payment proof' }}</h1>
            <p>{{ $isJustAttend ? 'Pay the R450 attendance fee, then add your name, optional registration numbers and proof of payment.' : 'Pay by bank transfer, then add your certificate details and proof of payment.' }}</p>
        </header>

        @if (session('status'))
            <p class="rp-flash rp-flash-success">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <div class="rp-flash rp-flash-error">
                <strong>Please correct the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main class="rp-layout">
            <aside class="rp-aside">
                <section class="rp-card rp-summary">
                    <span class="rp-label">Registration package</span>
                    <div class="rp-summary-head">
                        <h2>{{ $package['name'] }}</h2>
                        <strong class="rp-price">{{ $package['display_price'] }}</strong>
                    </div>
                </section>

                <section class="rp-card rp-bank">
                    <h2>Bank transfer details</h2>
                    <p class="rp-hint">Use this payment reference exactly so finance can match your transfer.</p>
                    <dl class="rp-rows">
                        <div class="rp-row"><dt>Bank</dt><dd>{{ config('registration.payment.bank_name') }}</dd></div>
                        <div class="rp-row"><dt>Account name</dt><dd>{{ config('registration.payment.account_name') }}</dd></div>
                        <div class="rp-row"><dt>Account number</dt><dd>{{ config('registration.payment.account_number') }}</dd></div>
                        <div class="rp-row"><dt>Branch code</dt><dd>{{ config('registration.payment.branch_code') }}</dd></div>
                        <div class="rp-row rp-row-full"><dt>Payment reference</dt><dd>{{ config('registration.payment.reference_prefix') }} - {{ auth()->user()->email }}</dd></div>
                    </dl>
                </section>
            </aside>

            <section class="rp-card rp-panel">
                <div class="rp-form-intro">
                    <h2>{{ $isJustAttend ? 'Your attendance details' : 'Certificate details & proof' }}</h2>
                    <p>{{ $isJustAttend ? 'Enter the details that should appear on your attendance record and certificate.' : 'Enter your certificate details, then upload your proof of payment.' }}</p>
                </div>

                <form method="POST" action="{{ route('registration.proof.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="package" value="{{ $packageKey }}">

                    <label class="rp-field">
                        <span>Name on certificate</span>
                        <input type="text" name="certificate_name" value="{{ old('certificate_name', $certificateName) }}" placeholder="Enter your full name" required autocomplete="name">
                        <small>This is how your name will appear on your certificate.</small>
                    </label>

                    <div class="rp-field-grid">
                        <label class="rp-field">
                            <span>ECSA number <em>Optional</em></span>
                            <input type="text" name="ecsa_number" value="{{ old('ecsa_number', $ecsaNumber) }}" placeholder="Enter your ECSA number" autocomplete="off">
                        </label>

                        <label class="rp-field">
                            <span>Student number <em>Optional</em></span>
                            <input type="text" name="student_id" value="{{ old('student_id', $studentId) }}" placeholder="Enter your student number" autocomplete="off">
                        </label>
                    </div>

                    <label class="rp-field">
                        <span>Proof of payment</span>
                        <span class="rp-upload">
                            <strong id="rp-upload-title">Choose your payment proof</strong>
                            <small>PDF, DOC, DOCX, JPG, PNG or WebP · maximum 10 MB</small>
                            <input id="rp-proof-input" type="file" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp" required>
                        </span>
                    </label>

                    <div class="rp-actions">
                        <button type="submit">Submit payment proof <span aria-hidden="true">→</span></button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    @push('scripts')
        <script>
            document.getElementById('rp-proof-input')?.addEventListener('change', event => {
                if (event.target.files?.[0]) {
                    document.getElementById('rp-upload-title').textContent = event.target.files[0].name;
                }
            });
        </script>
    @endpush
</x-layouts::app>
