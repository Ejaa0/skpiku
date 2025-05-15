<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Default admin credentials
$defaultAdminEmail = 'rezaivander12@gmail.com';
$defaultAdminPasswordHash = password_hash('rahasia123', PASSWORD_DEFAULT);

// Dashboard utama
Route::get('/', function () {
    return view('dashboard');
});

// LOGIN ADMIN
Route::get('/login/admin', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/login/admin', function (Request $request) use ($defaultAdminEmail, $defaultAdminPasswordHash) {
    // Ambil password hash yang tersimpan di session, atau gunakan default
    $storedPasswordHash = session('admin_password', $defaultAdminPasswordHash);

    if ($request->email === $defaultAdminEmail && password_verify($request->password, $storedPasswordHash)) {
        session([
            'is_admin_logged_in' => true,
            'admin_email' => $request->email,
            'admin_name' => session('admin_name', 'Admin Sistem'),
            'admin_password' => $storedPasswordHash,
        ]);
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login')->with('error', 'Email atau password salah.');
})->name('admin.login.submit');

// DASHBOARD ADMIN
Route::get('/admin/dashboard', function () {
    if (!session('is_admin_logged_in')) {
        return redirect()->route('admin.login');
    }
    return view('admin.dashboard');
})->name('admin.dashboard');



// LOGOUT
Route::post('/logout', function () {
    session()->flush(); // hapus semua session
    return redirect('/');
})->name('logout');

// Tambahkan route login organisasi, warek, dashboard, dan resource sesuai kebutuhan
// Contoh:
Route::get('/login/organisasi', function () {
    return view('organisasi.login');
})->name('organisasi.login');

Route::post('/login/organisasi', function (Request $request) {
    $orgEmail = 'organisasi@unai.ac.id';
    $orgPassword = 'org123';

    if ($request->email === $orgEmail && $request->password === $orgPassword) {
        session(['is_org_logged_in' => true]);
        return redirect()->route('organisasi.dashboard');
    }
    return redirect()->route('organisasi.login')->with('error', 'Email atau password salah.');
})->name('organisasi.login.submit');

Route::get('/organisasi/dashboard', function () {
    if (!session('is_org_logged_in')) {
        return redirect()->route('organisasi.login');
    }
    return view('organisasi.dashboard_organisasi');
})->name('organisasi.dashboard');

Route::get('/login/warek', function () {
    return view('warek.login');
})->name('warek.login');

Route::post('/login/warek', function (Request $request) {
    $warekEmail = 'warek@unai.ac.id';
    $warekPassword = 'warek123';

    if ($request->email === $warekEmail && $request->password === $warekPassword) {
        session(['is_warek_logged_in' => true]);
        return redirect()->route('warek.dashboard');
    }
    return redirect()->route('warek.login')->with('error', 'Email atau password salah.');
})->name('warek.login.submit');

Route::get('/warek/dashboard', function () {
    if (!session('is_warek_logged_in')) {
        return redirect()->route('warek.login');
    }
    return view('warek.dashboard_warek');
})->name('warek.dashboard');

// Resource routes
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PoinMahasiswaController;

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('organisasi', OrganisasiController::class);
Route::resource('poin', PoinMahasiswaController::class);
