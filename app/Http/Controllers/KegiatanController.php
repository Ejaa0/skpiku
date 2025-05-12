<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    // Tampilkan semua kegiatan
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();
        return view('kegiatan.index', compact('kegiatan'));
    }

    // Tampilkan form tambah kegiatan
    public function create()
    {
        return view('kegiatan.create');
    }

    // Simpan data kegiatan baru
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string',
            'id_kegiatan' => 'required|string',
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'absensi' => 'required|string',
        ]);

        Kegiatan::create($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    // Tampilkan detail satu kegiatan
    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('kegiatan.show', compact('kegiatan'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('kegiatan.edit', compact('kegiatan'));
    }

    // Simpan perubahan edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string',
            'id_kegiatan' => 'required|string',
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'absensi' => 'required|string',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    // Hapus kegiatan
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
