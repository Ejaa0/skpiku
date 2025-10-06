<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\SKPIController;
use App\Http\Controllers\DetailOrganisasiMahasiswaController;
use App\Http\Controllers\PoinMahasiswaController;
use App\Http\Controllers\WarekController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganisasiSelfController;
use App\Http\Controllers\PenentuanPoinController;
use App\Http\Controllers\KegiatanSelfController;

// ========================== DEFAULT ADMIN ==========================
$defaultAdminEmail = 'rezaivander12@gmail.com';
$defaultAdminPasswordHash = password_hash('rahasia123', PASSWORD_DEFAULT);

// ========================== HALAMAN UTAMA ==========================
Route::get('/', fn() => view('dashboard'))->name('beranda');

// ========================== LOGIN MAHASISWA ==========================
Route::prefix('login/mahasiswa')->group(function () {
    Route::get('/', fn() => view('mahasiswa.login'))->name('mahasiswa.login');
    Route::post('/', function (Request $request) {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        if ($request->email === 'mahasiswa@unai.ac.id' && $request->password === '123456') {
            session([
                'is_mahasiswa_logged_in' => true,
                'mahasiswa_email' => $request->email,
                'mahasiswa_nim' => '1234567890',
                'mahasiswa_nama' => 'Nama Dummy Mahasiswa',
            ]);
            return redirect()->route('mahasiswa.dashboard');
        }
        return back()->with('error', 'Email atau password salah.');
    })->name('mahasiswa.login.submit');
});

Route::middleware(['web'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        if (!session('is_mahasiswa_logged_in')) return redirect()->route('mahasiswa.login');
        return view('mahasiswa.dashboard', [
            'mahasiswa' => [
                'nim' => session('mahasiswa_nim'),
                'email' => session('mahasiswa_email'),
                'nama' => session('mahasiswa_nama'),
            ]
        ]);
    })->name('mahasiswa.dashboard');

    Route::post('/logout/mahasiswa', function () {
        session()->forget(['is_mahasiswa_logged_in', 'mahasiswa_nim', 'mahasiswa_email', 'mahasiswa_nama']);
        return redirect()->route('mahasiswa.login');
    })->name('logout.mahasiswa');
});

// ========================== LOGIN ADMIN ==========================
Route::prefix('login/admin')->group(function () use ($defaultAdminEmail, $defaultAdminPasswordHash) {
    Route::get('/', fn() => view('admin.login'))->name('admin.login');
    Route::post('/', function (Request $request) use ($defaultAdminEmail, $defaultAdminPasswordHash) {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        if ($request->email === $defaultAdminEmail && password_verify($request->password, $defaultAdminPasswordHash)) {
            session([
                'is_admin_logged_in' => true,
                'admin_email' => $request->email,
                'admin_name' => 'Admin Sistem'
            ]);
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Email atau password salah.');
    })->name('admin.login.submit');
});

Route::get('/admin/dashboard', function () {
    if (!session('is_admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.dashboard');
})->name('admin.dashboard');

// ========================== LOGIN ORGANISASI ==========================
Route::prefix('login/organisasi')->group(function () {
    Route::get('/', fn() => view('tampilan_organisasi.login'))->name('organisasi.login');
    Route::post('/', function (Request $request) {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        if ($request->email === 'organisasi@unai.ac.id' && $request->password === 'org123') {
            session(['is_org_logged_in' => true]);
            return redirect()->route('organisasi.dashboard');
        }
        return back()->with('error', 'Email atau password salah.');
    })->name('organisasi.login.submit');
});

Route::get('/organisasi/dashboard', function () {
    if (!session('is_org_logged_in')) return redirect()->route('organisasi.login');
    return view('tampilan_organisasi.dashboard_organisasi');
})->name('organisasi.dashboard');

// ========================== LOGIN WAREK ==========================
Route::prefix('login/warek')->group(function () {
    Route::get('/', fn() => view('warek.login'))->name('warek.login');
    Route::post('/', function (Request $request) {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        if ($request->email === 'warek@unai.ac.id' && $request->password === 'warek123') {
            session(['is_warek_logged_in' => true]);
            return redirect()->route('warek.dashboard');
        }
        return back()->with('error', 'Email atau password salah.');
    })->name('warek.login.submit');
});

Route::get('/warek/dashboard', [WarekController::class, 'index'])->name('warek.dashboard');

// ========================== LOGOUT ==========================
Route::post('/logout', function () {
    session()->flush();
    return redirect()->route('admin.login');
})->name('logout');

Route::post('/logout/warek', function () {
    session()->forget('is_warek_logged_in');
    return redirect()->route('warek.login');
})->name('logout.warek');

// ========================== SKPI ==========================
Route::prefix('skpi')->group(function () {
    Route::get('/form', [SKPIController::class, 'form'])->name('skpi.form');
    Route::post('/generate', [SKPIController::class, 'generate'])->name('skpi.generate');
    Route::post('/generate-diploma', [SKPIController::class, 'generateDiploma'])->name('skpi.generateDiploma');
    Route::get('/{skpi}/export-pdf', [SKPIController::class, 'exportPdf'])->name('skpi.exportPdf');
});
Route::resource('skpi', SKPIController::class);

// ========================== MAHASISWA ==========================
Route::get('/mahasiswa/data', [MahasiswaController::class, 'dataMahasiswa'])->name('mahasiswa.data');
Route::resource('mahasiswa', MahasiswaController::class);

// ========================== ORGANISASI (ADMIN) ==========================
Route::resource('organisasi', OrganisasiController::class);
Route::get('/organisasi/{id_organisasi}/anggota/create', [OrganisasiController::class, 'formTambahAnggota'])->name('organisasi.anggota.create');
Route::post('/organisasi/{id_organisasi}/anggota', [OrganisasiController::class, 'simpanAnggota'])->name('organisasi.anggota.store');

// ========================== KEGIATAN ==========================
Route::resource('kegiatan', KegiatanController::class);
Route::get('/kegiatan/{id_kegiatan}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaForm'])->name('kegiatan.tambahMahasiswaForm');
Route::post('/kegiatan/{id_kegiatan}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaStore'])->name('kegiatan.storeMahasiswa');
Route::delete('/kegiatan/{id_kegiatan}/mahasiswa/{nim}', [KegiatanController::class, 'hapusMahasiswa'])->name('kegiatan.hapusMahasiswa');

