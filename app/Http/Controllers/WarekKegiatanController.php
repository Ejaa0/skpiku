<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class WarekKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::all(); // Ambil semua data kegiatan
        return view('warek.datakegiatan.index', compact('kegiatan'));
    }
}
