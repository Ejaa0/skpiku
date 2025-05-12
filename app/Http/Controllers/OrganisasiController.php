<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    // Menampilkan daftar organisasi
    public function index()
    {
        // Mengambil semua data organisasi dari database
        $organisasi = Organisasi::all(); // atau bisa menggunakan pagination seperti Organisasi::paginate(10);

        // Mengirimkan data ke view
        return view('organisasi.index', compact('organisasi'));
    }

    // Menampilkan form untuk membuat organisasi baru
    public function create()
    {
        // Hanya menampilkan form tambah organisasi, tidak perlu mengirimkan data
        return view('organisasi.create');
    }

    // Menyimpan organisasi baru ke dalam database
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'id_organisasi' => 'required',
            'nama_organisasi' => 'required',
            'absensi' => 'required'
        ]);

        // Menyimpan data ke database
        Organisasi::create($validatedData);

        // Redirect ke halaman daftar organisasi dengan pesan sukses
        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit organisasi
    public function edit($id)
    {
        // Mencari organisasi berdasarkan ID
        $organisasi = Organisasi::findOrFail($id);

        return view('organisasi.edit', compact('organisasi'));
    }

    // Memperbarui data organisasi di database
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'id_organisasi' => 'required',
            'nama_organisasi' => 'required',
            'absensi' => 'required'
        ]);

        // Mencari organisasi berdasarkan ID dan memperbarui data
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->update($validatedData);

        // Redirect ke halaman daftar organisasi dengan pesan sukses
        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil diperbarui.');
    }

    // Menghapus organisasi
    public function destroy($id)
    {
        // Mencari organisasi berdasarkan ID dan menghapusnya
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->delete();

        // Redirect ke halaman daftar organisasi dengan pesan sukses
        return redirect()->route('organisasi.index')->with('success', 'Organisasi berhasil dihapus.');
    }

    // Menampilkan detail organisasi (opsional, jika dibutuhkan)
    public function show($id)
    {
        // Mencari organisasi berdasarkan ID
        $organisasi = Organisasi::findOrFail($id);

        // Menampilkan detail organisasi
        return view('organisasi.show', compact('organisasi'));
    }
}
