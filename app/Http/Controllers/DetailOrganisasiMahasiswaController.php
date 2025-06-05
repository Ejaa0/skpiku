<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\Mahasiswa;
use App\Models\DetailOrganisasiMahasiswa;
use Illuminate\Validation\Rule;

class DetailOrganisasiMahasiswaController extends Controller
{
    /**
     * Tampilkan form tambah anggota untuk organisasi tertentu.
     *
     * @param string $id_organisasi
     * @return \Illuminate\View\View
     */
    public function create($id_organisasi)
    {
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();

        $mahasiswa = Mahasiswa::when(request()->input('cari'), function ($query, $cari) {
            $query->where('nim', 'like', '%' . $cari . '%')
                  ->orWhere('nama', 'like', '%' . $cari . '%');
        })->paginate(10);

        return view('detail_organisasi_mahasiswa.create', compact('organisasi', 'mahasiswa'));
    }

    /**
     * Simpan data anggota ke organisasi.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    $request->validate([
        'id_organisasi' => 'required|exists:organisasi,id_organisasi',
        'nim' => 'required|exists:mahasiswas,nim',
        'jabatan' => 'required|string|max:255',
        'status_keanggotaan' => 'required|in:aktif,nonaktif',
    ]);

    $mahasiswa = Mahasiswa::where('nim', $request->nim)->firstOrFail();
    $organisasi = Organisasi::where('id_organisasi', $request->id_organisasi)->firstOrFail();

    DetailOrganisasiMahasiswa::create([
        'id_organisasi' => $request->id_organisasi,
        'nim' => $mahasiswa->nim,
        'nama' => $mahasiswa->nama,
        'nama_organisasi' => $organisasi->nama_organisasi,  // tambahkan ini
        'jabatan' => $request->jabatan,
        'status_keanggotaan' => $request->status_keanggotaan,
    ]);

    return redirect()->route('organisasi.show', $request->id_organisasi)
                     ->with('success', 'Anggota berhasil ditambahkan.');
}


    /**
     * Tampilkan halaman detail organisasi dan daftar anggotanya.
     *
     * @param string $id_organisasi
     * @return \Illuminate\View\View
     */
    public function show($id_organisasi)
    {
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();
        $detailMahasiswa = DetailOrganisasiMahasiswa::where('id_organisasi', $id_organisasi)->get();

        return view('organisasi.show', compact('organisasi', 'detailMahasiswa'));
    }

    /**
     * Tampilkan form edit anggota organisasi.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $detail = DetailOrganisasiMahasiswa::findOrFail($id);
        $organisasi = Organisasi::where('id_organisasi', $detail->id_organisasi)->firstOrFail();

        return view('detail_organisasi_mahasiswa.edit', compact('detail', 'organisasi'));
    }

    /**
     * Perbarui data anggota organisasi.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', Rule::exists('mahasiswas', 'nim')], // sudah benar
            'jabatan' => 'required|string|max:100',
            'status_keanggotaan' => 'required|in:aktif,nonaktif',
        ]);

        $anggota = DetailOrganisasiMahasiswa::findOrFail($id);
        $mahasiswa = Mahasiswa::where('nim', $validated['nim'])->firstOrFail();

        $anggota->update([
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'jabatan' => $validated['jabatan'],
            'status_keanggotaan' => $validated['status_keanggotaan'],
        ]);

        return redirect()->route('organisasi.show', $anggota->id_organisasi)
                         ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Hapus anggota dari organisasi.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $anggota = DetailOrganisasiMahasiswa::findOrFail($id);
        $id_organisasi = $anggota->id_organisasi;

        $anggota->delete();

        return redirect()->route('organisasi.show', $id_organisasi)
                         ->with('success', 'Data anggota berhasil dihapus.');
    }
}
