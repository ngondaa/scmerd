<x-layouts::app :title="__('Dashboard')">

@include('partials.portal.open')

@php
$user = auth()->user();
$package = session('registration_package') ?? $user->registration_package;
$paid = $user->registration_paid_at;
$certificateName = $user->certificate_name;
$ecsaAccredited = (bool) $user->ecsa_accredited;
$ecsaNumber = $user->ecsa_number;
$studentId = $user->student_id;
@endphp

<style>
/* Scoped overrides for this page: drop the empty second grid column
   and lay the 4 package cards out 2x2 so nothing needs scrolling. */
.cp-main-grid{
    display:block; /* was a multi-column grid with an unused/empty second track */
}
.packages-grid{
    display:grid;
    grid-template-columns:repeat(2, 1fr);
    gap:20px;
}
.package-option{height:100%;}
.package-card{
    height:100%;
    display:flex;
    flex-direction:column;
}
.package-features{
    flex:1; /* keeps card footers aligned even if feature lists differ in length */
}
@media (max-width:900px){
    .packages-grid{grid-template-columns:1fr;}
}

.package-card {
    border: 2px solid transparent;
    border-radius: 12px;
    background: #fff;
    transition: border-color 0.15s ease, box-shadow 0.15s ease, transform 0.15s ease;
    cursor: pointer;
}
.package-card:hover {
    border-color: #111827;
    box-shadow: 0 8px 22px rgba(17, 24, 39, 0.08);
}
.package-card.selected {
    border-color: #111827;
    box-shadow: 0 0 0 3px rgba(17, 24, 39, 0.08);
}
.package-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}
.field-hint{display:block;font-weight:400;font-size:12.5px;color:#5F6368;margin-top:4px;}
</style>

<div class="cp-main-grid">
    <div class="cp-card cp-card-highlight">
        <h2 class="cp-card-title">Register for the conference</h2>
        @if ($paid)
            <p class="cp-card-desc" style="color:#1a7f37;font-weight:600;">
                Registration paid on {{ $paid->format('j F Y') }}
                @if ($package)
                    — {{ config('registration.packages.'.$package.'.name', ucfirst($package)) }}
                @endif
            </p>
        @else
            <p class="cp-card-desc">Select your registration package to proceed with abstract submission.</p>
        @endif

        @if (session('status'))
            <p class="cp-card-desc" style="color:#1a7f37;margin-bottom:16px;">{{ session('status') }}</p>
        @endif
        @if (session('error'))
            <p class="cp-card-desc" style="color:#A41E22;margin-bottom:16px;">{{ session('error') }}</p>
        @endif
        @if ($errors->any())
            <p class="cp-card-desc" style="color:#A41E22;margin-bottom:16px;">{{ $errors->first() }}</p>
        @endif

        @if ($paid)
            <div style="margin-top:18px; padding:20px 18px; border:1px solid #eaeaea; border-radius:10px; background:#fafaf8;">
                <div style="display:grid; gap:14px;">
                    <div>
                        <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666; margin-bottom:6px;">Registration package</div>
                        <div style="font-size:18px; font-weight:700; color:#1d1d1d;">
                            {{ config('registration.packages.'.$package.'.name', ucfirst($package)) }}
                        </div>
                    </div>

                    <div>
                        <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666; margin-bottom:6px;">Name on certificate</div>
                        <div style="font-size:16px; font-weight:600; color:#1d1d1d;">{{ $certificateName ?: 'Not provided' }}</div>
                    </div>

                    @if ($ecsaAccredited)
                        <div>
                            <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666; margin-bottom:6px;">ECSA number</div>
                            <div style="font-size:16px; font-weight:600; color:#1d1d1d;">{{ $ecsaNumber ?: 'Not provided' }}</div>
                        </div>
                    @endif

                    @if ($package === 'student')
                        <div>
                            <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666; margin-bottom:6px;">Student website ID</div>
                            <div style="font-size:16px; font-weight:600; color:#1d1d1d;">{{ $studentId ?: 'Not provided' }}</div>
                        </div>
                    @endif

                    <div>
                        <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666; margin-bottom:6px;">Payment status</div>
                        <div style="font-size:16px; font-weight:700; color:#1a7f37;">Paid</div>
                    </div>
                </div>
            </div>
        @else
            <form method="GET" action="{{ route('registration.proof') }}" id="package-selector" class="package-form" style="display:block;">
                <div class="packages-grid">
                    <div class="package-option">
                        <input type="radio" id="pkg-student" name="package" value="student" required>
                        <label for="pkg-student" class="package-card" data-package="student">
                            <div class="package-header">
                                <h3>Student Package</h3>
                                <div class="package-price">R450</div>
                            </div>
                            <p class="package-desc">Perfect for postgraduate students</p>
                            <ul class="package-features">
                                <li>Day session attendance</li>
                                <li>Gala dinner & awards</li>
                                <li>1 CPD credit (ECSA)</li>
                                <li>Certificate of attendance</li>
                            </ul>
                        </label>
                    </div>

                    <div class="package-option">
                        <input type="radio" id="pkg-standard" name="package" value="standard" required>
                        <label for="pkg-standard" class="package-card" data-package="standard">
                            <div class="package-header">
                                <h3>Standard Package</h3>
                                <div class="package-price">R650</div>
                            </div>
                            <p class="package-desc">For researchers and practitioners</p>
                            <ul class="package-features">
                                <li>Day session attendance</li>
                                <li>Gala dinner & awards</li>
                                <li>1 CPD credit (ECSA)</li>
                                <li>Abstract proceedings</li>
                                <li>Networking materials</li>
                            </ul>
                        </label>
                    </div>

                    <div class="package-option">
                        <input type="radio" id="pkg-premium" name="package" value="premium" required>
                        <label for="pkg-premium" class="package-card" data-package="premium">
                            <div class="package-header">
                                <h3>Premium Package</h3>
                                <div class="package-price">R950</div>
                            </div>
                            <p class="package-desc">Full conference experience</p>
                            <ul class="package-features">
                                <li>Day session attendance</li>
                                <li>Gala dinner & awards</li>
                                <li>1 CPD credit (ECSA)</li>
                                <li>Abstract proceedings</li>
                                <li>VIP networking session</li>
                                <li>Merchandise pack</li>
                            </ul>
                        </label>
                    </div>

                    <div class="package-option">
                        <input type="radio" id="pkg-presenter" name="package" value="presenter" required>
                        <label for="pkg-presenter" class="package-card" data-package="presenter">
                            <div class="package-header">
                                <h3>Presenter Package</h3>
                                <div class="package-price">R750</div>
                            </div>
                            <p class="package-desc">For abstract submitters</p>
                            <ul class="package-features">
                                <li>Full conference access</li>
                                <li>Gala dinner & awards</li>
                                <li>1 CPD credit (ECSA)</li>
                                <li>Abstract proceedings</li>
                                <li>Presentation slot</li>
                            </ul>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 24px; width: 100%;">
                    Confirm Registration Package
                </button>
            </form>
        @endif
    </div>
</div>

@include('partials.portal.close')

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var selectedPackage = document.querySelector('#package-selector input[name="package"]:checked');
    var cards = document.querySelectorAll('.package-card');

    cards.forEach(function (card) {
        var radio = document.getElementById('pkg-' + (card.dataset.package || ''));
        if (!radio) return;

        var syncSelection = function () {
            cards.forEach(function (item) {
                item.classList.toggle('selected', item === card && radio.checked);
            });
        };

        radio.addEventListener('change', syncSelection);
        if (radio.checked) {
            syncSelection();
        }

        card.addEventListener('click', function () {
            radio.checked = true;
            syncSelection();
        });
    });
});
</script>
@endpush
</x-layouts::app>