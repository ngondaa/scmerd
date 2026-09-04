<x-layouts::auth :title="__('Log in')">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    <div class="flex flex-col gap-5">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <flux:input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
                class="!border-zinc-400 !bg-white !text-black !shadow-none"
            />

            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                    class="!border-zinc-400 !bg-white !text-black !shadow-none"
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute -top-1 right-0 text-xs font-medium text-black hover:text-zinc-900" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </flux:link>
                @endif
            </div>

            <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" class="text-black" />

            @if (config('services.turnstile.site_key'))
                <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-action="login" data-theme="light"></div>
            @endif

            <div class="flex items-center justify-end pt-1">
                <flux:button variant="primary" type="submit" class="w-full !rounded-md !bg-zinc-900 !text-white hover:!bg-zinc-800" data-test="login-button">
                    {{ __('Log in') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-center text-sm text-black rtl:space-x-reverse">
                <span>{{ __('Don\'t have an account?') }}</span>
                <flux:link :href="route('register')" wire:navigate class="text-black hover:text-zinc-900">{{ __('Sign up') }}</flux:link>
            </div>
        @endif
    </div>
</x-layouts::auth>
