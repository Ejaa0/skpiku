<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // Menampilkan semua data mahasiswa (halaman data mahasiswa)
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    // Menampilkan form tambah mahasiswa
    public function create()
    {
        return view('mahasiswa.create');
    }

    // Menyimpan data mahasiswa baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'temp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'sex' => 'required|string|in:L,P',
            'agama' => 'required|string|max:50',
            'hobi' => 'nullable|string|max:255',
            'angkatan' => 'required|integer|min:1900|max:' . date('Y'),
            'email' => 'required|email|unique:mahasiswas,email',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    // Menampilkan detail satu mahasiswa
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    // Menampilkan form edit mahasiswa
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Update data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'temp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'sex' => 'required|string|in:L,P',
            'agama' => 'required|string|max:50',
            'hobi' => 'nullable|string|max:255',
            'angkatan' => 'required|integer|min:1900|max:' . date('Y'),
            'email' => 'required|email|unique:mahasiswas,email,' . $id,
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    // Hapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    // Method untuk halaman dashboard mahasiswa (bisa disesuaikan)
    public function dashboard()
    {
        if (!session('is_mahasiswa_logged_in')) {
            return redirect()->route('mahasiswa.login');
        }

        $mahasiswas = Mahasiswa::all();

        return view('mahasiswa.dashboard', compact('mahasiswas'));
    }

    // Halaman data mahasiswa dengan fitur search
    public function dataMahasiswa(Request $request)
    {
        $search = $request->input('search');

        $query = Mahasiswa::query();

        if ($search) {
            $query->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
        }

        $mahasiswas = $query->get();

        return view('mahasiswa.data_mahasiswa', compact('mahasiswas', 'search'));
    }
}
