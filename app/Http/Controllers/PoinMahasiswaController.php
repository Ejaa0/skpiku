<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoinMahasiswa;
use Illuminate\Support\Facades\DB;

class PoinMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        // Update poin semua mahasiswa dulu sebelum ambil data untuk tampil
        $mahasiswas = DB::table('mahasiswas')->pluck('nim');

        foreach ($mahasiswas as $nim) {
            $this->updatePoinMahasiswa($nim);
        }

        $search = $request->input('search');

        // Ambil semua data poin mahasiswa dan filter jika ada pencarian
        $poinMahasiswas = PoinMahasiswa::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%$search%")
                         ->orWhere('nim', 'like', "%$search%");
        })
        ->orderByDesc('poin') // urutkan dari poin tertinggi
        ->get();

        return view('poin.index', compact('poinMahasiswas', 'search'));
    }

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

    public function show($id)
    {
        $poin = PoinMahasiswa::findOrFail($id);
        return view('poin.show', compact('poin'));
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

    public function export()
    {
        $poinMahasiswas = PoinMahasiswa::orderByDesc('poin')->get();

        $filename = 'poin_mahasiswa_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['NIM', 'Nama', 'Poin'];

        $callback = function() use ($poinMahasiswas, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($poinMahasiswas as $poin) {
                fputcsv($file, [$poin->nim, $poin->nama, $poin->poin]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
