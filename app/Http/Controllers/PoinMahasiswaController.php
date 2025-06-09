<?php

namespace App\Http\Controllers;

use App\Models\PoinMahasiswa;
use App\Models\Mahasiswa;
use App\Models\Kegiatan;
use App\Models\Organisasi;
use Illuminate\Http\Request;

class PoinMahasiswaController extends Controller
{
    public function index()
    {
        $data = PoinMahasiswa::orderBy('created_at', 'desc')->get();
        return view('poin.index', compact('data'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $kegiatans = Kegiatan::all();
        $organisasis = Organisasi::all();

        return view('poin.create', compact('mahasiswas', 'kegiatans', 'organisasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswas,nim',
            'nama' => 'required|string',
            'tipe' => 'required|in:kegiatan,organisasi',
            'nama_kegiatan' => 'required_if:tipe,kegiatan',
            'jenis_kegiatan' => 'required_if:tipe,kegiatan',
            'tanggal_kegiatan' => 'required_if:tipe,kegiatan|date',
            'jabatan' => 'required_if:tipe,organisasi',
            'status_keanggotaan' => 'required_if:tipe,organisasi',
            'deskripsi' => 'nullable|string',
            'poin' => 'required|integer|min:0',
        ]);

        PoinMahasiswa::create($request->only([
            'nim', 'nama', 'tipe',
            'nama_kegiatan', 'jenis_kegiatan', 'tanggal_kegiatan',
            'jabatan', 'status_keanggotaan', 'deskripsi', 'poin',
        ]));

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
        $mahasiswas = Mahasiswa::all();
        $kegiatans = Kegiatan::all();
        $organisasis = Organisasi::all();

        return view('poin.edit', compact('data', 'mahasiswas', 'kegiatans', 'organisasis'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswas,nim',
            'nama' => 'required|string',
            'tipe' => 'required|in:kegiatan,organisasi',
            'nama_kegiatan' => 'required_if:tipe,kegiatan',
            'jenis_kegiatan' => 'required_if:tipe,kegiatan',
            'tanggal_kegiatan' => 'required_if:tipe,kegiatan|date',
            'jabatan' => 'required_if:tipe,organisasi',
            'status_keanggotaan' => 'required_if:tipe,organisasi',
            'deskripsi' => 'nullable|string',
            'poin' => 'required|integer|min:0',
        ]);

        $data = PoinMahasiswa::findOrFail($id);
        $data->update($request->only([
            'nim', 'nama', 'tipe',
            'nama_kegiatan', 'jenis_kegiatan', 'tanggal_kegiatan',
            'jabatan', 'status_keanggotaan', 'deskripsi', 'poin',
        ]));

        return redirect()->route('poin.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $data = PoinMahasiswa::findOrFail($id);
        $data->delete();

        return redirect()->route('poin.index')->with('success', 'Data berhasil dihapus.');
    }
}
