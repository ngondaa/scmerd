<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use ZipArchive;
use Illuminate\Support\Str;

class ReviewerController extends Controller
{
    public function dashboard()
    {
        if (! auth()->check() || ! auth()->user()->is_reviewer) {
            abort(403, 'Reviewer access required.');
        }

        $submissions = Submission::with(['user', 'reviews.user'])->latest('submitted_at')->get();

        return view('reviewer.dashboard', [
            'submissions' => $submissions,
        ]);
    }

    public function storeComment(Request $request, Submission $submission)
    {
        if (! auth()->check() || ! auth()->user()->is_reviewer) {
            abort(403, 'Reviewer access required.');
        }

        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:3000'],
            'status' => ['nullable', 'string', 'max:100'],
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

        $possibleReviewers = User::where('is_reviewer', true)->get();

        return view('reviewer.show', [
            'submission' => $submission,
            'possibleReviewers' => $possibleReviewers,
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

        $zip = new ZipArchive();
        $filename = storage_path('app/public/reviewer_attachments_'.Str::slug(now()->toDateTimeString()).'.zip');

        if ($zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Could not create ZIP archive.');
        }

        $disk = Storage::disk('public');

        foreach ($submissions as $s) {
            if ($s->attachment_path && $disk->exists($s->attachment_path)) {
                $path = $disk->path($s->attachment_path);
                $localName = basename($s->attachment_path);
                $zip->addFile($path, $s->id . '/' . $localName);
            }
        }

        $zip->close();

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
