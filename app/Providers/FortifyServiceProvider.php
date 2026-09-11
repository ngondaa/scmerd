<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\CustomLoginResponse;
use App\Actions\Fortify\CustomRegisterResponse;
use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
        $this->configureEmailVerificationNotification();

        Fortify::authenticateThrough(function (Request $request) {
            return array_filter([
                config('fortify.limiters.login') ? null : \Laravel\Fortify\Actions\EnsureLoginIsNotThrottled::class,
                config('fortify.lowercase_usernames') ? \Laravel\Fortify\Actions\CanonicalizeUsername::class : null,
                \Laravel\Fortify\Features::enabled(\Laravel\Fortify\Features::twoFactorAuthentication()) ? \Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable::class : null,
                \Laravel\Fortify\Actions\AttemptToAuthenticate::class,
                \Laravel\Fortify\Actions\PrepareAuthenticatedSession::class,
            ]);
        });

        // Send unverified users to the verification notice after login or registration.
        $this->app->singleton(LoginResponseContract::class, CustomLoginResponse::class);
        $this->app->singleton(RegisterResponseContract::class, CustomRegisterResponse::class);
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(fn () => view('pages::auth.login'));
        Fortify::verifyEmailView(fn () => view('pages::auth.verify-email'));
        Fortify::twoFactorChallengeView(fn () => view('pages::auth.two-factor-challenge'));
        Fortify::confirmPasswordView(fn () => view('pages::auth.confirm-password'));
        Fortify::registerView(fn () => view('pages::auth.register'));
        Fortify::resetPasswordView(fn () => view('pages::auth.reset-password'));
        Fortify::requestPasswordResetLinkView(fn () => view('pages::auth.forgot-password'));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }

    /**
     * Use a concise, recognisable verification email. The default Laravel
     * message is technically sound, but gives conference delegates too little
     * context when it lands alongside their other event correspondence.
     */
    private function configureEmailVerificationNotification(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url): MailMessage {
            $expiresIn = config('auth.verification.expire', 60);
            $message = (new MailMessage)
                ->subject('Verify your '.config('app.name').' account')
                ->greeting('Welcome, '.$notifiable->name.'!')
                ->line('Please verify your email address to continue to conference registration and abstract submission.')
                ->action('Verify email address', $url)
                ->line("For your security, this link expires in {$expiresIn} minutes.")
                ->line('If you did not create this account, you can safely ignore this email.');

            if (filled(config('mail.reply_to.address'))) {
                $message->replyTo(
                    config('mail.reply_to.address'),
                    config('mail.reply_to.name') ?: null,
                );
            }

            return $message;
        });
    }

}
