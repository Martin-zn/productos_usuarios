<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::check()) { // Aquí se utiliza Auth::check()
                return redirect('/home');
            }
        }

        return $next($request);
    }
}