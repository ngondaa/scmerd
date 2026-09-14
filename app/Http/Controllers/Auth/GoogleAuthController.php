<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function callback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('login')->withErrors([
                'email' => 'Google sign-in could not be completed. Please try again.',
            ]);
        }

        $email = $googleUser->getEmail();

        if (! filled($email)) {
            return redirect()->route('login')->withErrors([
                'email' => 'Google did not provide an email address for this account.',
            ]);
        }

        $user = User::query()->firstWhere('google_id', $googleUser->getId())
            ?? User::query()->firstWhere('email', $email);

        if ($user) {
            $user->forceFill([
                'google_id' => $googleUser->getId(),
            ])->save();
        } else {
            $user = User::create([
                'name' => $googleUser->getName() ?: Str::before($email, '@'),
                'email' => $email,
                'google_id' => $googleUser->getId(),
                'password' => Str::password(40),
            ]);
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
