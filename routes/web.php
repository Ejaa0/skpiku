<?php

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\SKPIController;
use App\Http\Controllers\PoinMahasiswaController;

// ======================== KONFIG DEFAULT ADMIN ========================
$defaultAdminEmail = 'rezaivander12@gmail.com';
$defaultAdminPasswordHash = password_hash('rahasia123', PASSWORD_DEFAULT);

// ======================== HALAMAN UTAMA ========================
Route::get('/', fn () => view('dashboard'))->name('beranda');

// ======================== LOGIN MAHASISWA (Dummy) ========================
Route::get('/login/mahasiswa', fn() => view('mahasiswa.login'))->name('mahasiswa.login');

Route::post('/login/mahasiswa', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $dummyEmail = 'mahasiswa@unai.ac.id';
    $dummyPassword = '123456';

    if ($request->email === $dummyEmail && $request->password === $dummyPassword) {
        session([
            'is_mahasiswa_logged_in' => true,
            'mahasiswa_email' => $dummyEmail,
            'mahasiswa_nim' => '1234567890',
            'mahasiswa_nama' => 'Nama Dummy Mahasiswa',
        ]);
        return redirect()->route('mahasiswa.dashboard');
    }

    return redirect()->route('mahasiswa.login')->with('error', 'Email atau password salah.');
})->name('mahasiswa.login.submit');

Route::get('/mahasiswa/dashboard', function () {
    if (!session('is_mahasiswa_logged_in')) {
        return redirect()->route('mahasiswa.login');
    }

    $mahasiswa = [
        'nim' => session('mahasiswa_nim'),
        'email' => session('mahasiswa_email'),
        'nama' => session('mahasiswa_nama'),
    ];

    return view('mahasiswa.dashboard', compact('mahasiswa'));
})->name('mahasiswa.dashboard');

Route::post('/logout/mahasiswa', function () {
    session()->forget(['is_mahasiswa_logged_in', 'mahasiswa_nim', 'mahasiswa_email', 'mahasiswa_nama']);
    return redirect()->route('mahasiswa.login');
})->name('logout.mahasiswa');

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

// ======================== SKPI ROUTES ========================
Route::get('/skpi/form', [SKPIController::class, 'form']);
Route::post('/skpi/generate', [SKPIController::class, 'generate'])->name('skpi.generate');
Route::get('/skpi/{skpi}/export-pdf', [SKPIController::class, 'exportPdf'])->name('skpi.exportPdf');
Route::post('/skpi/generate-diploma', [SKPIController::class, 'generateDiploma']);
Route::get('/skpi', [SKPIController::class, 'index'])->name('skpi.index');
Route::resource('skpi', SKPIController::class);

// ======================== MAHASISWA ROUTES ========================
// Menampilkan halaman data mahasiswa dengan fitur search dan list
Route::get('/mahasiswa/data', [MahasiswaController::class, 'dataMahasiswa'])->name('mahasiswa.data');

// Halaman dashboard mahasiswa (bisa dipakai untuk dashboard utama mahasiswa)
Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');

// Route logout mahasiswa via controller
Route::post('/mahasiswa/logout', [MahasiswaController::class, 'logout'])->name('logout.mahasiswa');

// ======================== RESOURCE CONTROLLERS ========================
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('organisasi', OrganisasiController::class);
Route::resource('poin', PoinMahasiswaController::class);
