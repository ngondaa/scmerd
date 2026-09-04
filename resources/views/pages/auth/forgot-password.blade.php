<x-layouts::auth :title="__('Forgot password')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <div class="flex flex-col gap-1">
                <flux:label for="email" class="!text-zinc-950 font-medium">{{ __('Email address') }}</flux:label>
                <flux:input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="!border !border-zinc-400 !bg-white !text-zinc-950 !shadow-none"
                />
            </div>

            <flux:button variant="primary" type="submit" class="w-full !bg-zinc-900 !text-white hover:!bg-zinc-800" data-test="email-password-reset-link-button">
                {{ __('Email password reset link') }}
            </flux:button>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-700">
            <span>{{ __('Or, return to') }}</span>
            <flux:link :href="route('login')" wire:navigate class="!text-zinc-950 hover:!text-zinc-700">{{ __('log in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
