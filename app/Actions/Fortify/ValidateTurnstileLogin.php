<?php

namespace App\Actions\Fortify;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class ValidateTurnstileLogin
{
    public function handle(Request $request, Closure $next)
    {
        $secret = config('services.turnstile.secret');

        if (! is_string($secret) || $secret === '') {
            return $next($request);
        }

        $token = (string) $request->input('cf-turnstile-response', '');

        if ($token === '') {
            throw ValidationException::withMessages([
                'cf-turnstile-response' => ['Please complete the security check.'],
            ]);
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
            || ($result['action'] ?? null) !== 'login'
            || ! $hostnameValid) {
            throw ValidationException::withMessages([
                'cf-turnstile-response' => ['Security verification failed. Please try again.'],
            ]);
        }

        return $next($request);
    }
}
