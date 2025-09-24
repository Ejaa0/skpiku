<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WarekAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('warek_email')) {
            return redirect('/login/warek')->with('error', 'Silakan login sebagai Warek.');
        }

        return $next($request);
    }
}
