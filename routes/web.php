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



