<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\SKPIController;
use App\Http\Controllers\PoinMahasiswaController;

$defaultAdminEmail = 'rezaivander12@gmail.com';
$defaultAdminPasswordHash = password_hash('rahasia123', PASSWORD_DEFAULT);

// ======================== HALAMAN UTAMA (DASHBOARD AWAL) ========================
Route::get('/', function () {
    return view('dashboard'); // Menampilkan resources/views/dashboard.blade.php
})->name('beranda');

// ======================== LOGIN MAHASISWA ========================
Route::get('/login/mahasiswa', fn () => view('mahasiswa.login'))->name('mahasiswa.login');

Route::post('/login/mahasiswa', function (Request $request) {
    if ($request->email === 'mahasiswa@unai.ac.id' && $request->password === 'mahasiswa123') {
        session([
            'is_mahasiswa_logged_in' => true,
            'mahasiswa_email' => $request->email,
        ]);
        return redirect('/mahasiswa/dashboard');
    }
    return redirect()->route('mahasiswa.login')->with('error', 'Email atau password salah.');
})->name('mahasiswa.login.submit');

Route::get('/mahasiswa/dashboard', function () {
    if (!session('is_mahasiswa_logged_in')) {
        return redirect()->route('mahasiswa.login');
    }
    return view('mahasiswa.dashboard');
})->name('mahasiswa.dashboard');

// ======================== LOGIN ADMIN ========================
Route::get('/login/admin', fn () => view('admin.login'))->name('admin.login');

Route::post('/login/admin', function (Request $request) use ($defaultAdminEmail, $defaultAdminPasswordHash) {
    if ($request->email === $defaultAdminEmail && password_verify($request->password, $defaultAdminPasswordHash)) {
        session([
            'is_admin_logged_in' => true,
            'admin_email' => $request->email,
            'admin_name' => 'Admin Sistem',
        ]);
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login')->with('error', 'Email atau password salah.');
})->name('admin.login.submit');

Route::get('/admin/dashboard', function () {
    if (!session('is_admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.dashboard');
})->name('admin.dashboard');

// ======================== LOGIN ORGANISASI ========================
Route::get('/login/organisasi', fn () => view('organisasi.login'))->name('organisasi.login');

Route::post('/login/organisasi', function (Request $request) {
    if ($request->email === 'organisasi@unai.ac.id' && $request->password === 'org123') {
        session(['is_org_logged_in' => true]);
        return redirect()->route('organisasi.dashboard');
    }
    return redirect()->route('organisasi.login')->with('error', 'Email atau password salah.');
})->name('organisasi.login.submit');

Route::get('/organisasi/dashboard', function () {
    if (!session('is_org_logged_in')) return redirect()->route('organisasi.login');
    return view('organisasi.dashboard_organisasi');
})->name('organisasi.dashboard');

// ======================== LOGIN WAREK ========================
Route::get('/login/warek', fn () => view('warek.login'))->name('warek.login');

Route::post('/login/warek', function (Request $request) {
    if ($request->email === 'warek@unai.ac.id' && $request->password === 'warek123') {
        session(['is_warek_logged_in' => true]);
        return redirect()->route('warek.dashboard');
    }
    return redirect()->route('warek.login')->with('error', 'Email atau password salah.');
})->name('warek.login.submit');

Route::get('/warek/dashboard', function () {
    if (!session('is_warek_logged_in')) return redirect()->route('warek.login');
    return view('warek.dashboard_warek');
})->name('warek.dashboard');

// ======================== LOGOUT ========================
Route::post('/logout/warek', function () {
    session()->forget('is_warek_logged_in');
    return redirect()->route('warek.login');
})->name('logout.warek');

Route::post('/logout', function () {
    session()->flush();
    return redirect()->route('admin.login'); 
})->name('logout');


Route::get('/skpi/form', [SKPIController::class, 'form']);
Route::post('/skpi/generate', [SKPIController::class, 'generate'])->name('skpi.generate');
Route::get('/skpi/{skpi}/export-pdf', [SKPIController::class, 'exportPdf'])->name('skpi.exportPdf');
Route::get('/skpi', [SKPIController::class, 'index']);
Route::post('/skpi/generate', [SKPIController::class, 'generate']);
Route::resource('skpi', SKPIController::class);


// ======================== RESOURCE CONTROLLERS ========================
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('organisasi', OrganisasiController::class);
Route::resource('poin', PoinMahasiswaController::class);
