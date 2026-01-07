<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /**
         * ===============================
         * NOTIFIKASI & TEMAN ONLINE
         * ===============================
         */
        View::composer('*', function ($view) {
            $nim = session('user_nim');

            // Jika user belum login, beri default kosong
            if (!$nim) {
                $view->with('notifikasi', collect());
                $view->with('temanOnline', collect());
                return;
            }

            // Ambil permintaan teman pending
            $notifikasi = DB::table('teman_requests')
                ->where('penerima_nim', $nim)
                ->where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->get();

            // Ambil teman yang sudah diterima
            $temanOnline = DB::table('temans')
                ->join('mahasiswas', 'mahasiswas.nim', '=', 'temans.teman_nim')
                ->where('temans.mahasiswa_nim', $nim)
                ->select('mahasiswas.nim', 'mahasiswas.nama', 'mahasiswas.online')
                ->get();

            $view->with(compact('notifikasi', 'temanOnline'));
        });
    }
}
