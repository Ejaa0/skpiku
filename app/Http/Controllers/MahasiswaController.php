<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all(); // Ambil semua data mahasiswa
        return view('mahasiswas.index', compact('mahasiswas')); // Kirim data mahasiswa ke view
    }

    public function create()
    {
        return view('mahasiswas.create'); // Tampilkan form tambah mahasiswa
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim',
            'temp_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'sex' => 'required',
            'agama' => 'required',
            'hobi' => 'required',
            'angkatan' => 'required',
            'email' => 'required|email|unique:mahasiswas,email',
        ]);

        // Menyimpan data mahasiswa ke dalam database
        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id); // Ambil data mahasiswa berdasarkan id
        return view('mahasiswas.show', compact('mahasiswa')); // Tampilkan detail mahasiswa
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id); // Ambil data mahasiswa berdasarkan id
        return view('mahasiswas.edit', compact('mahasiswa')); // Tampilkan form edit mahasiswa
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'temp_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'sex' => 'required',
            'agama' => 'required',
            'hobi' => 'required',
            'angkatan' => 'required',
            'email' => 'required|email|unique:mahasiswas,email,' . $id,
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id); // Ambil data mahasiswa berdasarkan id
        $mahasiswa->update($request->all()); // Update data mahasiswa
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id); // Ambil data mahasiswa berdasarkan id
        $mahasiswa->delete(); // Hapus data mahasiswa
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
