<x-layouts::app :title="__($isJustAttend ? 'Complete attendance registration' : 'Submit proof of payment')">
    @push('styles')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/registration-payment.css') }}">
    @endpush

    <div class="rp-page">
        <header class="rp-hero">
            <div>
                <p class="rp-eyebrow">SCMERD · Conference registration</p>
                <h1>{{ $isJustAttend ? 'Complete your attendance registration' : 'Invoice & payment proof' }}</h1>
                <p>{{ $isJustAttend ? 'Pay the R450 attendance fee, then provide your name, ID number and payment proof.' : 'Pay by bank transfer, then upload your receipt so we can unlock abstract submission.' }}</p>
            </div>
            <ol class="rp-steps"><li>1 · Package</li><li class="current">2 · {{ $isJustAttend ? 'Details' : 'Payment proof' }}</li></ol>
        </header>

        @if (session('status')) <p class="rp-flash ok">{{ session('status') }}</p> @endif
        @if ($errors->any())
            <div class="rp-flash error"><strong>Please correct the following:</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <main class="rp-layout">
            <aside>
                <section class="rp-summary">
                    <span>Registration package</span>
                    <h2>{{ $package['name'] }}</h2>
                    <p>{{ $package['description'] }}</p>
                    <div class="rp-price"><span>Total due</span><strong>{{ $package['display_price'] }}</strong></div>
                </section>

                <section class="rp-bank">
                        <h2>Bank transfer details</h2><p>Use this reference exactly so we can match your payment.</p>
                        <dl>
                            <div><dt>Bank</dt><dd>{{ config('registration.payment.bank_name') }}</dd></div>
                            <div><dt>Account name</dt><dd>{{ config('registration.payment.account_name') }}</dd></div>
                            <div><dt>Account number</dt><dd>{{ config('registration.payment.account_number') }}</dd></div>
                            <div><dt>Branch code</dt><dd>{{ config('registration.payment.branch_code') }}</dd></div>
                            <div class="full"><dt>Payment reference</dt><dd>{{ config('registration.payment.reference_prefix') }} - {{ auth()->user()->email }}</dd></div>
                        </dl>
                </section>
            </aside>

            <section class="rp-panel">
                <form method="POST" action="{{ route('registration.proof.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="package" value="{{ $packageKey }}">
                    <div class="rp-form-intro"><h2>{{ $isJustAttend ? 'Your details' : 'Confirm & upload' }}</h2><p>{{ $isJustAttend ? 'These details will be used for your attendance record and certificate.' : 'Fill in your certificate details, then attach the transfer receipt.' }}</p></div>

                    <label><span>Name on certificate</span><input type="text" name="certificate_name" value="{{ old('certificate_name', $certificateName) }}" placeholder="Enter your full name" required autocomplete="name"><small>This is how your name will appear on your certificate.</small></label>

                    @if ($isJustAttend)
                        <label><span>ID number</span><input type="text" name="student_id" value="{{ old('student_id', $studentId) }}" placeholder="Enter your ID number" required autocomplete="off"></label>
                        <label><span>Proof of payment</span><span class="rp-upload"><strong id="rp-upload-title">Choose payment proof</strong><small>PDF, DOC, DOCX, JPG, PNG or WebP · max 10 MB</small><input id="rp-proof-input" type="file" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp" required></span></label>
                        <div class="rp-actions"><p>Your registration is confirmed after payment is verified.</p><button type="submit">Submit payment proof →</button></div>
                    @else
                        <label class="rp-check"><input type="hidden" name="ecsa_accredited" value="0"><input type="checkbox" name="ecsa_accredited" value="1" id="rp-ecsa-toggle" @checked(old('ecsa_accredited', $ecsaAccredited))><span><strong>I require ECSA CPD recognition</strong><small>Provide your ECSA number if you are claiming CPD points.</small></span></label>
                        <label id="rp-ecsa-field" @if (! old('ecsa_accredited', $ecsaAccredited)) hidden @endif><span>ECSA number</span><input type="text" name="ecsa_number" value="{{ old('ecsa_number', $ecsaNumber) }}" placeholder="e.g. 2020123456"></label>
                        <label><span>Proof of payment</span><span class="rp-upload"><strong id="rp-upload-title">Choose payment proof</strong><small>PDF, DOC, DOCX, JPG, PNG or WebP · max 10 MB</small><input id="rp-proof-input" type="file" name="proof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp" required></span></label>
                        <div class="rp-actions"><p>Your registration is confirmed after payment is verified.</p><button type="submit">Submit proof of payment →</button></div>
                    @endif
                </form>
            </section>
        </main>
    </div>

    @push('scripts')
        <script>
            @unless ($isJustAttend)
                document.getElementById('rp-ecsa-toggle')?.addEventListener('change', event => document.getElementById('rp-ecsa-field').hidden = !event.target.checked);
            @endunless
            document.getElementById('rp-proof-input')?.addEventListener('change', event => { if (event.target.files?.[0]) document.getElementById('rp-upload-title').textContent = event.target.files[0].name; });
        </script>
    @endpush
</x-layouts::app>
