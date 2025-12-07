<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class WarekTambahAnggotaKegiatanController extends Controller
{
    // ============================
    // SHOW DETAIL KEGIATAN
    // ============================
    public function show($id_kegiatan)
    {
        $kegiatan = Kegiatan::with('mahasiswa')->findOrFail($id_kegiatan);
        return view('warek.datakegiatan.show', compact('kegiatan'));
    }

    // ============================
    // FORM TAMBAH MAHASISWA KE KEGIATAN
    // ============================
    public function create($id_kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
        $mahasiswa = Mahasiswa::all();
        return view('warek.datakegiatan.tambah_mahasiswa', compact('kegiatan', 'mahasiswa'));
    }

    // ============================
    // STORE MAHASISWA KE KEGIATAN
    // ============================
    public function store(Request $request, $id_kegiatan)
    {
        // Validasi nim harus ada di tabel mahasiswas
        $request->validate([
            'nim' => 'required|exists:mahasiswas,nim',
        ]);

        $kegiatan = Kegiatan::findOrFail($id_kegiatan);

        // Gunakan transaction untuk keamanan
        DB::transaction(function () use ($kegiatan, $request) {
            // Cek apakah mahasiswa sudah ada di kegiatan
            if (!$kegiatan->mahasiswa()->where('mahasiswa_nim', $request->nim)->exists()) {
                $kegiatan->mahasiswa()->attach($request->nim);
            }
        });

        return redirect()
            ->route('warek.tambahanggota.kegiatan.show', $id_kegiatan)
            ->with('success', 'Mahasiswa berhasil ditambahkan ke kegiatan.');
    }

    // ============================
    // REMOVE MAHASISWA DARI KEGIATAN
    // ============================
    public function destroy($id_kegiatan, $nim)
    {
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);

        DB::transaction(function () use ($kegiatan, $nim) {
            $kegiatan->mahasiswa()->detach($nim);
        });

        return redirect()
            ->route('warek.tambahanggota.kegiatan.show', $id_kegiatan)
            ->with('success', 'Mahasiswa berhasil dihapus dari kegiatan.');
    }
}
