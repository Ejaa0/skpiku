<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenentuanPoin;


class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mahasiswas = Mahasiswa::when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                             ->orWhere('nim', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'temp_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'sex' => 'required|in:L,P',
            'agama' => 'required',
            'hobi' => 'required',
            'angkatan' => 'required|numeric',
            'email' => 'required|email',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->nim . ',nim',
            'nama' => 'required',
            'temp_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'sex' => 'required|in:L,P',
            'agama' => 'required',
            'hobi' => 'required',
            'angkatan' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        DB::transaction(function () use ($mahasiswa) {
            // Hapus semua poin terkait
            $mahasiswa->poin()->delete();

            // Hapus semua detail kegiatan terkait
            $mahasiswa->detailKegiatan()->delete();

            // Hapus semua detail organisasi terkait
            $mahasiswa->detailOrganisasi()->delete();

            // Hapus mahasiswa
            $mahasiswa->delete();
        });

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa dan poin, kegiatan, organisasi terkait berhasil dihapus.');
    }

   public function kriteriaPoin()
{
    // Ambil semua data penentuan poin, paginasi 10
    $poin = PenentuanPoin::paginate(10);

    return view('tampilan_mahasiswa.kriteria_poin', compact('poin'));
}

}
