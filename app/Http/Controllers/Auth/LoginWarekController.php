<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginWarekController extends Controller
{
    // Tampilkan halaman login WR III
    public function showLoginForm()
    {
        return view('auth.login_warek');
    }

    // Proses login WR III
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Contoh verifikasi manual, ganti dengan pengecekan database sebenarnya
        if ($email === 'warek@example.com' && $password === 'password123') {
            // Simpan email di session
            session(['warek_email' => $email]);
            return redirect()->route('warek.dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // Logout WR III
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login/warek');
    }
}
