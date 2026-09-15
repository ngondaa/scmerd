<x-layouts::app :title="__('Dashboard')">

@include('partials.portal.open')

@php
$user = auth()->user();
$selectedPackage = session('registration_package') ?? $user->registration_package;
$package = $selectedPackage === 'student' ? 'just_attend' : $selectedPackage;
$paid = $user->registration_paid_at;
$certificateName = $user->certificate_name;
$ecsaAccredited = (bool) $user->ecsa_accredited;
$ecsaNumber = $user->ecsa_number;
$registrationStatus = $user->registration_status ?? 'unpaid';
$availablePackages = collect(config('registration.packages'))
    ->filter(fn (array $package) => $package['available'] ?? true)
    ->groupBy('category', preserveKeys: true);
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
.package-category{grid-column:1 / -1;margin:10px 0 -4px;font-size:14px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#4b5563;}
.registration-notes{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-top:24px;}
.registration-note{padding:20px;border:1px solid #d9d9d9;border-radius:8px;background:#f3f3f3;}
.registration-note-label{margin:0 0 14px;color:#748091;font-size:12px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;}
.registration-note-fee{margin:0;color:#173a5e;font-family:Georgia,serif;font-size:25px;font-weight:700;}
.registration-note-copy{margin:6px 0 0;color:#687587;font-size:14px;}
@media (max-width:640px){.registration-notes{grid-template-columns:1fr;}}
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
                {{ $package === 'just_attend' ? 'Registration confirmed' : 'Registration paid on '.$paid->format('j F Y') }}
                @if ($package)
                    — {{ config('registration.packages.'.$package.'.name', ucfirst($package)) }}
                @endif
            </p>
        @elseif (in_array($registrationStatus, ['pending', 'pending_review'], true))
            <div style="margin-top:18px; padding:20px 18px; border:1px solid #d9a441; border-radius:10px; background:#fff9eb;">
                <div style="font-size:18px; font-weight:700; color:#6b4a00;">Payment proof awaiting verification</div>
                <p class="cp-card-desc" style="margin:8px 0 0;">Your {{ config('registration.packages.'.$package.'.name', ucfirst($package)) }} registration and payment proof have been received. We will notify you once payment is approved.</p>
                <a href="{{ route('registration.proof', ['package' => $package]) }}" class="btn btn-secondary" style="margin-top:16px;">Replace proof or update registration details</a>
            </div>
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

                    <div>
                        <div style="font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#666; margin-bottom:6px;">{{ $package === 'just_attend' ? 'Registration status' : 'Payment status' }}</div>
                        <div style="font-size:16px; font-weight:700; color:#1a7f37;">{{ $package === 'just_attend' ? 'Confirmed' : 'Paid' }}</div>
                    </div>
                </div>
            </div>
        @else
            <form method="POST" action="{{ route('update-package') }}" id="package-selector" class="package-form" style="display:block;">
                @csrf
                <div class="packages-grid">
                    @foreach ($availablePackages as $category => $packages)
                        <div class="package-category">{{ $category }}</div>
                        @foreach ($packages as $key => $packageOption)
                            <div class="package-option">
                                <input type="radio" id="pkg-{{ $key }}" name="package" value="{{ $key }}" required @checked($package === $key)>
                                <label for="pkg-{{ $key }}" class="package-card" data-package="{{ $key }}">
                                    <div class="package-header">
                                        <h3>{{ $packageOption['name'] }}</h3>
                                        <div class="package-price">{{ $packageOption['display_price'] }}</div>
                                    </div>
                                    <p class="package-desc">{{ $packageOption['description'] }}</p>
                                    <ul class="package-features">
                                        <li>{{ str_contains(strtolower($packageOption['description']), 'gala') ? 'Conference and gala dinner' : 'Conference attendance' }}</li>
                                        <li>Certificate of attendance</li>
                                    </ul>
                                </label>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <div class="registration-notes" aria-label="Registration fee notes">
                    <section class="registration-note">
                        <p class="registration-note-label">Sponsor delegate</p>
                        <p class="registration-note-fee">Free</p>
                        <p class="registration-note-copy">As per sponsorship package</p>
                    </section>
                    <section class="registration-note">
                        <p class="registration-note-label">Late registration fee (after 20 October 2026)</p>
                        <p class="registration-note-fee">R250</p>
                    </section>
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
    var form = document.getElementById('package-selector');
    if (!form) return;

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

        card.addEventListener('click', syncSelection);
    });
});
</script>
@endpush
</x-layouts::app>
