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

public function edit($id)
{
    $kegiatan = Kegiatan::findOrFail($id);
    return view('warek.datakegiatan.edit', compact('kegiatan'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'jenis_kegiatan' => 'required|string|max:255',
        'nama_kegiatan'  => 'required|string|max:255',
        'tanggal_kegiatan' => 'required|date',
    ]);

    $kegiatan = Kegiatan::findOrFail($id);

    $kegiatan->update([
        'jenis_kegiatan' => $request->jenis_kegiatan,
        'nama_kegiatan'  => $request->nama_kegiatan,
        'tanggal_kegiatan' => $request->tanggal_kegiatan,
    ]);

    return redirect()
        ->route('warek.datakegiatan.index')
        ->with('success', 'Kegiatan berhasil diperbarui.');
}


    
    public function show($id)
{
    $kegiatan = Kegiatan::findOrFail($id); // ambil data berdasarkan ID
    return view('warek.datakegiatan.show', compact('kegiatan'));
}

}
