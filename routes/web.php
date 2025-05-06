<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/mahasiswas');
});

Route::resource('mahasiswas', MahasiswaController::class);
