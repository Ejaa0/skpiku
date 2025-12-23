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
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\MahasiswaKegiatanController;
use App\Http\Controllers\MahasiswaOrganisasiController;
use App\Http\Controllers\MahasiswaKlaimPoinController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\WarekPenentuanPoinController;

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

   $nim = substr($user->email, 0, 7);

session([
    'is_logged_in' => true,
    'user_id'     => $user->id,
    'user_name'   => $user->name,
    'user_email'  => $user->email,
    'user_role'   => $user->role,
    'user_nim'    => $nim, // ✅ FIX
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

    // MAHASISWA DASHBOARD
Route::get('/mahasiswa/dashboard', [DashboardMahasiswaController::class, 'index'])
    ->name('mahasiswa.dashboard');

    
 // ✅ TAMBAHKAN INI (KEGIATAN MAHASISWA)
    Route::get('/mahasiswa/kegiatan', [MahasiswaKegiatanController::class, 'index'])
        ->name('mahasiswa.kegiatan');
        
        Route::get('/mahasiswa/organisasi', [MahasiswaOrganisasiController::class, 'index'])
    ->name('mahasiswa.organisasi');


    // ORGANISASI
    Route::get('/organisasi/dashboard', [OrganisasiDashboardController::class, 'index'])->name('organisasi.dashboard');

    Route::get('/mahasiswa/klaim-poin', [App\Http\Controllers\MahasiswaKlaimPoinController::class, 'index'])
    ->name('mahasiswa.klaim-poin');


    Route::get('/mahasiswa/kriteria-poin', [MahasiswaController::class, 'kriteriaPoin'])
    ->name('mahasiswa.kriteria-poin');



    // DETAIL POIN MAHASISWA WAREK
    Route::get('/warek/poin/{nim}', [WarekPoinController::class, 'show'])->name('warek.poin.detail');
});

// ========================== POIN MAHASISWA WR III ==========================
Route::get('/warek/poin', [WarekPoinController::class, 'index'])->name('warek.poin');

Route::prefix('warek')->name('warek.')->group(function () {
    Route::resource('penentuanpoin', WarekPenentuanPoinController::class);
});


