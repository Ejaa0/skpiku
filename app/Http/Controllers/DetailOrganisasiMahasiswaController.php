<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\Mahasiswa;
use App\Models\DetailOrganisasiMahasiswa;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DetailOrganisasiMahasiswaController extends Controller
{
    /**
     * Tampilkan form tambah anggota untuk organisasi tertentu.
     */
    public function create($id_organisasi)
    {
        $organisasi = Organisasi::where('id_organisasi', $id_organisasi)->firstOrFail();

        // Ambil semua NIM mahasiswa yang sudah jadi anggota organisasi ini
        $sudahAnggota = DetailOrganisasiMahasiswa::where('id_organisasi', $id_organisasi)
            ->pluck('nim')
            ->toArray();

        // Query mahasiswa + pencarian + exclude yang sudah anggota
        $mahasiswa = Mahasiswa::when(request()->input('cari'), function ($query, $cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('nim', 'like', '%' . $cari . '%')
                      ->orWhere('nama', 'like', '%' . $cari . '%');
                });
            })
            ->when(!empty($sudahAnggota), function ($query) use ($sudahAnggota) {
                $query->whereNotIn('nim', $sudahAnggota);
            })
            ->paginate(10);

        return view('detail_organisasi_mahasiswa.create', compact('organisasi', 'mahasiswa'));
    }

    /**
     * Simpan data anggota ke organisasi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
    'id_organisasi'       => 'required|exists:organisasis,id_organisasi',
    'nim'                 => 'required|exists:mahasiswas,nim',
    'jabatan'             => 'required|string|max:100',
    'jabatan_custom'      => 'nullable|string|max:100',
    'status_keanggotaan'  => 'required|in:aktif,nonaktif',
]);


        // Validasi tambahan: jika jabatan = "lainnya", wajib isi custom
        if (strtolower($validated['jabatan']) === 'lainnya' && empty($validated['jabatan_custom'])) {
            return back()->withErrors(['jabatan_custom' => 'Jabatan lainnya harus diisi.'])->withInput();
        }

        // Cegah duplikat anggota di organisasi yang sama
        $cek = DetailOrganisasiMahasiswa::where('id_organisasi', $validated['id_organisasi'])
            ->where('nim', $validated['nim'])
            ->exists();

        if ($cek) {
            return back()->withErrors(['nim' => 'Mahasiswa ini sudah menjadi anggota organisasi.'])->withInput();
        }

        $mahasiswa  = Mahasiswa::where('nim', $validated['nim'])->firstOrFail();
        $organisasi = Organisasi::where('id_organisasi', $validated['id_organisasi'])->firstOrFail();

        // Pilih jabatan: custom jika "lainnya"
        $jabatan = strtolower($validated['jabatan']) === 'lainnya'
            ? $validated['jabatan_custom']
            : $validated['jabatan'];

        DetailOrganisasiMahasiswa::create([
            'id_organisasi'      => $organisasi->id_organisasi,
            'nim'                => $mahasiswa->nim,
            'nama'               => $mahasiswa->nama,
            'nama_organisasi'    => $organisasi->nama_organisasi,
            'jabatan'            => $jabatan,
            'status_keanggotaan' => $validated['status_keanggotaan'],
        ]);

        return redirect()->route('organisasi.show', $organisasi->id_organisasi)
                         ->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Tampilkan halaman detail organisasi dan daftar anggotanya.
     */
    public function show($id)
    {
        $organisasi = Organisasi::findOrFail($id);

        // Ambil anggota organisasi beserta data mahasiswa
        $mahasiswa = DB::table('detail_organisasi_mahasiswa as dom')
            ->join('mahasiswas as m', 'm.nim', '=', 'dom.nim')
            ->where('dom.id_organisasi', $id)
            ->select(
                'm.nim',
                'm.nama',
                'dom.jabatan',
                'dom.status_keanggotaan'
            )
            ->get();

        return view('tampilan_organisasi.organisasi.show', compact('organisasi', 'mahasiswa'));
    }

    /**
     * Tampilkan form edit anggota organisasi.
     */
    public function edit($id)
    {
        $detail = DetailOrganisasiMahasiswa::findOrFail($id);
        $organisasi = Organisasi::where('id_organisasi', $detail->id_organisasi)->firstOrFail();

        return view('detail_organisasi_mahasiswa.edit', compact('detail', 'organisasi'));
    }

    /**
     * Perbarui data anggota organisasi.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nim'                => ['required', 'string', Rule::exists('mahasiswas', 'nim')],
            'jabatan'            => 'required|string|max:100',
            'jabatan_custom'     => 'nullable|string|max:100',
            'status_keanggotaan' => 'required|in:aktif,nonaktif',
        ]);

        // Validasi tambahan: jika jabatan = "lainnya", wajib isi custom
        if (strtolower($validated['jabatan']) === 'lainnya' && empty($validated['jabatan_custom'])) {
            return back()->withErrors(['jabatan_custom' => 'Jabatan lainnya harus diisi.'])->withInput();
        }

        $anggota   = DetailOrganisasiMahasiswa::findOrFail($id);
        $mahasiswa = Mahasiswa::where('nim', $validated['nim'])->firstOrFail();

        $jabatan = strtolower($validated['jabatan']) === 'lainnya'
            ? $validated['jabatan_custom']
            : $validated['jabatan'];

        $anggota->update([
            'nim'                => $mahasiswa->nim,
            'nama'               => $mahasiswa->nama,
            'jabatan'            => $jabatan,
            'status_keanggotaan' => $validated['status_keanggotaan'],
        ]);

        return redirect()->route('organisasi.show', $anggota->id_organisasi)
                         ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Hapus anggota dari organisasi.
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
