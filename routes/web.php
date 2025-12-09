<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Models
use App\Models\User;
use App\Models\Organisasi;
use App\Models\Kegiatan;

// Controllers
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
use App\Http\Controllers\OrganisasiDashboardController;
use App\Http\Controllers\WarekPoinController;
use App\Http\Controllers\WarekOrganisasiController;
use App\Http\Controllers\WarekTambahAnggotaController;
use App\Http\Controllers\WarekKegiatanController;
use App\Http\Controllers\WarekTambahAnggotaKegiatanController;

// ========================== HALAMAN UTAMA ==========================
Route::get('/', fn() => redirect()->route('login'));


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

    session([
        'is_logged_in' => true,
        'user_id'     => $user->id,
        'user_name'   => $user->name,
        'user_email'  => $user->email,
        'user_role'   => $user->role,
    ]);

    return match($user->role) {
        'admin'      => redirect()->route('admin.dashboard'),
        'warek'      => redirect()->route('warek.dashboard'),
        'mahasiswa'  => redirect()->route('mahasiswa.dashboard'),
        'organisasi' => redirect()->route('organisasi.dashboard'),
        default      => redirect()->route('login')
    };
})->name('login.submit');


// ========================== FORGOT PASSWORD ==========================
Route::get('/forgot-password', fn() => view('forgot-password'))->name('forgot-password');

Route::post('/forgot-password', function(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();
    if(!$user) return back()->with('error', 'Email tidak ditemukan.');

    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with('success', 'Password berhasil diganti. Silakan login.');
});


// ========================== LOGOUT ==========================
Route::post('/logout', fn() => session()->flush() ?: redirect()->route('login'))->name('logout');

Route::post('/warek/logout', fn() => session()->flush() ?: redirect()->route('login'))->name('logout.warek');

// LOGOUT MAHASISWA
Route::get('/logout/mahasiswa', function () {
    session()->forget('mahasiswa');
    return redirect('/login');
})->name('mahasiswa.logout');



// ========================== DASHBOARD SESUAI ROLE ==========================
Route::middleware(['web'])->group(function () {

    // ADMIN
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

    // WAREK
    Route::get('/warek/dashboard', function() {
        if (!session('is_logged_in') || session('user_role') !== 'warek') {
            return redirect()->route('login');
        }

        $totalOrganisasi = Organisasi::count();
        $totalKegiatan   = Kegiatan::count();

        return view('warek.dashboard', compact('totalOrganisasi', 'totalKegiatan'));
    })->name('warek.dashboard');

    // MAHASISWA
   Route::get('/mahasiswa/dashboard', function () {

    if (!session('is_logged_in') || session('user_role') !== 'mahasiswa') {
        return redirect('/login/mahasiswa');
    }

    return view('tampilan_mahasiswa.index', [
        'mahasiswa' => [
            'nim'   => session('user_nim'),
            'nama'  => session('user_name'),
            'email' => session('user_email'),
        ]
    ]);
})->name('mahasiswa.dashboard');


    // ORGANISASI LOGIN
    Route::get('/organisasi/dashboard', [OrganisasiDashboardController::class, 'index'])
        ->name('organisasi.dashboard');

        Route::get('/warek/poin/{nim}', [WarekPoinController::class, 'show'])
    ->name('warek.poin.detail');

});


// ========================== POIN MAHASISWA WR III ==========================
Route::get('/warek/poin', [WarekPoinController::class, 'index'])
    ->name('warek.poin');


// ========================== WAREK - DATA ORGANISASI ==========================

// LIST ORGANISASI
Route::get('/warek/dataorganisasi', [WarekOrganisasiController::class, 'index'])
    ->name('warek.dataorganisasi.index');

// TAMPIL DETAIL ORGANISASI
Route::get('/warek/dataorganisasi/show/{id_organisasi}', [WarekOrganisasiController::class, 'show'])
    ->name('warek.dataorganisasi.show');

// EDIT ORGANISASI
Route::get('/warek/dataorganisasi/{id_organisasi}/edit', [WarekOrganisasiController::class, 'edit'])
    ->name('warek.dataorganisasi.edit');

// UPDATE ORGANISASI
Route::put('/warek/dataorganisasi/{id_organisasi}', [WarekOrganisasiController::class, 'update'])
    ->name('warek.dataorganisasi.update');

// DELETE ORGANISASI
Route::delete('/warek/dataorganisasi/{id_organisasi}', [WarekOrganisasiController::class, 'destroy'])
    ->name('warek.dataorganisasi.destroy');


// ========================== WAREK - ANGGOTA ORGANISASI ==========================
// FORM TAMBAH ANGGOTA
Route::get('/warek/dataorganisasi/{id_organisasi}/anggota/tambah', 
    [WarekTambahAnggotaController::class, 'create'])
    ->name('warek.dataorganisasi.anggota.create');

