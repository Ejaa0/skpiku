<?php

namespace App\Http\Controllers;

use App\Models\PoinMahasiswa;
use Illuminate\Http\Request;

class PoinController extends Controller
{
    /**
     * Menampilkan daftar poin mahasiswa
     */
    public function index()
    {
        // Ambil semua data poin mahasiswa
        $poinMahasiswa = PoinMahasiswa::all();
        
        // Kirim data ke view
        return view('poin.index', compact('poinMahasiswa'));
    }

    /**
     * Menampilkan form untuk menambah poin mahasiswa
     */
    public function create()
    {
        return view('poin.create');
    }

    /**
     * Menyimpan data poin mahasiswa baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nim' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'beri_poin' => 'required|integer',
            'jumlah_poin' => 'required|integer',
        ]);

        // Simpan data poin mahasiswa menggunakan model PoinMahasiswa
        PoinMahasiswa::create($validated);

        // Redirect ke halaman daftar poin dengan pesan sukses
        return redirect()->route('poin.index')->with('success', 'Poin mahasiswa berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit poin mahasiswa
     */
    public function edit(PoinMahasiswa $poinMahasiswa)
    {
        return view('poin.edit', compact('poinMahasiswa'));
    }

    /**
     * Mengupdate data poin mahasiswa
     */
    public function update(Request $request, PoinMahasiswa $poinMahasiswa)
    {
        // Validasi input
        $validated = $request->validate([
            'nim' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'beri_poin' => 'required|integer',
            'jumlah_poin' => 'required|integer',
        ]);

        // Update data poin mahasiswa
        $poinMahasiswa->update($validated);

        // Redirect ke halaman daftar poin dengan pesan sukses
        return redirect()->route('poin.index')->with('success', 'Poin mahasiswa berhasil diperbarui!');
    }

    /**
     * Menghapus data poin mahasiswa
     */
    public function destroy(PoinMahasiswa $poinMahasiswa)
    {
        // Hapus data poin mahasiswa
        $poinMahasiswa->delete();

        // Redirect ke halaman daftar poin dengan pesan sukses
        return redirect()->route('poin.index')->with('success', 'Poin mahasiswa berhasil dihapus!');
    }

    /**
     * Menampilkan detail poin mahasiswa
     */
    public function show(PoinMahasiswa $poinMahasiswa)
    {
        return view('poin.show', compact('poinMahasiswa'));
    }
}
