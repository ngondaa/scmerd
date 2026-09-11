<x-layouts::auth :title="__('Email verification')">
    <div class="mt-4 flex flex-col gap-6">
        <x-auth-header :title="__('Check your inbox')" :description="__('We sent a secure verification link to the address below. Verify it to continue your conference registration.')" />

        <div class="rounded-lg border border-zinc-200 bg-zinc-50 px-4 py-3 text-center">
            <p class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Verification email sent to</p>
            <p class="mt-1 break-all text-sm font-semibold text-zinc-950">{{ auth()->user()?->email }}</p>
        </div>

        <x-auth-validation-errors />

        @if (session('status') == 'verification-link-sent')
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-center text-sm font-medium text-green-800" role="status">
                {{ __('A fresh verification link is on its way. Check your inbox and spam or junk folder.') }}
            </div>
        @endif

        <div class="rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-950">
            <p class="font-semibold">Can’t find the email?</p>
            <p class="mt-1">Check your spam or junk folder, then resend it. The link expires after 60 minutes.</p>
        </div>

        <div class="flex flex-col items-center gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <flux:button type="submit" variant="primary" class="w-full !bg-zinc-900 !text-white hover:!bg-zinc-800" data-resend-button>
                    {{ __('Resend verification email') }}
                </flux:button>
            </form>

            <p class="text-center text-sm text-zinc-700">
                {{ __('Entered the wrong address?') }}
                <flux:link :href="route('profile.edit')" class="font-semibold !text-zinc-950 hover:!text-zinc-700">
                    {{ __('Correct your email address') }}
                </flux:link>
            </p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <flux:button variant="ghost" type="submit" class="cursor-pointer text-sm !text-zinc-700 hover:!text-zinc-950" data-test="logout-button">
                    {{ __('Log out') }}
                </flux:button>
            </form>
        </div>
    </div>

    @if (session('status') == 'verification-link-sent')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const button = document.querySelector('[data-resend-button]');
                if (!button) return;

                let remaining = 60;
                button.disabled = true;
                const originalText = button.textContent.trim();
                const updateButton = () => {
                    button.textContent = `Resend available in ${remaining}s`;
                    if (remaining-- <= 0) {
                        button.disabled = false;
                        button.textContent = originalText;
                        return;
                    }
                    window.setTimeout(updateButton, 1000);
                };
                updateButton();
            });
        </script>
    @endif
</x-layouts::auth>
