<x-layouts::app :title="__('Submit')">

@include('partials.portal.open', ['narrow' => true])

<div class="cp-card cp-card--inset">
    <div class="cp-hero" style="margin-bottom:32px;padding-bottom:28px;">
        <p class="cp-kicker">Submission</p>
        <h1 class="cp-hello">Submit abstract</h1>
        <p class="cp-hello-sub">Abstract-only author submission form with metadata and file upload.</p>
    </div>

    <form method="POST" action="{{ route('submit.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="cp-two-col">
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
                    <input id="keywords" name="keywords" type="text" value="{{ old('keywords') }}" placeholder="mechanical, materials, energy" class="cp-input" />
                    @error('keywords')<p class="cp-error">{{ $message }}</p>@enderror
                </div>

                <div class="cp-form-group">
                    <label for="attachment" class="cp-label">Attachment (optional)</label>
                    <input id="attachment" name="attachment" type="file" class="cp-input-file" />
                    <p class="cp-help-text">Max file size: 10MB.</p>
                    @error('attachment')<p class="cp-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="cp-col">
                <div class="cp-form-group">
                    <label for="abstract" class="cp-label">Abstract</label>
                    <textarea id="abstract" name="abstract" rows="18" required class="cp-textarea">{{ old('abstract') }}</textarea>
                    @error('abstract')<p class="cp-error">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="cp-footer">
            <button type="submit" class="cp-btn-primary">Submit abstract</button>
        </div>
    </form>
</div>

@include('partials.portal.close')

</x-layouts::app>
