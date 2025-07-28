<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoinMahasiswa;
use Illuminate\Support\Facades\DB;

class PoinMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = DB::table('mahasiswas')->pluck('nim');
        
        foreach ($mahasiswas as $nim) {
            // false artinya jangan update poin otomatis, hanya update nama saja
            $this->updatePoinMahasiswa($nim, false);
        }

        $poinMahasiswas = PoinMahasiswa::all();
        return view('poin.index', compact('poinMahasiswas'));
    }

    // Tambah parameter $updatePoin untuk mengontrol update poin atau tidak
    private function updatePoinMahasiswa($nim, $updatePoin = true)
    {
        $nama = DB::table('mahasiswas')->where('nim', $nim)->value('nama');

        if (!$nama) {
            $nama = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->value('nama')
                ?? DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->value('nama');
        }

        if (!$nama) return false;

        if ($updatePoin) {
            $jumlahKegiatan = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->count();
            $jumlahOrganisasi = DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->count();

            $totalPoin = ($jumlahKegiatan * 100) + ($jumlahOrganisasi * 250);

            if ($totalPoin == 0) {
                PoinMahasiswa::where('nim', $nim)->delete();
                return false;
            }

            PoinMahasiswa::updateOrCreate(
                ['nim' => $nim],
                ['nama' => $nama, 'poin' => $totalPoin]
            );
        } else {
            // update hanya nama, biar poin yang di-edit manual tetap aman
            PoinMahasiswa::updateOrCreate(
                ['nim' => $nim],
                ['nama' => $nama]
            );
        }

        return true;
    }

    public function show($id)
    {
        $poin = PoinMahasiswa::findOrFail($id);
        return view('poin.show', compact('poin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
        ]);

        $nim = $request->nim;
        $nama = DB::table('mahasiswas')->where('nim', $nim)->value('nama');

        if (!$nama) {
            $nama = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->value('nama')
                ?? DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->value('nama');
        }

        if (!$nama) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $jumlahKegiatan = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->count();
        $jumlahOrganisasi = DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->count();
        $totalPoin = ($jumlahKegiatan * 100) + ($jumlahOrganisasi * 250);

        if ($totalPoin == 0) {
            return back()->with('error', 'Mahasiswa belum memiliki poin dari kegiatan atau organisasi.');
        }

        PoinMahasiswa::updateOrCreate(
            ['nim' => $nim],
            ['nama' => $nama, 'poin' => $totalPoin]
        );

        return redirect()->route('poin.index')->with('success', 'Poin mahasiswa berhasil disimpan.');
    }

    public function edit($id)
    {
        $poin = PoinMahasiswa::findOrFail($id);
        return view('poin.edit', compact('poin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'poin' => 'required|integer|min:0',
        ]);

        $poin = PoinMahasiswa::findOrFail($id);
        $poin->update([
            'nama' => $request->nama,
            'poin' => $request->poin,
        ]);

        return redirect()->route('poin.index')->with('success', 'Data poin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $poin = PoinMahasiswa::findOrFail($id);
        $poin->delete();

        return redirect()->route('poin.index')->with('success', 'Data berhasil dihapus.');
    }

    public function getAllLatestPoin()
    {
        $data = PoinMahasiswa::select('nim', 'poin')->get();
        return response()->json($data);
    }
}
