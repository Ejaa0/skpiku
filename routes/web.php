<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // untuk Auth Laravel jika dipakai nanti

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PoinMahasiswaController;

// ⬇ Dashboard utama
Route::get('/', function () {
    return view('dashboard');
});

// ⬇ Login Admin (GET)
Route::get('/login/admin', function () {
    return view('admin.login'); // File: resources/views/admin/login.blade.php
})->name('admin.login');

// ⬇ Proses Login Admin (POST manual dengan session)
Route::post('/login/admin', function (Request $request) {
    // ✅ Ganti sesuai kebutuhan
    $adminEmail = 'rezaivander12@gmail.com';
    $adminPassword = 'rahasia123';

    if ($request->email === $adminEmail && $request->password === $adminPassword) {
        session(['is_admin_logged_in' => true]);
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('admin.login')->with('error', 'Email atau password salah.');
    }
})->name('admin.login.submit');

// ⬇ Dashboard Admin (dilindungi session)
Route::get('/admin/dashboard', function () {
    if (!session('is_admin_logged_in')) {
        return redirect()->route('admin.login');
    }
    return view('admin.dashboard'); // File: resources/views/admin/dashboard.blade.php
})->name('admin.dashboard');

// ⬇ Logout Admin (hapus session)
Route::post('/logout', function () {
    session()->forget('is_admin_logged_in');
    return redirect()->route('admin.login');
})->name('logout');

// ⬇ CRUD Mahasiswa, Kegiatan, Organisasi, Poin
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('organisasi', OrganisasiController::class);
Route::resource('poin', PoinMahasiswaController::class);

// ⬇ Rute tambahan eksplisit untuk kontrol penuh
Route::get('/organisasi', [OrganisasiController::class, 'index'])->name('organisasi.index');
Route::post('/organisasi', [OrganisasiController::class, 'store'])->name('organisasi.store');
Route::get('/organisasi/create', [OrganisasiController::class, 'create'])->name('organisasi.create');

Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
Route::get('/kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');
Route::get('/kegiatan/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
Route::put('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

// ⬇ Placeholder Middleware (siap dipakai jika pakai Auth Laravel nanti)
Route::middleware(['auth', 'role:admin,organisasi'])->group(function () {
    // Kamu bisa pindahkan route yang butuh perlindungan khusus ke sini
});
