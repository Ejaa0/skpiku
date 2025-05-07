<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\KegiatanController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('mahasiswas.index'));

Route::resource('mahasiswas', MahasiswaController::class);
Route::resource('organisasi', OrganisasiController::class);
Route::resource('kegiatan', KegiatanController::class);


