<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{

    protected $auth;


    public function handle(Request $request, Closure $next): Response
    {
        // check guard admin
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        abort(403, 'Unauthorized action.');
    }
}
