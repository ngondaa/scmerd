<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class RegistrationInvoiceController extends Controller
{
    public function show(User $user): View
    {
        abort_unless(
            filled($user->payment_invoice_number)
            && (auth()->user()?->is_admin || auth()->user()?->is_payment_reviewer),
            403,
        );

        return view('invoices.registration', [
            'user' => $user,
            'package' => config('registration.packages.'.$user->registration_package, []),
        ]);
    }
}
