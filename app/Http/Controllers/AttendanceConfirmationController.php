<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AttendanceConfirmationController extends Controller
{
    public function store(Request $request, User $user, string $response): RedirectResponse
    {
        abort_unless($request->hasValidSignature(), 403);

        $updates = match ($response) {
            'attending' => ['attendance_confirmed_at' => now()],
            'gala-dinner' => [
                'attendance_confirmed_at' => now(),
                'gala_dinner_confirmed_at' => now(),
            ],
            default => abort(404),
        };

        $user->update($updates);

        return redirect()->route('home')->with('status', match ($response) {
            'attending' => 'Your conference attendance has been confirmed.',
            'gala-dinner' => 'Your conference and gala dinner attendance have been confirmed.',
        });
    }
}
