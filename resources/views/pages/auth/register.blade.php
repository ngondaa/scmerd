<x-layouts::auth :title="__('Register')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Start your registration')" :description="__('Create your account first. You will verify your email before payment and abstract submission.')" />

        <ol class="grid grid-cols-3 gap-2 text-center text-xs font-semibold text-zinc-800" aria-label="Registration steps">
            <li class="rounded-md bg-zinc-950 px-2 py-2 text-white" aria-current="step">1. Account</li>
            <li class="rounded-md border border-zinc-300 px-2 py-2">2. Verify email</li>
            <li class="rounded-md border border-zinc-300 px-2 py-2">3. Register</li>
        </ol>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />
        <x-auth-validation-errors :errors="$errors->except('email')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
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
                    :aria-invalid="$errors->has('email') ? 'true' : 'false'"
                    aria-describedby="email-help email-error"
                    class="!border !border-zinc-500 !bg-white !text-base !font-medium !text-zinc-950 !shadow-none placeholder:!font-normal placeholder:!text-zinc-500"
                />
                <p id="email-help" class="text-xs font-medium text-zinc-700">Use an address you can open now. We’ll send a verification link to it.</p>

                @if ($errors->has('email'))
                    <div id="email-error" class="rounded-md border border-red-300 bg-red-50 px-3 py-3 text-sm text-red-900" role="alert">
                        <p class="font-semibold">{{ $errors->first('email') }}</p>
                        @if (str_contains($errors->first('email'), 'already been taken'))
                            <p class="mt-2">
                                {{ __('This address already has an account.') }}
                                <a href="{{ route('login', ['email' => old('email')]) }}" class="font-bold underline underline-offset-2">{{ __('Log in instead') }}</a>
                                {{ __('or') }}
                                <a href="{{ route('password.request', ['email' => old('email')]) }}" class="font-bold underline underline-offset-2">{{ __('reset your password') }}</a>.
                            </p>
                        @endif
                    </div>
                @endif
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
                <p class="text-xs font-medium text-zinc-700">Use 12 or more characters with upper- and lower-case letters, a number, and a symbol.</p>
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
                    {{ __('Continue to email verification') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm font-medium !text-black">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" class="!text-black hover:!text-zinc-900">{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
