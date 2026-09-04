<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentProofController extends Controller
{
    public function show()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $registrationOpen = (bool) AppSetting::get('registration_open', '1');
        $registrationMode = AppSetting::get('registration_mode', 'gateway');

        if ($registrationMode !== 'manual') {
            return redirect()->route('dashboard')->with('error', 'Manual registration is not enabled.');
        }

        if (! $registrationOpen) {
            return redirect()->route('dashboard')->with('error', 'Registration is currently closed.');
        }

        return view('registration.proof');
    }

    public function store(Request $request)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'proof' => ['required', 'file', 'max:10240'],
            'package' => ['required', 'string'],
        ]);

        $path = $request->file('proof')->store('payment_proofs', 'public');

        $user = $request->user();
        $user->update([
            'payment_proof_path' => $path,
            'registration_status' => 'pending',
            'registration_package' => $request->input('package', $user->registration_package),
        ]);

        // enqueue AI proof analysis job (OCR + rule engine)
        $user->update(['payment_proof_analysis' => 'queued']);

        \App\Jobs\ProofAnalysisJob::dispatch($user->id);

        return redirect()->route('dashboard')->with('status', 'Proof uploaded and awaiting verification.');
    }
}
