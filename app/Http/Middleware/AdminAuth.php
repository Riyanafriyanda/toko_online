<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->is_admin !== 1) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
