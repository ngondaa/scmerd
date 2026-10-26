<?php

namespace App\Http\Controllers;

use App\Mail\AttendanceConfirmation;
use App\Models\AppSetting;
use App\Models\Submission;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function settings()
    {
        if (! auth()->check() || ! auth()->user()->is_admin) {
            abort(403);
        }

        $registrationOpen = (bool) AppSetting::get('registration_open', '1');
        $pending = User::query()->needsPaymentReview()->latest('updated_at')->get();

        return view('admin.settings', compact('registrationOpen', 'pending'));
    }

    public function toggleRegistration(Request $request)
    {
        if (! auth()->check() || ! auth()->user()->is_admin) {
            abort(403);
        }

        $state = $request->boolean('registration_open');
        AppSetting::set('registration_open', $state ? '1' : '0');

        return redirect()->back()->with('status', 'Registration settings updated.');
    }

    public function verifyPayment(Request $request, User $user)
    {
        if (! auth()->check() || ! auth()->user()->is_admin) {
            abort(403);
        }

        $action = $request->input('action');

        if ($action === 'approve') {
            $user->approvePayment();

            return redirect()->back()->with('status', 'Payment approved.');
        }

        if ($action === 'reject') {
            $user->rejectPayment();

            return redirect()->back()->with('status', 'Payment rejected.');
        }

        return redirect()->back()->with('error', 'Unknown action');
    }

    public function exportAcceptedAbstracts(): Response
    {
        $submissions = Submission::query()
            ->where('status', 'Accepted')
            ->orderBy('track')
            ->orderBy('author')
            ->get(['title', 'author', 'track']);

        return Pdf::loadView('exports.accepted-abstracts-pdf', [
            'submissions' => $submissions,
            'generatedAt' => now(),
        ])
            ->setPaper('a4', 'portrait')
            ->download('accepted-abstracts-'.now()->format('Y-m-d').'.pdf');
    }

    public function attendanceCampaignPreview(): Response
    {
        return response()->view('admin.attendance-campaign-preview', [
            'recipientCount' => User::query()->whereNotNull('email')->count(),
        ]);
    }

    public function sendAttendanceCampaign(): RedirectResponse
    {
        $recipientCount = 0;

        User::query()
            ->whereNotNull('email')
            ->orderBy('id')
            ->cursor()
            ->each(function (User $user) use (&$recipientCount): void {
                Mail::to($user->email)->queue(new AttendanceConfirmation($user));
                $recipientCount++;
            });

        return redirect()
            ->route('admin.attendance-campaign.preview')
            ->with('status', "Attendance confirmation campaign queued for {$recipientCount} recipients.");
    }
}
