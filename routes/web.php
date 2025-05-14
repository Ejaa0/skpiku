<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PoinMahasiswaController;

// ⬇ Dashboard utama
Route::get('/', function () {
    return view('dashboard');
});

// ⬇ Login Admin
Route::get('/login/admin', function () {
    return view('admin.login'); // File: resources/views/admin/login.blade.php
})->name('admin.login');

// ⬇ Proses Login Admin (sementara redirect saja)
Route::post('/login/admin', function () {
    // Di sini kamu bisa tambahkan logika autentikasi manual nanti
    return redirect()->route('admin.dashboard');
})->name('admin.login.submit');

// ⬇ Dashboard Admin setelah login
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // File: resources/views/admin/dashboard.blade.php
})->name('admin.dashboard');

// ⬇ CRUD Mahasiswa, Kegiatan, Organisasi, Poin
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('organisasi', OrganisasiController::class);
Route::resource('poin', PoinMahasiswaController::class);

// ⬇ Rute tambahan eksplisit (jika kamu ingin custom kontrol lebih dalam)
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

// ⬇ Middleware role (siapkan nanti untuk autentikasi terpisah)
Route::middleware(['auth', 'role:admin,organisasi'])->group(function () {
    // Route yang dilindungi bisa kamu pindahkan ke sini
});
