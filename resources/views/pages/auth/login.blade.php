<x-layouts::auth :title="__('Continue with Google')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Welcome to Central Branch')" :description="__('Sign in or create your conference account with Google.')" />

        <x-auth-validation-errors />

        <a href="{{ route('auth.google.redirect') }}" class="flex w-full items-center justify-center gap-3 rounded-md border border-zinc-300 bg-white px-4 py-3 text-sm font-semibold text-zinc-900 shadow-sm transition hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2">
            <svg aria-hidden="true" class="size-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path fill="#4285F4" d="M21.35 12.23c0-.71-.06-1.39-.18-2.05H12v3.88h5.24a4.48 4.48 0 0 1-1.94 2.94v2.51h3.14c1.84-1.69 2.91-4.19 2.91-7.28Z"/>
                <path fill="#34A853" d="M12 21.75c2.63 0 4.84-.87 6.45-2.35l-3.14-2.51c-.87.58-1.99.92-3.31.92-2.54 0-4.7-1.72-5.47-4.03H3.29A9.75 9.75 0 0 0 12 21.75Z"/>
                <path fill="#FBBC05" d="M6.53 13.78A5.87 5.87 0 0 1 6.23 12c0-.62.11-1.22.3-1.78V7.63H3.29A9.75 9.75 0 0 0 2.25 12c0 1.57.38 3.06 1.04 4.37l3.24-2.59Z"/>
                <path fill="#EA4335" d="M12 6.19c1.43 0 2.71.49 3.72 1.45l2.79-2.79C16.84 3.29 14.63 2.25 12 2.25a9.75 9.75 0 0 0-8.71 5.38l3.24 2.59c.77-2.31 2.93-4.03 5.47-4.03Z"/>
            </svg>
            Continue with Google
        </a>

        <p class="text-center text-sm leading-6 text-zinc-600">Your Google account is used only to securely create or access your conference account.</p>
    </div>
</x-layouts::auth>
