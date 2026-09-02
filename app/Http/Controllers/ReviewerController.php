<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function dashboard()
    {
        if (! auth()->check() || ! auth()->user()->is_reviewer) {
            abort(403, 'Reviewer access required.');
        }

        $submissions = Submission::with('user')->latest('submitted_at')->get();

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

        $comments = $submission->comments ?? [];
        $comments[] = [
            'author' => auth()->user()->name,
            'message' => $validated['comment'],
            'at' => now()->toDateTimeString(),
        ];

        $submission->comments = $comments;
        if (! empty($validated['status'])) {
            $submission->status = $validated['status'];
        }
        $submission->save();

        return back()->with('status', 'Review comment saved successfully.');
    }
}
