<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenentuanPoin; // pastikan modelnya ada

class WarekPenentuanPoinController extends Controller
{
    public function index()
    {
        // Ambil semua data penentuan poin
        $penentuanPoin = PenentuanPoin::orderBy('id', 'desc')->get();

        // Kirim ke view
        return view('warek.penentuan_poin.index', compact('penentuanPoin'));
    }
    public function create()
    {
        // Tampilan form tambah poin (bisa versi sederhana dulu)
        return view('warek.penentuan_poin.create');
    }
    public function store(Request $request)
{
    // validasi sederhana
    $request->validate([
        'nama_poin' => 'required|string|max:255',
        'nilai' => 'required|numeric',
    ]);

    // simpan ke database
    \App\Models\PenentuanPoin::create([
        'nama_poin' => $request->nama_poin,
        'nilai' => $request->nilai,
    ]);

    return redirect()->route('warek.penentuan-poin.index')->with('success', 'Poin berhasil ditambahkan.');
}
}
