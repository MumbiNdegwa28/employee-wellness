<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (!$this->userHasRole(Auth::user(), $role)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }

    private function userHasRole($user, $role)
    {
        return $user->roles()->where('name', $role)->exists();
    }
}

