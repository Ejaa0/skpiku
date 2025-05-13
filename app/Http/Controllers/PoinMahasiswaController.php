<?php

namespace App\Http\Controllers;

use App\Models\PoinMahasiswa;
use Illuminate\Http\Request;

class PoinMahasiswaController extends Controller
{
    public function index()
    {
        // Mengambil semua data poin mahasiswa
        $poin = PoinMahasiswa::all();

        // Mengirim data ke view
        return view('poin.index', compact('poin'));
    }

    public function create()
    {
        return view('poin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi' => 'required',
            'poin' => 'required|integer',
        ]);

        // Menyimpan data poin mahasiswa ke database
        PoinMahasiswa::create($request->all());

        return redirect()->route('poin.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $data = PoinMahasiswa::findOrFail($id);
        return view('poin.show', compact('data'));
    }

    public function edit(string $id)
    {
        $data = PoinMahasiswa::findOrFail($id);
        return view('poin.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi' => 'required',
            'poin' => 'required|integer',
        ]);

        $data = PoinMahasiswa::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('poin.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $data = PoinMahasiswa::findOrFail($id);
        $data->delete();

        return redirect()->route('poin.index')->with('success', 'Data berhasil dihapus.');
    }
}
