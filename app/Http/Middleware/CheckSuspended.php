<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckSuspended
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isSuspended()) {
            Auth::guard('web')->logout();
            return redirect()->route('login')->withErrors(['Your account has been suspended. Please contact support.']);
        }

        return $next($request);
    }
}
