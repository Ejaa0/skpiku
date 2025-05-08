<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;

Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('organisasi', OrganisasiController::class);



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


// Tambahkan route lainnya sesuai kebutuhan


