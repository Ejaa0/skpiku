<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoinMahasiswa;
use Illuminate\Support\Facades\DB;

class PoinMahasiswaController extends Controller
{
    public function index()
{
    // Update poin semua mahasiswa dulu sebelum ambil data untuk tampil
    $mahasiswas = DB::table('mahasiswas')->pluck('nim');
    
    foreach ($mahasiswas as $nim) {
        $this->updatePoinMahasiswa($nim);
    }
    
    // Ambil semua data poin mahasiswa yang sudah update
    $poinMahasiswas = PoinMahasiswa::all();
    return view('poin.index', compact('poinMahasiswas'));
}

// Tambahkan fungsi update poin mahasiswa di controller yang sama
private function updatePoinMahasiswa($nim)
{
    $nama = DB::table('mahasiswas')->where('nim', $nim)->value('nama');

    if (!$nama) {
        $nama = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->value('nama')
            ?? DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->value('nama');
    }

    if (!$nama) return false;

    $jumlahKegiatan = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->count();
    $jumlahOrganisasi = DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->count();

    $totalPoin = ($jumlahKegiatan * 100) + ($jumlahOrganisasi * 250);

    PoinMahasiswa::updateOrCreate(
        ['nim' => $nim],
        ['nama' => $nama, 'poin' => $totalPoin]
    );

    return true;
}

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
        ], [
            'nim.required' => 'Pilih mahasiswa terlebih dahulu.',
            'nim.string' => 'Format NIM tidak valid.',
            'nim.max' => 'NIM maksimal 20 karakter.',
        ]);

        $nim = $request->nim;

        // Cari nama mahasiswa di tabel mahasiswas
        $nama = DB::table('mahasiswas')->where('nim', $nim)->value('nama');

        // Jika tidak ditemukan, cari di tabel detail kegiatan atau organisasi
        if (!$nama) {
            $nama = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->value('nama')
                ?? DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->value('nama');
        }

        if (!$nama) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Hitung jumlah keikutsertaan kegiatan dan organisasi
        $jumlahKegiatan = DB::table('detail_kegiatan_mahasiswa')->where('mahasiswa_nim', $nim)->count();
        $jumlahOrganisasi = DB::table('detail_organisasi_mahasiswa')->where('nim', $nim)->count();

        // Hitung total poin: misal kegiatan 100 poin, organisasi 250 poin
        $totalPoin = ($jumlahKegiatan * 100) + ($jumlahOrganisasi * 250);

        // Simpan atau update data poin mahasiswa
        PoinMahasiswa::updateOrCreate(
            ['nim' => $nim],
            ['nama' => $nama, 'poin' => $totalPoin]
        );

        return redirect()->route('poin.index')->with('success', 'Poin mahasiswa berhasil disimpan.');
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