// ========================== DETAIL ORGANISASI MAHASISWA ==========================
Route::get('/detail-organisasi', [DetailOrganisasiMahasiswaController::class, 'index'])->name('detail_organisasi_mahasiswa.index');
Route::get('/detail-organisasi-mahasiswa/create/{id_organisasi}', [DetailOrganisasiMahasiswaController::class, 'create'])->name('detail_organisasi_mahasiswa.create');
Route::post('/detail-organisasi-mahasiswa/store', [DetailOrganisasiMahasiswaController::class, 'store'])->name('detail_organisasi_mahasiswa.store');
Route::get('/detail-organisasi-mahasiswa/{id}/edit', [DetailOrganisasiMahasiswaController::class, 'edit'])->name('detail_organisasi_mahasiswa.edit');
Route::put('/detail-organisasi-mahasiswa/{id}', [DetailOrganisasiMahasiswaController::class, 'update'])->name('detail_organisasi_mahasiswa.update');
Route::delete('/detail-organisasi-mahasiswa/{id}', [DetailOrganisasiMahasiswaController::class, 'destroy'])->name('detail_organisasi_mahasiswa.destroy');

// ========================== POIN MAHASISWA ==========================
Route::get('/poin/export', [PoinMahasiswaController::class, 'export'])->name('poin.export');
Route::get('/poin/latest/all', [PoinMahasiswaController::class, 'getAllLatestPoin'])->name('poin.latestAll');
Route::resource('poin', PoinMahasiswaController::class);

// ========================== PROFILE & PENENTUAN POIN ==========================
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/penentuan-poin', [PenentuanPoinController::class, 'index'])->name('penentuan-poin.index');
Route::resource('penentuan_poin', PenentuanPoinController::class);

// ========================== ORGANISASI SELF ==========================
Route::prefix('org-self')->name('organisasi.self.')->group(function () {
    Route::get('/', [OrganisasiSelfController::class, 'index'])->name('index');
    Route::get('/create', [OrganisasiSelfController::class, 'create'])->name('create');
    Route::post('/store', [OrganisasiSelfController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [OrganisasiSelfController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [OrganisasiSelfController::class, 'update'])->name('update');
    Route::get('/show/{id}', [OrganisasiSelfController::class, 'show'])->name('show');
    Route::delete('/destroy/{id}', [OrganisasiSelfController::class, 'destroy'])->name('destroy');

    // Anggota
    Route::get('/tambah-anggota/{id_organisasi}', [OrganisasiSelfController::class, 'tambahAnggota'])->name('tambah_anggota');
    Route::post('/store-anggota/{id_organisasi}', [OrganisasiSelfController::class, 'storeAnggota'])->name('store_anggota');
    Route::delete('/delete-anggota/{id_organisasi}/{nim}', [OrganisasiSelfController::class, 'deleteAnggota'])->name('delete_anggota');
    Route::get('/edit-anggota/{id_organisasi}/{nim}', [OrganisasiSelfController::class, 'editAnggota'])->name('edit_anggota');
    Route::post('/update-anggota/{id_organisasi}/{nim}', [OrganisasiSelfController::class, 'updateAnggota'])->name('update_anggota');
});

// ========================== KEGIATAN SELF ==========================
Route::prefix('kegiatan-self')->name('kegiatan-self.')->group(function () {
    Route::get('/', [KegiatanSelfController::class, 'index'])->name('index');
    Route::get('/create', [KegiatanSelfController::class, 'create'])->name('create');
    Route::post('/', [KegiatanSelfController::class, 'store'])->name('store');
    Route::get('/{id}/show', [KegiatanSelfController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [KegiatanSelfController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [KegiatanSelfController::class, 'update'])->name('update');
    Route::delete('/{id}', [KegiatanSelfController::class, 'destroy'])->name('destroy');
});
