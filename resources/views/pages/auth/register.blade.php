<x-layouts::auth.split :title="__('Register')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Name -->
            <div class="flex flex-col gap-1">
                <flux:label for="name" class="!text-black font-medium">{{ __('Name') }}</flux:label>
                <flux:input
                    id="name"
                    name="name"
                    :value="old('name')"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Full name')"
                    class="!border !border-zinc-400 !bg-white !text-black !shadow-none"
                />
            </div>

            <!-- Email Address -->
            <div class="flex flex-col gap-1">
                <flux:label for="email" class="!text-black font-medium">{{ __('Email address') }}</flux:label>
                <flux:input
                    id="email"
                    name="email"
                    :value="old('email')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="!border !border-zinc-400 !bg-white !text-black !shadow-none"
                />
            </div>

            <!-- Password -->
            <div class="flex flex-col gap-1">
                <flux:label for="password" class="!text-black font-medium">{{ __('Password') }}</flux:label>
                <flux:input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                    viewable
                    class="!border !border-zinc-400 !bg-white !text-black !shadow-none"
                />
            </div>

            <!-- Confirm Password -->
            <div class="flex flex-col gap-1">
                <flux:label for="password_confirmation" class="!text-black font-medium">{{ __('Confirm password') }}</flux:label>
                <flux:input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Confirm password')"
                    viewable
                    class="!border !border-zinc-400 !bg-white !text-black !shadow-none"
                />
            </div>

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full !bg-zinc-900 !text-white hover:!bg-zinc-800" data-test="register-user-button">
                    {{ __('Create account') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm font-medium !text-black">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" wire:navigate class="!text-black hover:!text-zinc-900">{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>