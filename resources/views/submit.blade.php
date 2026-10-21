<x-layouts::app :title="__('Submit')">

@include('partials.portal.open', ['narrow' => true])

<div class="cp-card cp-card--inset">
    <div class="cp-hero" style="margin-bottom:32px;padding-bottom:28px;">
        <p class="cp-kicker">Submission</p>
        <h1 class="cp-hello">Submit abstract</h1>
        <p class="cp-hello-sub">Upload your completed abstract as a Word document or PDF.</p>
    </div>

    <form method="POST" action="{{ route('submit.store') }}" enctype="multipart/form-data" class="cp-submission-form">
        @csrf

        <div class="cp-form-grid">
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
                <label for="keywords" class="cp-label">Keywords <span class="cp-label-optional">Optional</span></label>
                <input id="keywords" name="keywords" type="text" value="{{ old('keywords') }}" placeholder="mechanical, materials, energy" class="cp-input" />
                @error('keywords')<p class="cp-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="cp-file-upload">
            <label for="attachments" class="cp-label">Abstract documents</label>
            <input id="attachments" name="attachments[]" type="file" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple required class="cp-input-file" aria-describedby="attachment-help attachment-status" />
            <p id="attachment-help" class="cp-help-text">Required: one or more PDF, DOC, or DOCX files. Maximum file size: 25 MB per file.</p>
            <div id="attachment-status" class="cp-upload-status" aria-live="polite" hidden></div>
            @error('attachments')<p class="cp-error">{{ $message }}</p>@enderror
            @error('attachments.*')<p class="cp-error">{{ $message }}</p>@enderror
        </div>

        <div class="cp-footer">
            <button type="submit" class="cp-btn-primary">Submit abstract</button>
        </div>
    </form>
</div>

@include('partials.portal.close')

<script>
    document.getElementById('attachments')?.addEventListener('change', function () {
        const status = document.getElementById('attachment-status');
        const files = Array.from(this.files);

        if (! status) {
            return;
        }

        status.hidden = files.length === 0;
        status.replaceChildren();

        if (files.length === 0) {
            return;
        }

        const message = document.createElement('strong');
        message.textContent = `✓ ${files.length} ${files.length === 1 ? 'file' : 'files'} ready to upload`;

        const list = document.createElement('ul');
        files.forEach((file) => {
            const item = document.createElement('li');
            item.textContent = file.name;
            list.append(item);
        });

        status.append(message, list);
    });
</script>

</x-layouts::app>
