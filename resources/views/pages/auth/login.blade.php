<x-layouts::auth :title="__('Log in')">
    <div class="flex flex-col gap-6">
        <div class="mb-2 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-zinc-100 text-xl font-semibold text-zinc-800 shadow-sm ring-1 ring-zinc-200">
                {{ strtoupper(substr(config('app.name', 'SCM'), 0, 1)) }}
            </div>
        </div>

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
                class="!rounded-xl !border-zinc-300 !bg-white !text-zinc-800"
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
                    class="!rounded-xl !border-zinc-300 !bg-white !text-zinc-800"
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute -top-1 right-0 text-xs font-medium text-zinc-600 hover:text-zinc-900" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot password?') }}
                    </flux:link>
                @endif
            </div>

            <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />

            <div class="pt-2">
                <flux:button variant="primary" type="submit" class="w-full !rounded-xl !py-3 !text-base" data-test="login-button">
                    {{ __('Log in') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-center text-sm text-zinc-600 rtl:space-x-reverse dark:text-zinc-400">
                <span>{{ __('Don\'t have an account?') }}</span>
                <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
            </div>
        @endif
    </div>
</x-layouts::auth>
