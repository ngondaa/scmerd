<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
