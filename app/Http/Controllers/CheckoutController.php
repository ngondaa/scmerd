<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    public function create(Request $request)
    {
        $registrationMode = \App\Models\AppSetting::get('registration_mode', 'gateway');

        if ($registrationMode !== 'gateway') {
            return redirect()->route('registration.proof')->with('error', 'Registration is currently set to manual proof upload.');
        }

        $validated = $request->validate([
            'package' => ['required', 'string', 'in:student,standard,premium,presenter'],
            'certificate_name' => ['required', 'string', 'max:255'],
            'ecsa_accredited' => ['nullable', 'boolean'],
            'ecsa_number' => ['nullable', 'string', 'max:50'],
            'student_id' => ['nullable', 'string', 'max:100'],
        ]);

        $packages = config('registration.packages');
        $pkg = $packages[$validated['package']];
        $user = $request->user();

        if ($request->boolean('ecsa_accredited') && empty($validated['ecsa_number'])) {
            return back()->withErrors(['ecsa_number' => 'Please enter your ECSA number.'])->withInput();
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'mode' => 'payment',
            'customer_email' => $user->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => $pkg['currency'],
                    'unit_amount' => $pkg['amount'],
                    'product_data' => [
                        'name' => $pkg['name'],
                        'description' => $pkg['description'],
                    ],
                ],
                'quantity' => 1,
            ]],
            'metadata' => [
                'user_id' => (string) $user->id,
                'package' => $validated['package'],
                'certificate_name' => $validated['certificate_name'],
            ],
            'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        $user->update([
            'registration_package' => $validated['package'],
            'certificate_name' => $validated['certificate_name'],
            'ecsa_accredited' => $request->boolean('ecsa_accredited'),
            'ecsa_number' => $request->boolean('ecsa_accredited') ? ($validated['ecsa_number'] ?? null) : null,
            'student_id' => $validated['package'] === 'student' ? ($validated['student_id'] ?? null) : null,
            'stripe_checkout_session_id' => $session->id,
        ]);

        session(['registration_package' => $validated['package']]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (! is_string($sessionId) || $sessionId === '') {
            return redirect()->route('dashboard')->with('error', 'Invalid checkout session.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($sessionId);
        $user = $request->user();

        if ((string) ($session->metadata->user_id ?? '') !== (string) $user->id) {
            abort(403);
        }

        if ($session->payment_status === 'paid') {
            $user->update([
                'registration_paid_at' => now(),
                'registration_package' => $session->metadata->package ?? $user->registration_package,
                'stripe_checkout_session_id' => $session->id,
            ]);

            session(['registration_package' => $user->registration_package]);

            return redirect()->route('dashboard')->with('status', 'Payment successful — your conference registration is confirmed.');
        }

        return redirect()->route('dashboard')->with('error', 'Payment could not be verified. Please try again or contact support.');
    }

    public function cancel()
    {
        return redirect()->route('dashboard')->with('status', 'Checkout cancelled. You can complete payment when ready.');
    }

    public function webhook(Request $request)
    {
        $secret = config('services.stripe.webhook_secret');

        if (! $secret) {
            abort(Response::HTTP_NOT_FOUND);
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('Stripe-Signature', ''),
                $secret
            );
        } catch (SignatureVerificationException) {
            abort(Response::HTTP_BAD_REQUEST);
        }

        if ($event->type === 'checkout.session.completed') {
            /** @var \Stripe\Checkout\Session $session */
            $session = $event->data->object;

            if ($session->payment_status === 'paid' && ! empty($session->metadata->user_id)) {
                $user = \App\Models\User::find($session->metadata->user_id);

                if ($user) {
                    $user->update([
                        'registration_paid_at' => now(),
                        'registration_package' => $session->metadata->package ?? $user->registration_package,
                        'stripe_checkout_session_id' => $session->id,
                    ]);
                }
            }
        }

        return response()->json(['received' => true]);
    }
}
