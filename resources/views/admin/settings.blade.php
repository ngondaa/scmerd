<x-layouts::app :title="__('Admin Settings')">
    <div class="cp-main-grid">
        <div class="cp-card">
            <h2 class="cp-card-title">Registration settings</h2>

            @if(session('status'))
                <p style="color:#1a7f37;">{{ session('status') }}</p>
            @endif

            <form method="POST" action="{{ route('admin.settings.toggle') }}">
                @csrf
                <label>
                    <input type="checkbox" name="registration_open" value="1" {{ $registrationOpen ? 'checked' : '' }}> Registration open
                </label>

                <label style="display:block; margin-top:8px;">
                    Registration mode
                    <select name="registration_mode">
                        <option value="gateway" {{ ($registrationMode ?? 'gateway') === 'gateway' ? 'selected' : '' }}>Payment gateway (Stripe)</option>
                        <option value="manual" {{ ($registrationMode ?? '') === 'manual' ? 'selected' : '' }}>Manual (upload proof)</option>
                    </select>
                </label>

                <button type="submit" class="btn btn-primary" style="margin-top:8px;">Save</button>
            </form>
        </div>

        <div class="cp-card">
            <h2 class="cp-card-title">Pending payment proofs</h2>
            @if($pending->isEmpty())
                <p>No pending proofs.</p>
            @else
                <ul>
                    @foreach($pending as $p)
                        <li style="margin-bottom:12px;">
                            <strong>{{ $p->email }}</strong>
                            <div>
                                @if($p->payment_proof_path)
                                    <a href="{{ Storage::disk('public')->url($p->payment_proof_path) }}" target="_blank">View proof</a>
                                @endif
                                <form method="POST" action="{{ route('admin.users.verify-payment', $p) }}" style="display:inline; margin-left:8px;">
                                    @csrf
                                    <button name="action" value="approve" class="btn">Approve</button>
                                    <button name="action" value="reject" class="btn">Reject</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-layouts::app>
