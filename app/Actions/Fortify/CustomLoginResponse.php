<?php

namespace App\Actions\Fortify;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return new JsonResponse('', 204);
        }

        $user = $request->user();

        if ($user && $user->is_reviewer) {
            return redirect()->route('reviewer.dashboard');
        }

        return redirect()->intended('/dashboard');
    }
}
