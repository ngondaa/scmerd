<x-layouts::app :title="__('Submit proof of payment')">
    <div class="cp-main-grid">
        <div class="cp-card">
            <h2 class="cp-card-title">Submit proof of payment</h2>

            @if(session('status'))
                <p style="color:#1a7f37;">{{ session('status') }}</p>
            @endif

            <form method="POST" action="{{ route('registration.proof.store') }}" enctype="multipart/form-data">
                @csrf
                <div style="display:flex; gap:12px; flex-direction:column;">
                    <label>Package
                        <select name="package">
                            <option value="student">Student</option>
                            <option value="standard">Standard</option>
                            <option value="premium">Premium</option>
                            <option value="presenter">Presenter</option>
                        </select>
                    </label>

                    <label>Proof of payment (upload image/pdf)
                        <input type="file" name="proof" required>
                    </label>

                    <button class="btn btn-primary" type="submit">Upload proof</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
