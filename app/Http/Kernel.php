<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Untuk mengakses helper session

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
        // Periksa apakah session 'is_admin_logged_in' ada dan bernilai true
        if (!Session::get('is_admin_logged_in')) {
            // Jika tidak, redirect ke halaman login admin dengan pesan error
            return redirect()->route('admin.login')->with('error', 'Anda harus login sebagai admin untuk mengakses halaman ini.');
        }

        // Jika sudah login sebagai admin, lanjutkan ke request berikutnya
        return $next($request);
    }
}