// ========================== WAREK - DATA ORGANISASI ==========================
Route::prefix('warek/dataorganisasi')->name('warek.dataorganisasi.')->group(function() {

    Route::get('/', [WarekOrganisasiController::class, 'index'])->name('index');
    Route::get('/show/{id_organisasi}', [WarekOrganisasiController::class, 'show'])->name('show');
    Route::get('/{id_organisasi}/edit', [WarekOrganisasiController::class, 'edit'])->name('edit');
    Route::put('/{id_organisasi}', [WarekOrganisasiController::class, 'update'])->name('update');
    Route::delete('/{id_organisasi}', [WarekOrganisasiController::class, 'destroy'])->name('destroy');

    // ANGGOTA
    Route::get('/{id_organisasi}/anggota/tambah', [WarekTambahAnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/{id_organisasi}/anggota/tambah', [WarekTambahAnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [WarekTambahAnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [WarekTambahAnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [WarekTambahAnggotaController::class, 'destroy'])->name('anggota.destroy');
});

// ========================== WAREK - DATA KEGIATAN ==========================
Route::prefix('warek/datakegiatan')->name('warek.datakegiatan.')->group(function() {
    Route::get('/', [WarekKegiatanController::class, 'index'])->name('index');
    Route::get('/{id}', [WarekKegiatanController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [WarekKegiatanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [WarekKegiatanController::class, 'update'])->name('update');
    Route::delete('/{id}', [WarekKegiatanController::class, 'destroy'])->name('destroy');

    // TAMBAH ANGGOTA KEGIATAN
    Route::get('{id}/tambah-mahasiswa', [WarekTambahAnggotaKegiatanController::class, 'create'])->name('tambahanggota.create');
    Route::post('{id}/tambah-mahasiswa', [WarekTambahAnggotaKegiatanController::class, 'store'])->name('tambahanggota.store');
    Route::get('{id}/show', [WarekTambahAnggotaKegiatanController::class, 'show'])->name('tambahanggota.show');
    Route::delete('{id}/hapus-mahasiswa/{nim}', [WarekTambahAnggotaKegiatanController::class, 'destroy'])->name('tambahanggota.destroy');
});
    
// ========================== SISTEM SKPI ==========================
Route::prefix('skpi')->group(function () {
    Route::get('/form', [SKPIController::class, 'form'])->name('skpi.form');
    Route::post('/generate', [SKPIController::class, 'generate'])->name('skpi.generate');
    Route::post('/generate-diploma', [SKPIController::class, 'generateDiploma'])->name('skpi.generateDiploma');
    Route::get('/{skpi}/export-pdf', [SKPIController::class, 'exportPdf'])->name('skpi.exportPdf');
});
Route::resource('skpi', SKPIController::class);

// ========================== MAHASISWA CRUD ==========================
Route::get('/mahasiswa/data', [MahasiswaController::class, 'dataMahasiswa'])->name('mahasiswa.data');
Route::resource('mahasiswa', MahasiswaController::class);

// ========================== ORGANISASI CRUD ==========================
Route::resource('organisasi', OrganisasiController::class);
Route::get('/organisasi/{id_organisasi}/anggota/create', [OrganisasiController::class, 'formTambahAnggota'])->name('organisasi.anggota.create');
Route::post('/organisasi/{id_organisasi}/anggota', [OrganisasiController::class, 'simpanAnggota'])->name('organisasi.anggota.store');

// ========================== KEGIATAN CRUD ==========================
Route::resource('kegiatan', KegiatanController::class);
Route::get('/kegiatan/{id}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaForm'])->name('kegiatan.tambahMahasiswaForm');
Route::post('/kegiatan/{id}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaStore'])->name('kegiatan.storeMahasiswa');
Route::delete('/kegiatan/{id}/mahasiswa/{nim}', [KegiatanController::class, 'hapusMahasiswa'])->name('kegiatan.hapusMahasiswa');

// ========================== DETAIL ORGANISASI MAHASISWA ==========================
Route::get('/detail-organisasi', [DetailOrganisasiMahasiswaController::class, 'index'])->name('detail_organisasi_mahasiswa.index');
Route::get('/detail-organisasi-mahasiswa/create/{id}', [DetailOrganisasiMahasiswaController::class, 'create'])->name('detail_organisasi_mahasiswa.create');
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
      Route::get('/edit-anggota/{id}/{nim}', [OrganisasiSelfController::class, 'editAnggota'])->name('edit_anggota');
    Route::put('/update-anggota/{id}/{nim}', [OrganisasiSelfController::class, 'updateAnggota'])->name('update_anggota');
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
    Route::get('/', [KegiatanSelfController::class, 'index'])->name('index');
    Route::get('/create', [KegiatanSelfController::class, 'create'])->name('create');
    Route::post('/store', [KegiatanSelfController::class, 'store'])->name('store');
    Route::get('/{id}', [KegiatanSelfController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [KegiatanSelfController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [KegiatanSelfController::class, 'update'])->name('update');
    Route::delete('/{id}', [KegiatanSelfController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/add-mahasiswa', [KegiatanSelfController::class, 'addMahasiswa'])->name('addMahasiswa');
    Route::post('/{id}/store-mahasiswa', [KegiatanSelfController::class, 'storeMahasiswa'])->name('storeMahasiswa');
    Route::delete('/{id}/mahasiswa/{nim}', [KegiatanSelfController::class, 'destroyMahasiswa'])->name('destroyMahasiswa');
});

// ========================== API DASHBOARD ADMIN ==========================


Route::get('/api/admin/dashboard/statistik', [DashboardAdminController::class, 'statistik'])
    ->name('admin.dashboard.statistik');
