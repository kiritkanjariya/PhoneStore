<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('user')) {
            return redirect()
                ->route('login')
                ->with('error', '🔐 Hold up! Please log in to access this page.');
        }

        return $next($request);
    }
}
