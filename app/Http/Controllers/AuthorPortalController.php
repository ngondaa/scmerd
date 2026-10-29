<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\Submission;
use App\Models\SubmissionAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthorPortalController extends Controller
{
    public function dashboard()
    {
        $submissions = $this->submissions();

        $stats = [
            'total' => count($submissions),
            'under_review' => count(array_filter($submissions, fn ($s) => $s['status'] === 'Under Initial Review')),
            'rebuttal_open' => count(array_filter($submissions, fn ($s) => $s['status'] === 'Rebuttal Open')),
            'accepted' => count(array_filter($submissions, fn ($s) => $s['status'] === 'Accepted')),
        ];

        return view('dashboard', [
            'submissions' => $submissions,
            'stats' => $stats,
        ]);
    }

    public function updatePackage(Request $request)
    {
        if (! $this->registrationIsOpen()) {
            return redirect()->route('dashboard')->with('error', 'Registration is currently closed.');
        }

        $validated = $request->validate([
            'package' => ['required', 'string', Rule::in(array_keys(config('registration.packages')))],
        ]);

        $user = $request->user();

        // Store package in session if user model doesn't have registration_package yet
        session(['registration_package' => $validated['package']]);

        // Try to save to database if column exists
        try {
            if (Schema::hasColumn('users', 'registration_package')) {
                $user->update(['registration_package' => $validated['package']]);
            }
        } catch (\Exception $e) {
            // Column doesn't exist yet, fall back to session storage
        }

        return redirect()
            ->route('registration.proof', ['package' => $validated['package']])
            ->with('status', 'Registration package selected successfully.');
    }

    public function showSubmit()
    {
        if (! $this->abstractSubmissionsAreOpen()) {
            return redirect()->route('abstracts')->with('error', 'Abstract submissions are currently closed.');
        }

        return view('submit', ['tracks' => $this->availableTracks()]);
    }

    public function storeSubmit(Request $request)
    {
        if (! $this->abstractSubmissionsAreOpen()) {
            return redirect()->route('abstracts')->with('error', 'Abstract submissions are currently closed.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'track' => ['required', 'string', 'max:100'],
            'keywords' => ['nullable', 'string', 'max:255'],
            'attachments' => ['required', 'array', 'min:1'],
            'attachments.*' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:25600'],
        ]);

        $attachments = collect($request->file('attachments'))
            ->map(fn ($file) => [
                'path' => $file->store('submissions', 'public'),
                'original_name' => $file->getClientOriginalName(),
            ]);

        $primaryAttachment = $attachments->first();

        $submission = [
            'id' => (string) Str::uuid(),
            'title' => $validated['title'],
            'author' => $validated['author'],
            'track' => $validated['track'],
            'stage' => 'Abstract Submission',
            'keywords' => $validated['keywords'] ?? '',
            'abstract' => null,
            'status' => 'Under Initial Review',
            'submitted_at' => now()->toDateTimeString(),
            'attachment_path' => $primaryAttachment['path'],
            'attachment_name' => $primaryAttachment['original_name'],
            'attachments' => $attachments->all(),
            'comments' => [
                'Submission received. Editorial screening has started.',
                'Track chairs will verify scope and formatting.',
            ],
            'rebuttal' => null,
        ];

        $submissions = $this->submissions();
        array_unshift($submissions, $submission);
        session(['submissions' => $submissions]);

        $databaseSubmission = Submission::create([
            'user_id' => auth()->id(),
            'title' => $submission['title'],
            'author' => $submission['author'],
            'track' => $submission['track'],
            'stage' => $submission['stage'],
            'keywords' => $submission['keywords'],
            'abstract' => $submission['abstract'],
            'status' => $submission['status'],
            'submitted_at' => $submission['submitted_at'],
            'attachment_path' => $submission['attachment_path'],
            'attachment_name' => $submission['attachment_name'],
            'comments' => $submission['comments'],
            'rebuttal' => $submission['rebuttal'],
        ]);

        $databaseSubmission->attachments()->createMany($attachments->all());

        $this->notify("Submission '{$submission['title']}' was received.");

        return redirect()->route('abstracts')->with('status', 'Abstract submitted successfully.');
    }

    public function abstracts()
    {
        return view('abstracts', [
            'submissions' => $this->submissions(),
        ]);
    }

    public function tracks()
    {
        return view('tracks', [
            'tracks' => $this->availableTracks(),
            'submissions' => $this->submissions(),
        ]);
    }

    public function instructions()
    {
        return view('instructions');
    }

    public function rebuttals()
    {
        return view('rebuttals', [
            'submissions' => $this->submissions(),
        ]);
    }

    public function storeRebuttal(Request $request, string $id)
    {
        $validated = $request->validate([
            'rebuttal' => ['required', 'string', 'max:3000'],
        ]);

        $submissions = $this->submissions();
        foreach ($submissions as &$submission) {
            if ($submission['id'] !== $id) {
                continue;
            }

            $submission['rebuttal'] = $validated['rebuttal'];
            $submission['status'] = 'Rebuttal Submitted';
            $submission['comments'][] = 'Author rebuttal submitted and shared with reviewers.';
            break;
        }
        unset($submission);

        session(['submissions' => $submissions]);
        $this->notify('Your rebuttal has been submitted.');

        return redirect()->route('rebuttals')->with('status', 'Rebuttal submitted successfully.');
    }

    public function notifications()
    {
        return view('notifications', [
            'notifications' => session('notifications', []),
        ]);
    }

    public function downloads()
    {
        return view('downloads', [
            'submissions' => $this->submissions(),
        ]);
    }

    public function downloadAttachment(string $id)
    {
        $submission = Submission::query()
            ->when(! auth()->user()->is_reviewer, fn ($query) => $query->where('user_id', auth()->id()))
            ->find($id);

        if (! $submission || empty($submission->attachment_path)) {
            abort(404);
        }

        $disk = Storage::disk('public');
        if (! $disk->exists($submission->attachment_path)) {
            abort(404);
        }

        return response()->download(
            $disk->path($submission->attachment_path),
            $submission->attachment_name ?? basename($submission->attachment_path)
        );
    }

    public function downloadAdditionalAttachment(Submission $submission, SubmissionAttachment $attachment)
    {
        abort_unless(
            $attachment->submission_id === $submission->id
                && (auth()->user()->is_reviewer || $submission->user_id === auth()->id()),
            404,
        );

        $disk = Storage::disk('public');

        if (! $disk->exists($attachment->path)) {
            abort(404);
        }

        return response()->download($disk->path($attachment->path), $attachment->original_name);
    }

    public function exportCsv()
    {
        $submissions = $this->submissions();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="my-submissions.csv"',
        ];

        $callback = function () use ($submissions) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Title', 'Author', 'Track', 'Stage', 'Status', 'Submitted At']);
            foreach ($submissions as $submission) {
                fputcsv($handle, [
                    $submission['title'],
                    $submission['author'],
                    $submission['track'],
                    $submission['stage'],
                    $submission['status'],
                    $submission['submitted_at'],
                ]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    private function availableTracks(): array
    {
        return [
            'Abstract Submission',
        ];
    }

    private function registrationIsOpen(): bool
    {
        return (bool) AppSetting::get('registration_open', '1');
    }

    private function abstractSubmissionsAreOpen(): bool
    {
        return (bool) AppSetting::get('abstract_submissions_open', '1');
    }

    private function submissions(): array
    {
        if (auth()->check()) {
            $userSubmissions = Submission::query()
                ->with('attachments')
                ->where('user_id', auth()->id())
                ->orderByDesc('submitted_at')
                ->get()
                ->map(fn (Submission $submission) => [
                    'id' => (string) $submission->id,
                    'title' => $submission->title,
                    'author' => $submission->author,
                    'track' => $submission->track,
                    'stage' => $submission->stage,
                    'keywords' => $submission->keywords,
                    'abstract' => $submission->abstract,
                    'status' => $submission->status,
                    'submitted_at' => $submission->submitted_at?->toDateTimeString(),
                    'attachment_path' => $submission->attachment_path,
                    'attachment_name' => $submission->attachment_name,
                    'attachments' => $submission->attachments
                        ->map(fn ($attachment) => [
                            'id' => (string) $attachment->id,
                            'name' => $attachment->original_name,
                        ])
                        ->all(),
                    'comments' => $submission->comments ?? [],
                    'rebuttal' => $submission->rebuttal,
                ])
                ->all();

            if (! empty($userSubmissions)) {
                return $userSubmissions;
            }
        }

        return session('submissions', []);
    }

    private function notify(string $message): void
    {
        $notifications = session('notifications', []);
        array_unshift($notifications, [
            'message' => $message,
            'at' => now()->toDateTimeString(),
        ]);
        session(['notifications' => $notifications]);
    }
}