// SIMPAN ANGGOTA
Route::post('/warek/dataorganisasi/{id_organisasi}/anggota/tambah',
    [WarekTambahAnggotaController::class, 'store'])
    ->name('warek.dataorganisasi.anggota.store');

// EDIT ANGGOTA
Route::get('/warek/dataorganisasi/anggota/{id}/edit',
    [WarekTambahAnggotaController::class, 'edit'])
    ->name('warek.dataorganisasi.anggota.edit');

// UPDATE ANGGOTA
Route::put('/warek/dataorganisasi/anggota/{id}',
    [WarekTambahAnggotaController::class, 'update'])
    ->name('warek.dataorganisasi.anggota.update');

// DELETE ANGGOTA
Route::delete('/warek/dataorganisasi/anggota/{id}',
    [WarekTambahAnggotaController::class, 'destroy'])
    ->name('warek.dataorganisasi.anggota.destroy');

    // ========================== WAREK - DATA KEGIATAN ==========================

// LIST KEGIATAN
Route::get('/warek/datakegiatan', [WarekKegiatanController::class, 'index'])
    ->name('warek.datakegiatan.index');

// SHOW KEGIATAN
Route::get('/warek/datakegiatan/{id}', [WarekKegiatanController::class, 'show'])
    ->name('warek.datakegiatan.show');

// EDIT KEGIATAN
Route::get('/warek/datakegiatan/{id}/edit', [WarekKegiatanController::class, 'edit'])
    ->name('warek.datakegiatan.edit');

// UPDATE KEGIATAN
Route::put('/warek/datakegiatan/{id}', [WarekKegiatanController::class, 'update'])
    ->name('warek.datakegiatan.update');

// DELETE KEGIATAN
Route::delete('/warek/datakegiatan/{id}', [WarekKegiatanController::class, 'destroy'])
    ->name('warek.datakegiatan.destroy');

    

Route::prefix('warek/datakegiatan')->name('warek.tambahanggota.kegiatan.')->group(function() {
    Route::get('{id}/show', [WarekTambahAnggotaKegiatanController::class, 'show'])
        ->name('show');

    Route::get('{id}/tambah-mahasiswa', [WarekTambahAnggotaKegiatanController::class, 'create'])
        ->name('create');

    Route::post('{id}/tambah-mahasiswa', [WarekTambahAnggotaKegiatanController::class, 'store'])
        ->name('store');

    Route::delete('{id}/hapus-mahasiswa/{nim}', [WarekTambahAnggotaKegiatanController::class, 'destroy'])
        ->name('destroy');
});



// ============================================================================
// ========================= SISTEM SKPI ======================================
// ============================================================================
Route::prefix('skpi')->group(function () {
    Route::get('/form', [SKPIController::class, 'form'])->name('skpi.form');
    Route::post('/generate', [SKPIController::class, 'generate'])->name('skpi.generate');
    Route::post('/generate-diploma', [SKPIController::class, 'generateDiploma'])->name('skpi.generateDiploma');
    Route::get('/{skpi}/export-pdf', [SKPIController::class, 'exportPdf'])->name('skpi.exportPdf');
});
Route::resource('skpi', SKPIController::class);


// ========================== MAHASISWA CRUD ==========================
Route::get('/mahasiswa/data', [MahasiswaController::class, 'dataMahasiswa'])
    ->name('mahasiswa.data');

Route::resource('mahasiswa', MahasiswaController::class);


// ========================== ORGANISASI CRUD ==========================
Route::resource('organisasi', OrganisasiController::class);

// ORGANISASI - ANGGOTA CRUD SENDIRI
Route::get('/organisasi/{id_organisasi}/anggota/create', [OrganisasiController::class, 'formTambahAnggota'])
    ->name('organisasi.anggota.create');

Route::post('/organisasi/{id_organisasi}/anggota', [OrganisasiController::class, 'simpanAnggota'])
    ->name('organisasi.anggota.store');


// ========================== KEGIATAN CRUD ==========================
Route::resource('kegiatan', KegiatanController::class);

Route::get('/kegiatan/{id}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaForm'])
    ->name('kegiatan.tambahMahasiswaForm');

Route::post('/kegiatan/{id}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaStore'])
    ->name('kegiatan.storeMahasiswa');

Route::delete('/kegiatan/{id}/mahasiswa/{nim}', [KegiatanController::class, 'hapusMahasiswa'])
    ->name('kegiatan.hapusMahasiswa');


// ========================== DETAIL ORGANISASI MAHASISWA (Umum) ==========================
Route::get('/detail-organisasi', [DetailOrganisasiMahasiswaController::class, 'index'])
    ->name('detail_organisasi_mahasiswa.index');

Route::get('/detail-organisasi-mahasiswa/create/{id}', [DetailOrganisasiMahasiswaController::class, 'create'])
    ->name('detail_organisasi_mahasiswa.create');

