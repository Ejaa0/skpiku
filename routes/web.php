<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PoinMahasiswaController;

// ⬇ Dashboard utama
Route::get('/', function () {
    return view('dashboard');
});

// ========== LOGIN ADMIN ==========
Route::get('/login/admin', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/login/admin', function (Request $request) {
    $adminEmail = 'rezaivander12@gmail.com';
    $adminPassword = 'rahasia123';

    if ($request->email === $adminEmail && $request->password === $adminPassword) {
        session(['is_admin_logged_in' => true]);
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('admin.login')->with('error', 'Email atau password salah.');
    }
})->name('admin.login.submit');

Route::get('/admin/dashboard', function () {
    if (!session('is_admin_logged_in')) {
        return redirect()->route('admin.login');
    }
    return view('admin.dashboard');
})->name('admin.dashboard');

// ========== LOGIN ORGANISASI ==========
Route::get('/login/organisasi', function () {
    return view('organisasi.login');
})->name('organisasi.login');

Route::post('/login/organisasi', function (Request $request) {
    $orgEmail = 'organisasi@unai.ac.id';
    $orgPassword = 'org123';

    if ($request->email === $orgEmail && $request->password === $orgPassword) {
        session(['is_org_logged_in' => true]);
        return redirect()->route('organisasi.dashboard');
    } else {
        return redirect()->route('organisasi.login')->with('error', 'Email atau password salah.');
    }
})->name('organisasi.login.submit');

Route::get('/organisasi/dashboard', function () {
    if (!session('is_org_logged_in')) {
        return redirect()->route('organisasi.login');
    }
    return view('organisasi.dashboard_organisasi');
})->name('organisasi.dashboard');

// ========== LOGIN WAREK ==========
Route::get('/login/warek', function () {
    return view('warek.login');
})->name('warek.login');

Route::post('/login/warek', function (Request $request) {
    $warekEmail = 'warek@unai.ac.id';
    $warekPassword = 'warek123';

    if ($request->email === $warekEmail && $request->password === $warekPassword) {
        session(['is_warek_logged_in' => true]);
        return redirect()->route('warek.dashboard');
    } else {
        return redirect()->route('warek.login')->with('error', 'Email atau password salah.');
    }
})->name('warek.login.submit');

Route::get('/warek/dashboard', function () {
    if (!session('is_warek_logged_in')) {
        return redirect()->route('warek.login');
    }
    return view('warek.dashboard_warek');
})->name('warek.dashboard');

// ========== LOGOUT ==========
Route::post('/logout', function () {
    session()->forget('is_admin_logged_in');
    session()->forget('is_org_logged_in');
    session()->forget('is_warek_logged_in'); // tambahan untuk warek
    return redirect()->route('warek.login');
})->name('logout');

// ========== LOGIN WAREK ==========
Route::get('/login/warek', function () {
    return view('warek.login'); // Lokasi: resources/views/warek/login.blade.php
})->name('warek.login');

Route::post('/login/warek', function (Illuminate\Http\Request $request) {
    $warekEmail = 'warek@unai.ac.id';
    $warekPassword = 'warek123';

    if ($request->email === $warekEmail && $request->password === $warekPassword) {
        session(['is_warek_logged_in' => true]);
        return redirect()->route('warek.dashboard');
    } else {
        return redirect()->route('warek.login')->with('error', 'Email atau password salah.');
    }
})->name('warek.login.submit');

// ========== DASHBOARD WAREK ==========
Route::get('/warek/dashboard', function () {
    if (!session('is_warek_logged_in')) {
        return redirect()->route('warek.login');
    }
    return view('warek.dashboard_warek'); // Lokasi: resources/views/warek/dashboard_warek.blade.php
})->name('warek.dashboard');

Route::post('/logout', function () {
    session()->forget('is_admin_logged_in');
    session()->forget('is_org_logged_in');
    session()->forget('is_warek_logged_in'); // ← tambahan ini penting
    return redirect('/'); // atau redirect()->route('warek.login');
})->name('logout');



// ========== RESOURCE CRUD ==========
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('organisasi', OrganisasiController::class);
Route::resource('poin', PoinMahasiswaController::class);

// ========== Tambahan eksplisit ==========
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

// ========== Middleware siap pakai ==========
Route::middleware(['auth', 'role:admin,organisasi'])->group(function () {
    // Siapkan untuk proteksi lanjutan
});
