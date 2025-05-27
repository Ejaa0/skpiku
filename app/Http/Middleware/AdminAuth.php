<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Untuk mengakses sesi

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('is_admin_logged_in')) {
            // Jika admin belum login, redirect ke halaman login admin
            return redirect()->route('admin.login')->with('error', 'Anda harus login sebagai admin untuk mengakses halaman ini.');
        }
        return $next($request);
    }
}