<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class WarekPoinController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('poin_mahasiswas');

        if ($request->has('q') && $request->q != '') {
            $q = $request->q;
            $query->where('nim', 'like', "%$q%")
                  ->orWhere('nama', 'like', "%$q%");
        }

        // Gunakan paginate untuk bisa pakai appends() di Blade
        $mahasiswas = $query->paginate(10);

        // Hitung total poin untuk setiap mahasiswa
        $mahasiswas->getCollection()->transform(function($m) {
            $kegiatanCount = DB::table('detail_kegiatan_mahasiswa')
                ->where('mahasiswa_nim', $m->nim)
                ->count();
            $organisasiCount = DB::table('detail_organisasi_mahasiswa')
                ->where('nim', $m->nim)
                ->count();

            $m->total_poin = ($kegiatanCount * 100) + ($organisasiCount * 250);
            return $m;
        });

        return view('warek.poin.index', compact('mahasiswas'));
    }

    public function show($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        // Riwayat kegiatan mahasiswa
        $kegiatan = DB::table('detail_kegiatan_mahasiswa')
            ->join('kegiatans', 'detail_kegiatan_mahasiswa.kegiatan_id_ref', '=', 'kegiatans.id')
            ->where('detail_kegiatan_mahasiswa.mahasiswa_nim', $nim)
            ->select('kegiatans.nama_kegiatan', 'kegiatans.tanggal_kegiatan')
            ->get()
            ->transform(function($k){
                $k->poin = 100;
                return $k;
            });

        // Riwayat organisasi mahasiswa termasuk jabatan
        $organisasi = DB::table('detail_organisasi_mahasiswa')
            ->where('nim', $nim)
            ->select('nama_organisasi', 'jabatan')
            ->get()
            ->transform(function($o){
                $o->poin = 250;
                return $o;
            });

        // Hitung total poin
        $totalPoin = ($kegiatan->count() * 100) + ($organisasi->count() * 250);

        return view('warek.poin.show', compact('mahasiswa', 'kegiatan', 'organisasi', 'totalPoin'));
    }
}
