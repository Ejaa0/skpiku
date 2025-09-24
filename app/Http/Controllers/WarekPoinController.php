<?php

namespace App\Http\Controllers;

use App\Models\PoinMahasiswa;

class WarekPoinController extends Controller
{
    public function index()
    {
        $poinMahasiswa = PoinMahasiswa::with('kegiatans', 'organisasis')
                            ->orderBy('poin', 'desc')
                            ->get();

        return view('warek.poin.index', compact('poinMahasiswa'));
    }
}
