<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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

// ========================== HALAMAN UTAMA ==========================
Route::get('/', fn() => view('dashboard'))->name('beranda');

// ========================== LOGIN ==========================
Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', function(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Email atau password salah.');
    }

    // Simpan session
    session([
        'is_logged_in' => true,
        'user_id' => $user->id,
        'user_name' => $user->name,
        'user_email' => $user->email,
        'user_role' => $user->role,
    ]);

    // Redirect sesuai role
    return match($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'warek' => redirect()->route('warek.dashboard'),
        'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
        'organisasi' => redirect()->route('organisasi.dashboard'),
        default => redirect()->route('login')
    };
})->name('login.submit');

// ========================== LOGOUT ==========================
Route::post('/logout', function() {
    session()->flush();
    return redirect()->route('login');
})->name('logout');

// ========================== DASHBOARD ROLE ==========================
Route::middleware(['web'])->group(function () {

    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))
        ->name('admin.dashboard');

    Route::get('/warek/dashboard', [WarekController::class, 'index'])
        ->name('warek.dashboard');

    Route::get('/mahasiswa/dashboard', function() {
        if (!session('is_logged_in') || session('user_role') !== 'mahasiswa') {
            return redirect()->route('login');
        }
        return view('mahasiswa.dashboard', [
            'mahasiswa' => [
                'nim' => '1234567890', // bisa diganti ambil dari DB
                'email' => session('user_email'),
                'nama' => session('user_name'),
            ]
        ]);
    })->name('mahasiswa.dashboard');

    Route::get('/organisasi/dashboard', function() {
        if (!session('is_logged_in') || session('user_role') !== 'organisasi') {
            return redirect()->route('login');
        }
        return view('tampilan_organisasi.dashboard_organisasi');
    })->name('organisasi.dashboard');

});

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
