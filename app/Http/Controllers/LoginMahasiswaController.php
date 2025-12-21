<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginMahasiswaController extends Controller
{
    public function showLoginForm()
    {
        return view('login_mahasiswa');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Batasi hanya email UNAI (opsional tapi disarankan)
        if (!str_ends_with($request->email, '@unai.edu')) {
            return back()->with('error', 'Gunakan email UNAI');
        }

        // Cari mahasiswa berdasarkan email
        $mahasiswa = DB::table('mahasiswas')
            ->where('email', $request->email)
            ->first();

        if (!$mahasiswa || $request->password !== $mahasiswa->password) {
            return back()->with('error', 'Email atau Password salah');
        }

        // ✅ Ambil 7 angka pertama dari email sebagai NIM
        $nim = substr($mahasiswa->email, 0, 7);

        // Validasi harus benar-benar 7 digit angka
        if (!preg_match('/^\d{7}$/', $nim)) {
            return back()->with('error', 'Format email tidak valid');
        }

        // Simpan ke session
        Session::put('login_mahasiswa', true);
        Session::put('user_nim', $nim);

        return redirect('/mahasiswa/dashboard');
    }

    public function logout()
    {
        Session::forget(['login_mahasiswa', 'user_nim']);
        return redirect('/login/mahasiswa');
    }
}
