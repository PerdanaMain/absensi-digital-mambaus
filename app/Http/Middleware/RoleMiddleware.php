<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        // dd($user->role->name, $roles, count($roles));
        if (count($roles) == 1) {
            if ($user->role->name != $roles[0]) {
                return redirect()->route('dashboard');
            }
        } else {
            if (!in_array($user->role->name, $roles)) {
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
