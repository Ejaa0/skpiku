<?php

// app/Http/Controllers/LoginMahasiswaController.php
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
            'nim' => 'required',
            'password' => 'required',
        ]);

        $mahasiswa = DB::table('mahasiswas')->where('nim', $request->nim)->first();

        if ($mahasiswa && $request->password === $mahasiswa->password) {
            Session::put('mahasiswa', $mahasiswa);
            return redirect('/mahasiswa/dashboard');
        }

        return back()->with('error', 'NIM atau Password salah');
    }

    public function logout()
    {
        Session::forget('mahasiswa');
        return redirect('/login/mahasiswa');
    }
}
