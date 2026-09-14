<?php

namespace App\Http\Controllers;

use App\Jobs\ProofAnalysisJob;
use App\Mail\PaymentProofSubmitted;
use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class PaymentProofController extends Controller
{
    public function show(Request $request)
    {
        $registrationOpen = (bool) AppSetting::get('registration_open', '1');
        if (! $registrationOpen) {
            return redirect()->route('dashboard')->with('error', 'Registration is currently closed.');
        }

        $packageKey = $request->query('package', $request->input('package', auth()->user()->registration_package ?? session('registration_package', 'standard')));
        // Keep existing student registrations usable after replacing that package.
        $packageKey = $packageKey === 'student' ? 'just_attend' : $packageKey;
        $packageKey = is_string($packageKey) && array_key_exists($packageKey, config('registration.packages')) ? $packageKey : 'standard';
        $packageConfig = config('registration.packages.'.$packageKey);
        $isJustAttend = $packageKey === 'just_attend';
        $certificateName = $request->query('certificate_name', $request->input('certificate_name', auth()->user()->certificate_name ?? ''));

        return view('registration.proof', [
            'packageKey' => $packageKey,
            'package' => $packageConfig,
            'isJustAttend' => $isJustAttend,
            'certificateName' => is_string($certificateName) ? $certificateName : '',
            'ecsaNumber' => auth()->user()->ecsa_number,
            'studentId' => auth()->user()->student_id,
            'paymentReference' => $this->invoiceNumber($request->user()),
        ]);
    }

    public function store(Request $request)
    {
        $registrationOpen = (bool) AppSetting::get('registration_open', '1');
        if (! $registrationOpen) {
            return redirect()->route('dashboard')->with('error', 'Registration is currently closed.');
        }

        $packageKey = $request->input('package');
        $validated = $request->validate([
            'proof' => ['required', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png,webp', 'max:10240'],
            'package' => ['required', Rule::in(array_keys(config('registration.packages')))],
            'certificate_name' => ['required', 'string', 'max:255'],
            'ecsa_accredited' => ['nullable', 'boolean'],
            'ecsa_number' => ['nullable', 'string', 'max:100'],
            'student_id' => ['nullable', 'string', 'max:100'],
        ]);

        $user = $request->user();

        $path = $request->file('proof')->store('payment_proofs', 'public');

        $user->update([
            'payment_proof_path' => $path,
            'payment_proof_original_name' => $request->file('proof')->getClientOriginalName(),
            'payment_invoice_number' => $this->invoiceNumber($user),
            'registration_status' => 'pending',
            'registration_package' => $validated['package'],
            'certificate_name' => $validated['certificate_name'],
            'ecsa_accredited' => filled($validated['ecsa_number'] ?? null),
            'ecsa_number' => $validated['ecsa_number'] ?? null,
            'student_id' => $validated['student_id'] ?? null,
        ]);

        // enqueue AI proof analysis job (OCR + rule engine)
        $user->update(['payment_proof_analysis' => 'queued']);

        ProofAnalysisJob::dispatch($user->id);
        Mail::to(config('registration.payment.proof_recipients'))
            ->queue(new PaymentProofSubmitted($user->fresh()));

        return redirect()->route('dashboard')->with('status', 'Proof uploaded. It has been sent to the finance team for verification.');
    }

    private function invoiceNumber(User $user): string
    {
        if (filled($user->payment_invoice_number)) {
            return $user->payment_invoice_number;
        }

        $invoiceNumber = sprintf('SCMERD-%s-%06d', now()->format('Y'), $user->id);
        $user->forceFill(['payment_invoice_number' => $invoiceNumber])->save();

        return $invoiceNumber;
    }
}
