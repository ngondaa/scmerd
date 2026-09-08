<x-layouts::app :title="__('Submit proof of payment')">
    <div class="cp-main-grid">
        <div class="cp-card cp-payment-card">
            <div class="cp-payment-heading">
                <div>
                    <p class="cp-payment-eyebrow">Registration payment</p>
                    <h2 class="cp-card-title">Invoice &amp; payment proof</h2>
                    <p class="cp-payment-intro">Confirm your registration details, then upload your bank-transfer receipt.</p>
                </div>
                <span class="cp-payment-step">Step 2 of 2</span>
            </div>

            @if(session('status'))
                <p style="color:#1a7f37;">{{ session('status') }}</p>
            @endif

            @if ($errors->any())
                <div role="alert" style="margin:0 0 18px; padding:14px 16px; border:1px solid #e8a6a6; border-radius:8px; background:#fff5f5; color:#8b1e1e;">
                    <strong>Please correct the following:</strong>
                    <ul style="margin:8px 0 0; padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="cp-payment-summary">
                <div class="cp-invoice-panel">
                    <div class="cp-invoice-topline">
                        <div>
                            <div class="cp-data-label">Invoice</div>
                            <div class="cp-invoice-number">{{ $invoiceNumber }}</div>
                        </div>
                        <div class="cp-bill-to">
                            <div><strong>Bill to:</strong> {{ auth()->user()->name }}</div>
                            <div>{{ auth()->user()->email }}</div>
                        </div>
                    </div>

                    <div class="cp-invoice-details">
                        <div>
                            <div class="cp-data-label">Package</div>
                            <div class="cp-data-value cp-data-value--large">{{ $package['name'] ?? ucfirst($packageKey) }}</div>
                        </div>
                        <div>
                            <div class="cp-data-label">Name on certificate</div>
                            <div class="cp-data-value">{{ $certificateName ?: 'Not provided yet' }}</div>
                        </div>
                        <div>
                            <div class="cp-data-label">Total due</div>
                            <div class="cp-data-value cp-data-value--amount">{{ $package['display_price'] ?? 'R0' }}</div>
                        </div>
                    </div>
                </div>

                <div class="cp-bank-panel">
                    <div class="cp-bank-heading">
                        <div class="cp-bank-icon" aria-hidden="true">↗</div>
                        <div>
                            <h3>Bank transfer details</h3>
                            <p>Use these details when making your payment.</p>
                        </div>
                    </div>
                    <div class="cp-bank-details">
                        <div><span>Bank</span><strong>{{ config('registration.payment.bank_name', 'Conference Secretariat Bank') }}</strong></div>
                        <div><span>Account name</span><strong>{{ config('registration.payment.account_name', 'SCMERD Conference Registration') }}</strong></div>
                        <div><span>Account number</span><strong>{{ config('registration.payment.account_number', '0000000000') }}</strong></div>
                        <div><span>Branch code</span><strong>{{ config('registration.payment.branch_code', '000000') }}</strong></div>
                        <div class="cp-bank-reference"><span>Payment reference</span><strong>{{ config('registration.payment.reference_prefix', 'SCMERD') }} - {{ auth()->user()->email }}</strong></div>
                    </div>
                </div>
            </div>

            <form class="cp-payment-form" method="POST" action="{{ route('registration.proof.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="cp-payment-form-fields">
                    <input type="hidden" name="package" value="{{ $packageKey }}">

                    <label class="cp-form-group"> <span class="cp-label">Name on certificate</span>
                        <input class="cp-input" type="text" name="certificate_name" value="{{ old('certificate_name', $certificateName) }}" placeholder="Enter your full name" required>
                        <span class="cp-help-text">This is how your name will appear on your certificate.</span>
                    </label>

                    <label class="cp-cpd-option">
                        <input type="hidden" name="ecsa_accredited" value="0">
                        <input type="checkbox" name="ecsa_accredited" value="1" @checked(old('ecsa_accredited', $ecsaAccredited))>
                        <span><strong>I require ECSA CPD recognition</strong><small>Provide your ECSA number below if you are claiming CPD points.</small></span>
                    </label>

                    <label class="cp-form-group"><span class="cp-label">ECSA number <em>Required when claiming CPD</em></span>
                        <input class="cp-input" type="text" name="ecsa_number" value="{{ old('ecsa_number', $ecsaNumber) }}" placeholder="e.g. 2020123456">
                    </label>

                    @if ($packageKey === 'student')
                        <label class="cp-form-group"><span class="cp-label">Student number</span>
                            <input class="cp-input" type="text" name="student_id" value="{{ old('student_id', $studentId) }}" placeholder="Enter your student number" required>
                        </label>
                    @endif

                    <label class="cp-form-group"><span class="cp-label">Proof of payment</span>
                        <span class="cp-upload-zone">
                            <span class="cp-upload-icon" aria-hidden="true">↑</span>
                            <span class="cp-upload-text"><strong>Drop your document here</strong><span>or browse to choose a file</span></span>
                            <input class="cp-upload-input" type="file" name="proof" accept=".pdf,.jpg,.jpeg,.png,.webp" required>
                        </span>
                        <span class="cp-help-text">PDF, JPG, PNG or WebP · Maximum file size 10 MB</span>
                    </label>

                    <div class="cp-submit-row">
                        <p>Your registration will be confirmed after the payment is verified.</p>
                        <button class="btn btn-primary" type="submit">Submit proof of payment <span aria-hidden="true">→</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
