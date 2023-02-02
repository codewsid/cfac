<?php

namespace Laravel\Fortify\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $role = auth()->user()->role;

        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        } else {
            switch ($role) {
                case 1:
                    return redirect()->intended(Fortify::redirects('admin.dashboard'));
                    break;
                case 2:
                    return redirect()->intended(Fortify::redirects('office.dashboard'));
                    break;
                case 3:
                    return redirect()->intended(Fortify::redirects('client.dashboard'));
                    break;
                default:
                    abort(403);
                    break;
            }
        }
    }
}
