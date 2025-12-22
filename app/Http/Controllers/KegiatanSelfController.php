<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use App\Models\DetailKegiatanMahasiswa;

class KegiatanSelfController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->filled('search')) {
            $query->where('nama_kegiatan', 'like', '%' . $request->search . '%');
        }

        $kegiatans = $query->orderBy('tanggal_kegiatan', 'desc')
                           ->paginate(10)
                           ->withQueryString();

        return view('tampilan_kegiatan.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('tampilan_kegiatan.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kegiatan'     => 'required|unique:kegiatans,id_kegiatan|integer',
            'nama_kegiatan'   => 'required|string|max:255',
            'tanggal_kegiatan'=> 'required|date',
            'jenis_kegiatan'  => 'nullable|string|max:255',
        ]);

        Kegiatan::create($request->only(
            'id_kegiatan',
            'nama_kegiatan',
            'tanggal_kegiatan',
            'jenis_kegiatan'
        ));

        return redirect()
            ->route('kegiatan-self.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with('detailMahasiswa.mahasiswa')
                            ->findOrFail($id);

        return view('tampilan_kegiatan.kegiatan.show', compact('kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('tampilan_kegiatan.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'nama_kegiatan'    => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'jenis_kegiatan'   => 'nullable|string|max:255',
        ]);

        $kegiatan->update($request->only(
            'nama_kegiatan',
            'tanggal_kegiatan',
            'jenis_kegiatan'
        ));

        return redirect()
            ->route('kegiatan-self.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()
            ->route('kegiatan-self.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    /* =====================================================
       TAMBAH MAHASISWA KE KEGIATAN
       ===================================================== */

    public function addMahasiswa($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // NIM mahasiswa yang SUDAH ikut kegiatan
        $nimSudahIkut = DetailKegiatanMahasiswa::where('kegiatan_id_ref', $id)
            ->pluck('mahasiswa_nim');

        // Mahasiswa yang BELUM ikut kegiatan
        $mahasiswas = Mahasiswa::whereNotIn('nim', $nimSudahIkut)->get();

        return view(
            'tampilan_kegiatan.kegiatan.add_mahasiswa',
            compact('kegiatan', 'mahasiswas')
        );
    }

    public function storeMahasiswa(Request $request, $id)
    {
        $request->validate([
            'mahasiswa_nim' => 'required|exists:mahasiswas,nim',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        // Cegah duplikasi
        $exists = DetailKegiatanMahasiswa::where('kegiatan_id_ref', $id)
            ->where('mahasiswa_nim', $request->mahasiswa_nim)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mahasiswa sudah terdaftar di kegiatan ini.');
        }

        DetailKegiatanMahasiswa::create([
            'kegiatan_id_ref' => $id,
            'mahasiswa_nim'   => $request->mahasiswa_nim,
        ]);

        return redirect()
            ->route('kegiatan-self.show', $id)
            ->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function destroyMahasiswa($kegiatanId, $nim)
    {
        DetailKegiatanMahasiswa::where('kegiatan_id_ref', $kegiatanId)
            ->where('mahasiswa_nim', $nim)
            ->delete();

        return redirect()
            ->route('kegiatan-self.show', $kegiatanId)
            ->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
