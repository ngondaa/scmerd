<x-layouts::app :title="__('Submit')">
<style>
    .cp-shell { background: #f0f0f5; border-radius: 20px; padding: 16px; font-family: var(--font-sans, ui-sans-serif, system-ui, sans-serif); max-width: 800px; margin: 0 auto; }
    .cp-card { background: #fff; border-radius: 16px; padding: 24px; }
    .cp-hello { font-size: 28px; font-weight: 500; color: #1a1a2e; letter-spacing: -0.02em; line-height: 1.15; margin-bottom: 4px; }
    .cp-hello-sub { font-size: 13px; color: #888; margin-bottom: 24px; }
    .cp-two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start; }
    .cp-col { display: flex; flex-direction: column; gap: 20px; }
    .cp-abstract-col { display: flex; flex-direction: column; }
    .cp-abstract-col .cp-form-group { display: flex; flex-direction: column; }
    .cp-form-group { margin-bottom: 0; }
    .cp-label { display: block; font-size: 13px; font-weight: 500; color: #1a1a2e; margin-bottom: 8px; }
    .cp-input, .cp-textarea, .cp-select { width: 100%; border: 1px solid #e0e0ee; border-radius: 12px; padding: 10px 14px; font-size: 13px; font-family: inherit; color: #1a1a2e; background: #fff; transition: border-color 0.15s; outline: none; box-sizing: border-box; }
    .cp-input:focus, .cp-textarea:focus, .cp-select:focus { border-color: #4b3fa0; }
    .cp-textarea { resize: vertical; min-height: 340px; }
    .cp-input-file { font-size: 12px; color: #555; }
    .cp-input-file::file-selector-button { background: #e0e0ee; border: none; border-radius: 8px; padding: 6px 12px; font-size: 12px; font-weight: 500; color: #1a1a2e; cursor: pointer; margin-right: 12px; transition: background 0.15s; }
    .cp-input-file::file-selector-button:hover { background: #d0d0e8; }
    .cp-btn-primary { background: #1a1a2e; color: #e8e8f5; border: none; border-radius: 12px; padding: 10px 20px; font-size: 13px; font-weight: 500; cursor: pointer; transition: background 0.15s; display: inline-block; text-decoration: none; }
    .cp-btn-primary:hover { background: #2e2e52; }
    .cp-footer { margin-top: 24px; padding-top: 20px; border-top: 1px solid #e0e0ee; }
    .cp-error { font-size: 11px; color: #d32f2f; margin-top: 6px; }
    .cp-help-text { font-size: 11px; color: #888; margin-top: 6px; }
    @media (max-width: 600px) {
        .cp-two-col { grid-template-columns: 1fr; }
    }
</style>

<div class="cp-shell">
    @include('partials.topbar')
    <div class="cp-card">
        <h1 class="cp-hello">Submit Abstract</h1>
        <p class="cp-hello-sub">Abstract-only author submission form with metadata and file upload.</p>

        <form method="POST" action="{{ route('submit.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="cp-two-col">

                {{-- Left column: metadata fields --}}
                <div class="cp-col">

                    <div class="cp-form-group">
                        <label for="title" class="cp-label">Title</label>
                        <input id="title" name="title" type="text" value="{{ old('title') }}" required class="cp-input" />
                        @error('title')<p class="cp-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="cp-form-group">
                        <label for="author" class="cp-label">Author</label>
                        <input id="author" name="author" type="text" value="{{ old('author') }}" required class="cp-input" />
                        @error('author')<p class="cp-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="cp-form-group">
                        <label for="track" class="cp-label">Track</label>
                        <select id="track" name="track" required class="cp-select">
                            @foreach ($tracks as $track)
                                <option value="{{ $track }}" @selected(old('track', 'Abstract Submission') === $track)>{{ $track }}</option>
                            @endforeach
                        </select>
                        @error('track')<p class="cp-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="cp-form-group">
                        <label for="keywords" class="cp-label">Keywords</label>
                        <input id="keywords" name="keywords" type="text" value="{{ old('keywords') }}" placeholder="ai, vision, llm" class="cp-input" />
                        @error('keywords')<p class="cp-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="cp-form-group">
                        <label for="attachment" class="cp-label">Attachment (optional)</label>
                        <input id="attachment" name="attachment" type="file" class="cp-input-file" />
                        <p class="cp-help-text">Max file size: 10MB.</p>
                        @error('attachment')<p class="cp-error">{{ $message }}</p>@enderror
                    </div>

                </div>

                {{-- Right column: abstract --}}
                <div class="cp-abstract-col">
                    <div class="cp-form-group">
                        <label for="abstract" class="cp-label">Abstract</label>
                        <textarea id="abstract" name="abstract" rows="18" required class="cp-textarea">{{ old('abstract') }}</textarea>
                        @error('abstract')<p class="cp-error">{{ $message }}</p>@enderror
                    </div>
                </div>

            </div>

            <div class="cp-footer">
                <button type="submit" class="cp-btn-primary">Submit Abstract</button>
            </div>

        </form>
    </div>
</div>
</x-layouts::app>