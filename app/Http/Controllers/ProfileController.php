<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Data dummy sementara
        $profile = [
            'nama' => 'Rhesa Ivander',
            'email' => 'rhesa@example.com',
            'jurusan' => 'Sistem Informasi',
            'angkatan' => '2022'
        ];

        return view('profile.index', compact('profile'));
    }
}
