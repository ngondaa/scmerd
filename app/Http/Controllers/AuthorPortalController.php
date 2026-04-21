<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function showSubmit()
    {
        return view('submit', ['tracks' => $this->availableTracks()]);
    }

    public function storeSubmit(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'track' => ['required', 'string', 'max:100'],
            'abstract' => ['required', 'string', 'max:5000'],
            'keywords' => ['nullable', 'string', 'max:255'],
            'attachment' => ['nullable', 'file', 'max:10240'],
        ]);

        $attachmentPath = null;
        $attachmentName = null;
        if ($request->hasFile('attachment')) {
            $stored = $request->file('attachment')->store('submissions', 'public');
            $attachmentPath = $stored;
            $attachmentName = $request->file('attachment')->getClientOriginalName();
        }

        $submission = [
            'id' => (string) Str::uuid(),
            'title' => $validated['title'],
            'author' => $validated['author'],
            'track' => $validated['track'],
            'stage' => 'Abstract Submission',
            'keywords' => $validated['keywords'] ?? '',
            'abstract' => $validated['abstract'],
            'status' => 'Under Initial Review',
            'submitted_at' => now()->toDateTimeString(),
            'attachment_path' => $attachmentPath,
            'attachment_name' => $attachmentName,
            'comments' => [
                'Submission received. Editorial screening has started.',
                'Track chairs will verify scope and formatting.',
            ],
            'rebuttal' => null,
        ];

        $submissions = $this->submissions();
        array_unshift($submissions, $submission);
        session(['submissions' => $submissions]);

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
        $submission = collect($this->submissions())->firstWhere('id', $id);
        if (! $submission || empty($submission['attachment_path'])) {
            abort(404);
        }

        $disk = Storage::disk('public');
        if (! $disk->exists($submission['attachment_path'])) {
            abort(404);
        }

        return response()->download(
            $disk->path($submission['attachment_path']),
            $submission['attachment_name'] ?? basename($submission['attachment_path'])
        );
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

    private function submissions(): array
    {
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
