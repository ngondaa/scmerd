<x-layouts::app :title="__('Submit')">
    <div class="mx-auto w-full max-w-3xl">
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-900">
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Submit Abstract</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
                Abstract-only author submission form with metadata and file upload.
            </p>

            <form method="POST" action="{{ route('submit.store') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-zinc-800 dark:text-zinc-100">Title</label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        value="{{ old('title') }}"
                        required
                        class="mt-1 w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-500 focus:outline-none dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100"
                    />
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="author" class="block text-sm font-medium text-zinc-800 dark:text-zinc-100">Author</label>
                    <input
                        id="author"
                        name="author"
                        type="text"
                        value="{{ old('author') }}"
                        required
                        class="mt-1 w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-500 focus:outline-none dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100"
                    />
                    @error('author')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="track" class="block text-sm font-medium text-zinc-800 dark:text-zinc-100">Track</label>
                    <select
                        id="track"
                        name="track"
                        required
                        class="mt-1 w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-500 focus:outline-none dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100"
                    >
                        @foreach ($tracks as $track)
                            <option value="{{ $track }}" @selected(old('track', 'Abstract Submission') === $track)>{{ $track }}</option>
                        @endforeach
                    </select>
                    @error('track')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="keywords" class="block text-sm font-medium text-zinc-800 dark:text-zinc-100">Keywords</label>
                    <input
                        id="keywords"
                        name="keywords"
                        type="text"
                        value="{{ old('keywords') }}"
                        placeholder="ai, vision, llm"
                        class="mt-1 w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-500 focus:outline-none dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100"
                    />
                    @error('keywords')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="abstract" class="block text-sm font-medium text-zinc-800 dark:text-zinc-100">Abstract</label>
                    <textarea
                        id="abstract"
                        name="abstract"
                        rows="8"
                        required
                        class="mt-1 w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-500 focus:outline-none dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100"
                    >{{ old('abstract') }}</textarea>
                    @error('abstract')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="attachment" class="block text-sm font-medium text-zinc-800 dark:text-zinc-100">Attachment (optional)</label>
                    <input
                        id="attachment"
                        name="attachment"
                        type="file"
                        class="mt-1 w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-zinc-900 file:px-3 file:py-1 file:text-white dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100 dark:file:bg-zinc-100 dark:file:text-zinc-900"
                    />
                    <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Max file size: 10MB.</p>
                    @error('attachment')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-300"
                >
                    Submit Abstract
                </button>
            </form>
        </div>
    </div>
</x-layouts::app>
