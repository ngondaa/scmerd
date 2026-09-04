<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PaymentProofController extends Controller
{
    public function show(Request $request)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $registrationOpen = (bool) AppSetting::get('registration_open', '1');
        $registrationMode = AppSetting::get('registration_mode', 'manual');

        if ($registrationMode !== 'manual') {
            return redirect()->route('dashboard')->with('error', 'Manual registration is not enabled.');
        }

        if (! $registrationOpen) {
            return redirect()->route('dashboard')->with('error', 'Registration is currently closed.');
        }

        $packageKey = $request->query('package', $request->input('package', auth()->user()->registration_package ?? session('registration_package', 'standard')));
        $packageKey = is_string($packageKey) && array_key_exists($packageKey, config('registration.packages')) ? $packageKey : 'standard';
        $packageConfig = config('registration.packages.' . $packageKey);
        $certificateName = $request->query('certificate_name', $request->input('certificate_name', auth()->user()->certificate_name ?? ''));

        return view('registration.proof', [
            'packageKey' => $packageKey,
            'package' => $packageConfig,
            'certificateName' => is_string($certificateName) ? $certificateName : '',
            'ecsaAccredited' => (bool) auth()->user()->ecsa_accredited,
            'ecsaNumber' => auth()->user()->ecsa_number,
            'studentId' => auth()->user()->student_id,
            'invoiceNumber' => 'INV-' . strtoupper(substr(auth()->user()->email, 0, 3)) . '-' . now()->format('YmdHis'),
        ]);
    }

    public function store(Request $request)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $token = $request->input('cf-turnstile-response');
        $secret = config('services.turnstile.secret');

        if (is_string($secret) && $secret !== '') {
            if (! is_string($token) || $token === '') {
                return back()->withErrors(['cf-turnstile-response' => 'Please complete the security check.'])->withInput();
            }

            $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $request->ip(),
            ]);

            $result = $response->json();
            $hostname = $request->getHost();
            $allowedHostnames = array_filter(array_map('trim', (array) config('services.turnstile.hostnames', ['localhost', '127.0.0.1'])));

            $hostnameValid = in_array($hostname, $allowedHostnames, true)
                || in_array($result['hostname'] ?? '', $allowedHostnames, true);

            if (($result['success'] ?? false) !== true
                || ($result['action'] ?? null) !== 'payment_proof_upload'
                || ! $hostnameValid) {
                return back()->withErrors(['cf-turnstile-response' => 'Security verification failed. Please try again.'])->withInput();
            }
        }

        $validated = $request->validate([
            'proof' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'],
            'package' => ['required', 'in:student,standard,premium,presenter'],
            'certificate_name' => ['required', 'string', 'max:255'],
            'ecsa_accredited' => ['nullable', 'boolean'],
            'ecsa_number' => ['nullable', 'string', 'max:100', 'required_if:ecsa_accredited,1'],
            'student_id' => ['nullable', 'string', 'max:100', 'required_if:package,student'],
        ]);

        $path = $request->file('proof')->store('payment_proofs', 'public');

        $user = $request->user();
        $user->update([
            'payment_proof_path' => $path,
            'registration_status' => 'pending',
            'registration_package' => $validated['package'],
            'certificate_name' => $validated['certificate_name'],
            'ecsa_accredited' => $request->boolean('ecsa_accredited'),
            'ecsa_number' => $validated['ecsa_number'] ?? null,
            'student_id' => $validated['student_id'] ?? null,
        ]);

        // enqueue AI proof analysis job (OCR + rule engine)
        $user->update(['payment_proof_analysis' => 'queued']);

        \App\Jobs\ProofAnalysisJob::dispatch($user->id);

        return redirect()->route('dashboard')->with('status', 'Proof uploaded and awaiting verification.');
    }
}
