<x-layouts::app :title="__('Reviewer Dashboard')">
    @include('partials.portal.open')
    <main class="reviewer-page" aria-labelledby="reviewer-dashboard-title">
        <header class="reviewer-page-header">
            <div><h1 id="reviewer-dashboard-title">Reviewer dashboard</h1><p>Browse, assess, and respond to abstracts submitted to the conference.</p></div>
            <div class="reviewer-header-actions" aria-label="Export actions">
                <a href="{{ route('reviewer.exports.abstracts') }}" class="reviewer-button reviewer-button--dark">Export abstracts (CSV)</a>
                <a href="{{ route('reviewer.exports.attachments') }}" class="reviewer-button reviewer-button--outline">Download attachments (ZIP)</a>
            </div>
        </header>
        @if (session('status'))<div class="reviewer-toast" role="status">{{ session('status') }}</div>@endif
        <form class="reviewer-toolbar" method="GET" action="{{ route('reviewer.dashboard') }}">
            <div class="reviewer-search"><label class="sr-only" for="reviewer-search">Search abstracts</label><input id="reviewer-search" name="q" type="search" value="{{ request('q') }}" placeholder="Search by title or author"></div>
            <div class="reviewer-select-wrap"><label class="sr-only" for="reviewer-status">Filter by status</label><select id="reviewer-status" name="status"><option value="">All statuses</option>@foreach ($statuses as $status)<option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>@endforeach</select></div>
            <div class="reviewer-select-wrap"><label class="sr-only" for="reviewer-sort">Sort abstracts</label><select id="reviewer-sort" name="sort"><option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest first</option><option value="oldest" @selected(request('sort') === 'oldest')>Oldest first</option></select></div>
            <button class="reviewer-filter-button" type="submit">Apply</button><p class="reviewer-count">{{ $submissions->total() }} {{ Str::plural('abstract', $submissions->total()) }}</p>
        </form>
        @if ($submissions->isEmpty())
            <section class="reviewer-empty" aria-live="polite"><h2>{{ request()->hasAny(['q', 'status']) ? 'No abstracts match those filters.' : 'No abstracts have been submitted yet.' }}</h2><p>{{ request()->hasAny(['q', 'status']) ? 'Try changing the search terms or clearing a filter.' : 'New submissions will appear here when they are received.' }}</p>@if (request()->hasAny(['q', 'status']))<a href="{{ route('reviewer.dashboard') }}" class="reviewer-button reviewer-button--outline">Clear filters</a>@endif</section>
        @else
            <section class="reviewer-list" aria-label="Abstracts">
                @foreach ($submissions as $submission)
                    <a class="reviewer-row" href="{{ route('reviewer.submission.show', $submission) }}" aria-label="Open abstract: {{ $submission->title }}">
                        <div class="reviewer-row-copy"><h2>{{ $submission->title }}</h2><p class="reviewer-excerpt">{{ $submission->abstract }}</p><p class="reviewer-meta">{{ $submission->author }} <span aria-hidden="true">·</span> Submitted {{ $submission->submitted_at?->format('j M Y') ?? 'date unavailable' }} @if ($submission->attachment_path)<span class="reviewer-attachment" title="Attachment included" aria-label="Attachment included">⌕</span>@endif</p></div>
                        <div class="reviewer-row-aside"><span class="reviewer-status reviewer-status--{{ Str::slug($submission->status ?? 'Under Initial Review') }}">{{ $submission->status ?? 'Under Initial Review' }}</span><span class="reviewer-chevron" aria-hidden="true">›</span></div>
                    </a>
                @endforeach
            </section>
            @if ($submissions->hasPages())<nav class="reviewer-pagination" aria-label="Abstract pagination">{{ $submissions->links() }}</nav>@endif
        @endif
    </main>
</x-layouts::app>
