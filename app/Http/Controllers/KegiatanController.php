<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Kegiatan::query();

        if ($search) {
            $query->where('jenis_kegiatan', 'like', "%{$search}%")
                  ->orWhere('nama_kegiatan', 'like', "%{$search}%");
        }

        $kegiatan = $query->orderBy('tanggal_kegiatan', 'desc')->paginate(10)->withQueryString();

        return view('kegiatan.index', compact('kegiatan', 'search'));
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_kegiatan' => 'required|string',
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
        ]);

        Kegiatan::create($validatedData);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $data = DB::table('detail_kegiatan_mahasiswa')
            ->join('mahasiswas', 'detail_kegiatan_mahasiswa.mahasiswa_nim', '=', 'mahasiswas.nim')
            ->where('detail_kegiatan_mahasiswa.kegiatan_id_ref', $kegiatan->id)
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->get();

        return view('kegiatan.show', compact('kegiatan', 'data'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $validatedData = $request->validate([
            'id_kegiatan' => 'required|string',
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
        ]);

        $kegiatan->update($validatedData);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    // Form tambah mahasiswa ke kegiatan
    public function tambahMahasiswaForm($id_kegiatan, Request $request)
    {
        $kegiatan = Kegiatan::where('id_kegiatan', $id_kegiatan)->firstOrFail();
        $keyword = $request->input('cari');

        $mahasiswa = Mahasiswa::when($keyword, function ($query) use ($keyword) {
            return $query->where('nim', 'like', "%$keyword%")
                         ->orWhere('nama', 'like', "%$keyword%");
        })->paginate(10);

        return view('kegiatan.tambah_mahasiswa', compact('kegiatan', 'mahasiswa'));
    }

    // Simpan mahasiswa ke kegiatan
    public function tambahMahasiswaStore(Request $request, $id_kegiatan)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswas,nim',
        ]);

        $kegiatan = Kegiatan::where('id_kegiatan', $id_kegiatan)->firstOrFail();

        $exists = DB::table('detail_kegiatan_mahasiswa')
            ->where('kegiatan_id_ref', $kegiatan->id)
            ->where('mahasiswa_nim', $request->nim)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Mahasiswa sudah terdaftar di kegiatan ini.');
        }

        DB::table('detail_kegiatan_mahasiswa')->insert([
            'kegiatan_id_ref' => $kegiatan->id,
            'mahasiswa_nim' => $request->nim,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('kegiatan.show', $kegiatan->id)
                         ->with('success', 'Mahasiswa berhasil ditambahkan ke kegiatan.');
    }

    // Hapus mahasiswa dari kegiatan
    public function hapusMahasiswa($id, $nim)
    {
        DB::table('detail_kegiatan_mahasiswa')
            ->where('kegiatan_id_ref', $id)
            ->where('mahasiswa_nim', $nim)
            ->delete();

        return redirect()->route('kegiatan.show', $id)->with('success', 'Mahasiswa berhasil dihapus dari kegiatan.');
    }
}
