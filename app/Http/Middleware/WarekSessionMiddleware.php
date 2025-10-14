<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WarekSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('warek_email')) {
            return redirect('/login/warek'); // redirect ke login kalau session tidak ada
        }
        return $next($request);
    }
}