Route::post('/detail-organisasi-mahasiswa/store', [DetailOrganisasiMahasiswaController::class, 'store'])
    ->name('detail_organisasi_mahasiswa.store');

Route::get('/detail-organisasi-mahasiswa/{id}/edit', [DetailOrganisasiMahasiswaController::class, 'edit'])
    ->name('detail_organisasi_mahasiswa.edit');

Route::put('/detail-organisasi-mahasiswa/{id}', [DetailOrganisasiMahasiswaController::class, 'update'])
    ->name('detail_organisasi_mahasiswa.update');

Route::delete('/detail-organisasi-mahasiswa/{id}', [DetailOrganisasiMahasiswaController::class, 'destroy'])
    ->name('detail_organisasi_mahasiswa.destroy');


// ========================== POIN MAHASISWA ==========================
Route::get('/poin/export', [PoinMahasiswaController::class, 'export'])->name('poin.export');
Route::get('/poin/latest/all', [PoinMahasiswaController::class, 'getAllLatestPoin'])->name('poin.latestAll');
Route::resource('poin', PoinMahasiswaController::class);


// ========================== PROFILE & PENENTUAN POIN ==========================
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/penentuan-poin', [PenentuanPoinController::class, 'index'])
    ->name('penentuan-poin.index');

Route::resource('penentuan_poin', PenentuanPoinController::class);


// ========================== ORGANISASI SELF (LOGIN ORGANISASI) ==========================
Route::prefix('org-self')->name('organisasi.self.')->group(function () {
    Route::get('/', [OrganisasiSelfController::class, 'index'])->name('index');
    Route::get('/create', [OrganisasiSelfController::class, 'create'])->name('create');
    Route::post('/store', [OrganisasiSelfController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [OrganisasiSelfController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [OrganisasiSelfController::class, 'update'])->name('update');
    Route::get('/show/{id}', [OrganisasiSelfController::class, 'show'])->name('show');
    Route::delete('/destroy/{id}', [OrganisasiSelfController::class, 'destroy'])->name('destroy');

    Route::get('/tambah-anggota/{id}', [OrganisasiSelfController::class, 'tambahAnggota'])->name('tambah_anggota');
    Route::post('/store-anggota/{id}', [OrganisasiSelfController::class, 'storeAnggota'])->name('store_anggota');
    Route::delete('/delete-anggota/{id}/{nim}', [OrganisasiSelfController::class, 'deleteAnggota'])->name('delete_anggota');
    Route::get('/edit-anggota/{id}/{nim}', [OrganisasiSelfController::class, 'editAnggota'])->name('edit_anggota');
    Route::post('/update-anggota/{id}/{nim}', [OrganisasiSelfController::class, 'updateAnggota'])->name('update_anggota');
});


// ========================== KEGIATAN SELF ==========================
Route::prefix('kegiatan-self')->name('kegiatan-self.')->group(function () {
    Route::get('/create', [KegiatanSelfController::class, 'create'])->name('create');
    Route::post('/store', [KegiatanSelfController::class, 'store'])->name('store');
    Route::get('/{id}/add-mahasiswa', [KegiatanSelfController::class, 'addMahasiswa'])->name('addMahasiswa');
    Route::post('/{id}/store-mahasiswa', [KegiatanSelfController::class, 'storeMahasiswa'])->name('storeMahasiswa');
    Route::get('/{id}/edit', [KegiatanSelfController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [KegiatanSelfController::class, 'update'])->name('update');
    Route::delete('/{id}/mahasiswa/{nim}', [KegiatanSelfController::class, 'destroyMahasiswa'])->name('destroyMahasiswa');
    Route::delete('/{id}', [KegiatanSelfController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [KegiatanSelfController::class, 'show'])->name('show');
    Route::get('/', [KegiatanSelfController::class, 'index'])->name('index');

// LIST KEGIATAN
Route::get('/warek/datakegiatan', [WarekKegiatanController::class, 'index'])
    ->name('warek.datakegiatan.index');

// SHOW KEGIATAN
Route::get('/warek/datakegiatan/{id}', [WarekKegiatanController::class, 'show'])
    ->name('warek.datakegiatan.show');

// EDIT KEGIATAN
Route::get('/warek/datakegiatan/{id}/edit', [WarekKegiatanController::class, 'edit'])
    ->name('warek.datakegiatan.edit');

// UPDATE KEGIATAN
Route::put('/warek/datakegiatan/{id}', [WarekKegiatanController::class, 'update'])
    ->name('warek.datakegiatan.update');

// DELETE KEGIATAN
Route::delete('/warek/datakegiatan/{id}', [WarekKegiatanController::class, 'destroy'])
    ->name('warek.datakegiatan.destroy');

    

    
});
