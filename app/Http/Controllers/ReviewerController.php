<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class ReviewerController extends Controller
{
    public function dashboard(Request $request)
    {
        if (! auth()->check() || ! auth()->user()->is_reviewer) {
            abort(403, 'Reviewer access required.');
        }

        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:100'],
            'sort' => ['nullable', 'in:newest,oldest'],
        ]);

        $submissions = Submission::query()
            ->with('user')
            ->when($filters['q'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->orderBy('submitted_at', ($filters['sort'] ?? 'newest') === 'oldest' ? 'asc' : 'desc')
            ->paginate(12)
            ->withQueryString();

        $statuses = Submission::query()
            ->whereNotNull('status')
            ->distinct()
            ->orderBy('status')
            ->pluck('status');

        return view('reviewer.dashboard', [
            'submissions' => $submissions,
            'statuses' => $statuses,
        ]);
    }

    public function storeComment(Request $request, Submission $submission)
    {
        if (! auth()->check() || ! auth()->user()->is_reviewer) {
            abort(403, 'Reviewer access required.');
        }

        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:3000'],
            'status' => ['nullable', 'in:Under Initial Review,Rebuttal Open,Accepted,Revisions Requested,Rejected'],
        ]);

        $review = Review::create([
            'submission_id' => $submission->id,
            'user_id' => auth()->id(),
            'comment' => $validated['comment'],
            'status' => $validated['status'] ?? null,
        ]);

        if (! empty($validated['status'])) {
            $submission->status = $validated['status'];
            $submission->save();
        }

        return back()->with('status', 'Review saved.');
    }

    public function show(Submission $submission)
    {
        if (! auth()->check() || ! auth()->user()->is_reviewer) {
            abort(403, 'Reviewer access required.');
        }

        $submission->load(['user', 'reviews.user', 'reviewers']);

        $previousSubmission = Submission::query()
            ->where('submitted_at', '<', $submission->submitted_at)
            ->orderByDesc('submitted_at')
            ->first();
        $nextSubmission = Submission::query()
            ->where('submitted_at', '>', $submission->submitted_at)
            ->orderBy('submitted_at')
            ->first();

        $attachmentSize = null;
        if ($submission->attachment_path && Storage::disk('public')->exists($submission->attachment_path)) {
            $attachmentSize = Storage::disk('public')->size($submission->attachment_path);
        }

        return view('reviewer.show', [
            'submission' => $submission,
            'previousSubmission' => $previousSubmission,
            'nextSubmission' => $nextSubmission,
            'attachmentSize' => $attachmentSize,
        ]);
    }

    public function assignReviewer(Request $request, Submission $submission)
    {
        if (! auth()->check() || ! auth()->user()->is_reviewer) {
            abort(403, 'Reviewer access required.');
        }

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $user = User::find($validated['user_id']);
        if (! $user || ! $user->is_reviewer) {
            return back()->withErrors(['user_id' => 'Selected user is not a reviewer']);
        }

        if (! $submission->reviewers()->where('user_id', $user->id)->exists()) {
            $submission->reviewers()->attach($user->id, ['assigned_at' => now()]);
        }

        return back()->with('status', 'Reviewer assigned.');
    }

    public function exportAbstracts()
    {
        if (! auth()->check() || ! auth()->user()->is_reviewer) {
            abort(403, 'Reviewer access required.');
        }

        $submissions = Submission::with('user')->latest('submitted_at')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="abstracts.csv"',
        ];

        $callback = function () use ($submissions) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Title', 'Author', 'Track', 'Abstract', 'Status', 'Submitted At', 'User Email']);
            foreach ($submissions as $s) {
                fputcsv($handle, [
                    (string) $s->id,
                    $s->title,
                    $s->author,
                    $s->track,
                    $s->abstract,
                    $s->status,
                    $s->submitted_at?->toDateTimeString(),
                    $s->user?->email,
                ]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function downloadAllAttachments()
    {
        if (! auth()->check() || ! auth()->user()->is_reviewer) {
            abort(403, 'Reviewer access required.');
        }

        $submissions = Submission::whereNotNull('attachment_path')->get();

        $zip = new ZipArchive;
        $filename = storage_path('app/public/reviewer_attachments_'.Str::slug(now()->toDateTimeString()).'.zip');

        if ($zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Could not create ZIP archive.');
        }

        $disk = Storage::disk('public');

        foreach ($submissions as $s) {
            if ($s->attachment_path && $disk->exists($s->attachment_path)) {
                $path = $disk->path($s->attachment_path);
                $localName = basename($s->attachment_path);
                $zip->addFile($path, $s->id.'/'.$localName);
            }
        }

        $zip->close();

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
