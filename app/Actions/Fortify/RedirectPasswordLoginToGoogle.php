<?php

namespace App\Actions\Fortify;

use Closure;
use Illuminate\Http\Request;

class RedirectPasswordLoginToGoogle
{
    /**
     * Keep public account access on the Google identity flow only.
     */
    public function handle(Request $request, Closure $next)
    {
        return redirect()->route('auth.google.redirect');
    }
}
