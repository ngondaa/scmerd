<x-layouts::auth :title="__('Register')">
    <div class="flex flex-col gap-5">
        <x-auth-header :title="__('Create an account')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />
        <x-auth-validation-errors />

        <a href="{{ route('auth.google.redirect') }}" class="flex w-full items-center justify-center rounded-md border border-zinc-300 bg-white px-4 py-2.5 text-sm font-semibold text-zinc-900 shadow-sm hover:bg-zinc-50">
            Sign up with Google
        </a>

        <div class="flex items-center gap-3 text-xs font-medium uppercase tracking-wide text-zinc-500">
            <span class="h-px flex-1 bg-zinc-200"></span>
            Or sign up with email
            <span class="h-px flex-1 bg-zinc-200"></span>
        </div>

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Name -->
            <div class="flex flex-col gap-1">
                <flux:label for="name" class="!text-[15px] !font-semibold !text-zinc-950">{{ __('Name') }}</flux:label>
                <flux:input
                    id="name"
                    name="name"
                    :value="old('name')"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Full name')"
                    class="!border !border-zinc-500 !bg-white !text-base !font-medium !text-zinc-950 !shadow-none placeholder:!font-normal placeholder:!text-zinc-500"
                />
            </div>

            <!-- Email Address -->
            <div class="flex flex-col gap-1">
                <flux:label for="email" class="!text-[15px] !font-semibold !text-zinc-950">{{ __('Email address') }}</flux:label>
                <flux:input
                    id="email"
                    name="email"
                    :value="old('email')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="!border !border-zinc-500 !bg-white !text-base !font-medium !text-zinc-950 !shadow-none placeholder:!font-normal placeholder:!text-zinc-500"
                />
            </div>

            <!-- Password -->
            <div class="flex flex-col gap-1">
                <flux:label for="password" class="!text-[15px] !font-semibold !text-zinc-950">{{ __('Password') }}</flux:label>
                <flux:input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                    viewable
                    class="!border !border-zinc-500 !bg-white !text-base !font-medium !text-zinc-950 !shadow-none placeholder:!font-normal placeholder:!text-zinc-500"
                />
            </div>

            <!-- Confirm Password -->
            <div class="flex flex-col gap-1">
                <flux:label for="password_confirmation" class="!text-[15px] !font-semibold !text-zinc-950">{{ __('Confirm password') }}</flux:label>
                <flux:input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Confirm password')"
                    viewable
                    class="!border !border-zinc-500 !bg-white !text-base !font-medium !text-zinc-950 !shadow-none placeholder:!font-normal placeholder:!text-zinc-500"
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
            <flux:link :href="route('login')" class="!text-black hover:!text-zinc-900">{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
