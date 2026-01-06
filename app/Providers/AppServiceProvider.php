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
        // View composer untuk notifikasi teman
        View::composer('*', function ($view) {
            $nim = session('user_nim'); // pastikan sama dengan session login

            $notifikasi = collect();
            if ($nim) {
                $notifikasi = DB::table('teman_requests')
                    ->where('penerima_nim', $nim)
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            $view->with('notifikasi', $notifikasi);
        });
    }
}
