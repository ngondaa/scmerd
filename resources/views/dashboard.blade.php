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

/* Package modal: was rendering as unstyled stacked text —
   no overlay, no panel styling, no input styling. */
.package-modal{position:fixed;inset:0;z-index:1000;}
.package-modal-overlay{position:absolute;inset:0;background:rgba(17,17,17,0.55);backdrop-filter:blur(2px);}
.package-modal-panel{
    position:relative;
    max-width:520px;
    margin:8vh auto 0;
    max-height:82vh;
    overflow-y:auto;
    background:#fff;
    border-radius:10px;
    padding:32px 32px 28px;
    box-shadow:0 24px 60px rgba(0,0,0,.25);
}
.modal-close{
    position:absolute;top:16px;right:16px;float:none !important;
    width:32px;height:32px;border-radius:50%;
    border:1px solid #eaeaea;background:#fff;
    font-size:15px;line-height:1;cursor:pointer;
}
.modal-close:hover{background:#f5f5f5;}
#package-modal-title{font-family:'Archivo',sans-serif;font-size:22px;margin:0 24px 4px 0;}
.package-modal-desc{color:#5F6368;margin:0 0 4px;}
.package-modal-price{font-size:15px;}
.package-modal-body label{font-size:14px;font-weight:600;display:block;}
.package-modal-body input[type="text"].form-control{
    width:100%;margin-top:6px;padding:10px 12px;
    border:1px solid #d8d8d8;border-radius:6px;font-size:14.5px;
}
.package-modal-body input[type="text"].form-control:focus{
    outline:none;border-color:#A41E22;box-shadow:0 0 0 3px rgba(164,30,34,.12);
}
.package-modal-body input[type="checkbox"]{width:16px;height:16px;margin-right:6px;vertical-align:middle;}
.field-hint{display:block;font-weight:400;font-size:12.5px;color:#5F6368;margin-top:4px;}
#student-block,#ecsa-block{padding:14px 16px;background:#FAFAF8;border:1px solid #EAEAEA;border-radius:8px;}
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
            <div class="packages-grid">
                <form method="POST" action="{{ route('update-package') }}" id="package-selector" class="package-form">
                    @csrf

                    <div class="package-option">
                        <input type="radio" id="pkg-student" name="package" value="student" required>
                        <label for="pkg-student" class="package-card" data-package="student" data-price="R450" data-title="Student Package">
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
                        <label for="pkg-standard" class="package-card" data-package="standard" data-price="R650" data-title="Standard Package">
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
                        <label for="pkg-premium" class="package-card" data-package="premium" data-price="R950" data-title="Premium Package">
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
                        <label for="pkg-presenter" class="package-card" data-package="presenter" data-price="R750" data-title="Presenter Package">
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
                </form>
            </div>
            <button type="button" id="open-package-modal" class="btn btn-primary" style="margin-top: 24px; width: 100%;">
                Confirm Registration Package
            </button>
        @endif
    </div>
</div>

@include('partials.portal.close')

<!-- Package modal -->
<div id="package-modal" class="package-modal" aria-hidden="true" style="display:none;">
    <div class="package-modal-overlay" data-close role="button" tabindex="0" aria-label="Close"></div>
    <div class="package-modal-panel cp-card" role="dialog" aria-modal="true" aria-labelledby="package-modal-title">
        <button class="modal-close" data-close aria-label="Close" style="float:right;">✕</button>
        <h3 id="package-modal-title">Package</h3>
        <div class="package-modal-body">
            <p class="package-modal-desc"></p>
            <p class="package-modal-price" style="font-weight:700;margin-top:8px;"></p>

            <form id="package-modal-form" method="POST" action="{{ route('checkout.create') }}">
                @csrf
                <input type="hidden" name="package" value="" id="modal-package-input">

                <label style="display:block;margin-top:12px;">Name for certificate <small style="color:#666">(as it should appear)</small>
                    <input name="certificate_name" type="text" required class="form-control" style="width:100%;margin-top:6px;" />
                </label>

                <div id="ecsa-block" style="margin-top:12px;">
                    <label><input type="checkbox" name="ecsa_accredited" id="ecsa-accredited"> I am ECSA accredited</label>
                    <div id="ecsa-number-wrap" style="margin-top:8px;display:none;">
                        <label>ECSA number
                            <input type="text" name="ecsa_number" id="ecsa-number" class="form-control" style="width:100%;margin-top:6px;" />
                        </label>
                    </div>
                </div>

                <div id="student-block" style="margin-top:12px;display:none;">
                    <label>
                        Student website ID
                        <span class="field-hint">If you're a SAIMechE member, enter your member website ID here. Not a member? Leave this blank.</span>
                        <input type="text" name="student_id" id="student-id" class="form-control" style="width:100%;margin-top:6px;" />
                    </label>
                </div>

                <div style="margin-top:18px;display:flex;gap:10px;align-items:center;">
                    <button type="submit" class="btn btn-primary">Proceed to checkout</button>
                    <button type="button" class="btn" data-close>Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    var modal = document.getElementById('package-modal');
    var panel = modal && modal.querySelector('.package-modal-panel');
    var desc = modal && modal.querySelector('.package-modal-desc');
    var priceEl = modal && modal.querySelector('.package-modal-price');
    var pkgInput = document.getElementById('modal-package-input');
    var ecsaCheckbox = document.getElementById('ecsa-accredited');
    var ecsaWrap = document.getElementById('ecsa-number-wrap');
    var studentBlock = document.getElementById('student-block');

    var titleEl = document.getElementById('package-modal-title');
    var openBtn = document.getElementById('open-package-modal');

    function openModal(data){
        if (!modal) return;
        if (titleEl) titleEl.textContent = data.title || 'Package';
        desc.textContent = data.desc || '';
        priceEl.textContent = data.price ? ('Price: ' + data.price) : '';
        pkgInput.value = data.package || '';
        // toggle student/ecsa fields
        if (data.package === 'student'){
            studentBlock.style.display = 'block';
            ecsaWrap.style.display = 'none';
            ecsaCheckbox.checked = false;
        } else {
            studentBlock.style.display = 'none';
            ecsaWrap.style.display = 'none';
            ecsaCheckbox.checked = false;
        }
        modal.style.display = 'block';
        modal.setAttribute('aria-hidden','false');
        // focus first input
        var first = modal.querySelector('input[name="certificate_name"]'); if (first) first.focus();
    }

    function closeModal(){ if(!modal) return; modal.style.display='none'; modal.setAttribute('aria-hidden','true'); }

    // wire package cards
    document.querySelectorAll('.package-card').forEach(function(card){
        card.addEventListener('click', function(e){
            e.preventDefault();
            var radio = document.getElementById('pkg-' + (card.dataset.package || ''));
            if (radio) radio.checked = true;
            var packageKey = card.dataset.package || '';
            var price = card.dataset.price || '';
            var title = card.dataset.title || card.querySelector('h3')?.textContent || '';
            var descText = card.querySelector('.package-desc') ? card.querySelector('.package-desc').textContent : '';
            openModal({ package: packageKey, price: price, title: title, desc: descText });
        });
    });

    openBtn && openBtn.addEventListener('click', function(){
        var selected = document.querySelector('#package-selector input[name="package"]:checked');
        if (!selected) {
            alert('Please select a registration package first.');
            return;
        }
        var card = document.querySelector('.package-card[data-package="' + selected.value + '"]');
        if (!card) return;
        card.click();
    });

    // close handlers
    document.querySelectorAll('[data-close]').forEach(function(btn){ btn.addEventListener('click', function(){ closeModal(); }); });
    document.querySelector('.package-modal-overlay')?.addEventListener('click', closeModal);

    ecsaCheckbox && ecsaCheckbox.addEventListener('change', function(){ ecsaWrap.style.display = this.checked ? 'block' : 'none'; });
});
</script>
@endpush
</x-layouts::app>