<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WarekMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session 'warek_email' ada, jika tidak redirect ke login warek
        if (!session()->has('warek_email')) {
            return redirect('/login/warek');
        }

        return $next($request);
    }
}
