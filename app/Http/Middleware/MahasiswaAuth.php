<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MahasiswaAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session mahasiswa_nim ada
        if (!session()->has('mahasiswa_nim')) {
            return redirect('/login/mahasiswa')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
