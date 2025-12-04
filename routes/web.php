<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
Route::post('/logout', function() {
    session()->flush();
    return redirect()->route('login');
})->name('logout');

Route::post('/warek/logout', function() {
    session()->flush();
    return redirect()->route('login');
})->name('logout.warek');

// ========================== DASHBOARD SESUAI ROLE ==========================
Route::middleware(['web'])->group(function () {

    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

    Route::get('/warek/dashboard', function() {
        if (!session('is_logged_in') || session('user_role') !== 'warek') {
            return redirect()->route('login');
        }

        $totalOrganisasi = Organisasi::count();
        $totalKegiatan   = Kegiatan::count();

        return view('warek.dashboard', compact('totalOrganisasi', 'totalKegiatan'));
    })->name('warek.dashboard');

    Route::get('/mahasiswa/dashboard', function() {
        if (!session('is_logged_in') || session('user_role') !== 'mahasiswa') {
            return redirect()->route('login');
        }

        return view('mahasiswa.dashboard', [
            'mahasiswa' => [
                'nim'   => '1234567890',
                'email' => session('user_email'),
                'nama'  => session('user_name'),
            ]
        ]);
    })->name('mahasiswa.dashboard');

    Route::get('/organisasi/dashboard', [OrganisasiDashboardController::class, 'index'])
        ->name('organisasi.dashboard');
});

// ========================== POIN MAHASISWA WR III ==========================
Route::get('/warek/poin', [WarekPoinController::class, 'index'])
    ->name('warek.poin');

// ========================== WR III DATA ORGANISASI ==========================
// LIST ORGANISASI
Route::get('/warek/dataorganisasi', [WarekOrganisasiController::class, 'index'])
    ->name('warek.dataorganisasi.index');

// SHOW DETAIL ORGANISASI
Route::get('/warek/dataorganisasi/show/{id_organisasi}', [WarekOrganisasiController::class, 'show'])
    ->name('warek.dataorganisasi.show');

// FORM EDIT ORGANISASI
Route::get('/warek/dataorganisasi/{id_organisasi}/edit', [WarekOrganisasiController::class, 'edit'])
    ->name('warek.dataorganisasi.edit');

// UPDATE ORGANISASI
Route::put('/warek/dataorganisasi/{id_organisasi}', [WarekOrganisasiController::class, 'update'])
    ->name('warek.dataorganisasi.update');

// DELETE ORGANISASI
Route::delete('/warek/dataorganisasi/{id_organisasi}', [WarekOrganisasiController::class, 'destroy'])
    ->name('warek.dataorganisasi.destroy');

// ========================== ANGGOTA ORGANISASI WR III ==========================
// TAMBAH ANGGOTA ORGANISASI
Route::get('/warek/dataorganisasi/{id_organisasi}/add', [DetailOrganisasiMahasiswaController::class, 'create'])
    ->name('warek.dataorganisasi.anggota.create');

Route::post('/warek/dataorganisasi/{id_organisasi}/add', [DetailOrganisasiMahasiswaController::class, 'store'])
    ->name('warek.dataorganisasi.anggota.store');

Route::get('/warek/dataorganisasi/anggota/{id}/edit', [DetailOrganisasiMahasiswaController::class, 'edit'])
    ->name('warek.dataorganisasi.anggota.edit');

Route::put('/warek/dataorganisasi/anggota/{id}', [DetailOrganisasiMahasiswaController::class, 'update'])
    ->name('warek.dataorganisasi.anggota.update');

Route::delete('/warek/dataorganisasi/anggota/{id}', [DetailOrganisasiMahasiswaController::class, 'destroy'])
    ->name('warek.dataorganisasi.anggota.destroy');

// ========================== SKPI ==========================
Route::prefix('skpi')->group(function () {
    Route::get('/form', [SKPIController::class, 'form'])->name('skpi.form');
    Route::post('/generate', [SKPIController::class, 'generate'])->name('skpi.generate');
    Route::post('/generate-diploma', [SKPIController::class, 'generateDiploma'])->name('skpi.generateDiploma');
    Route::get('/{skpi}/export-pdf', [SKPIController::class, 'exportPdf'])->name('skpi.exportPdf');
});
Route::resource('skpi', SKPIController::class);

// ========================== MAHASISWA ==========================
Route::get('/mahasiswa/data', [MahasiswaController::class, 'dataMahasiswa'])
    ->name('mahasiswa.data');

Route::resource('mahasiswa', MahasiswaController::class);

// ========================== ORGANISASI ==========================
Route::resource('organisasi', OrganisasiController::class);

Route::get('/organisasi/{id_organisasi}/anggota/create', [OrganisasiController::class, 'formTambahAnggota'])
    ->name('organisasi.anggota.create');

Route::post('/organisasi/{id_organisasi}/anggota', [OrganisasiController::class, 'simpanAnggota'])
    ->name('organisasi.anggota.store');

// ========================== KEGIATAN ==========================
Route::resource('kegiatan', KegiatanController::class);

Route::get('/kegiatan/{id}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaForm'])
    ->name('kegiatan.tambahMahasiswaForm');

Route::post('/kegiatan/{id}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaStore'])
    ->name('kegiatan.storeMahasiswa');

Route::delete('/kegiatan/{id}/mahasiswa/{nim}', [KegiatanController::class, 'hapusMahasiswa'])
    ->name('kegiatan.hapusMahasiswa');

// ========================== DETAIL ORGANISASI MAHASISWA ==========================
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

// ========================== ORGANISASI SELF ==========================
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
});
