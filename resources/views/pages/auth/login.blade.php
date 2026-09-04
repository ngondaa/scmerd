<x-layouts::auth :title="__('Log in')">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    <div class="flex flex-col gap-5">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <div class="flex flex-col gap-1">
                <flux:label for="email" class="!text-[15px] !font-semibold !text-zinc-950">{{ __('Email address') }}</flux:label>
                <flux:input
                    id="email"
                    name="email"
                    :value="old('email')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="!border !border-zinc-500 !bg-white !text-base !font-medium !text-zinc-950 !shadow-none placeholder:!font-normal placeholder:!text-zinc-500"
                />
            </div>

            <div class="relative flex flex-col gap-1">
                <flux:label for="password" class="!text-[15px] !font-semibold !text-zinc-950">{{ __('Password') }}</flux:label>
                <flux:input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                    class="!border !border-zinc-500 !bg-white !text-base !font-medium !text-zinc-950 !shadow-none placeholder:!font-normal placeholder:!text-zinc-500"
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute -top-1 right-0 text-sm !font-semibold !text-zinc-950 hover:!text-zinc-700" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </flux:link>
                @endif
            </div>

            <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" class="!font-semibold !text-zinc-950" />

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
            <div class="space-x-1 text-center text-sm font-medium !text-black rtl:space-x-reverse">
                <span>{{ __('Don\'t have an account?') }}</span>
                <flux:link :href="route('register')" wire:navigate class="!text-black hover:!text-zinc-900">{{ __('Sign up') }}</flux:link>
            </div>
        @endif
    </div>
</x-layouts::auth>
