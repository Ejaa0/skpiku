<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\SKPIController;
use App\Http\Controllers\DetailOrganisasiMahasiswaController;
use App\Http\Controllers\PoinMahasiswaController;
use Illuminate\Support\Facades\DB;

// ======================== KONFIG DEFAULT ADMIN ========================
$defaultAdminEmail = 'rezaivander12@gmail.com';
$defaultAdminPasswordHash = password_hash('rahasia123', PASSWORD_DEFAULT);

// ======================== HALAMAN UTAMA ========================
Route::get('/', fn () => view('dashboard'))->name('beranda');

// ======================== LOGIN MAHASISWA (Dummy) ========================
Route::get('/login/mahasiswa', fn () => view('mahasiswa.login'))->name('mahasiswa.login');

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
Route::get('/mahasiswa/data', [MahasiswaController::class, 'dataMahasiswa'])->name('mahasiswa.data');

Route::get('/mahasiswa/data_kegiatan', function () {
    return view('kegiatan.data_kegiatan');
})->name('mahasiswa.data_kegiatan');

// ======================== RESOURCE CONTROLLERS ========================
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('poin', PoinMahasiswaController::class);

// ======================== ORGANISASI ROUTES ========================
// Perhatikan: Buat route manual untuk create & store supaya tidak bentrok dengan method create yang lain

Route::get('/organisasi/create', [OrganisasiController::class, 'createOrganisasi'])->name('organisasi.create');
Route::post('/organisasi', [OrganisasiController::class, 'storeOrganisasi'])->name('organisasi.store');

// Resource route tanpa create dan store karena sudah dihandle manual di atas
Route::resource('organisasi', OrganisasiController::class)->except(['create', 'store']);

// ======================== DETAIL ORGANISASI MAHASISWA ROUTES ========================
// Resource controller kecuali create dan store, karena akan kita buat manual
Route::resource('detail_organisasi_mahasiswa', DetailOrganisasiMahasiswaController::class)->except(['create', 'store']);

// Route create dengan parameter id_organisasi (untuk tambah anggota organisasi)
Route::get('/detail_organisasi_mahasiswa/create/{id_organisasi}', [DetailOrganisasiMahasiswaController::class, 'create'])
    ->name('detail_organisasi_mahasiswa.create');

// Route store manual untuk simpan data anggota organisasi
Route::post('/detail_organisasi_mahasiswa/store', [DetailOrganisasiMahasiswaController::class, 'store'])
    ->name('detail_organisasi_mahasiswa.store');

// ======================== Kegiatan tambah dan hapus mahasiswa ========================
Route::get('/kegiatan/{id_kegiatan}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaForm'])->name('kegiatan.tambahMahasiswaForm');
Route::post('/kegiatan/{id_kegiatan}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaStore'])->name('kegiatan.storeMahasiswa');
Route::delete('/kegiatan/{id_kegiatan}/mahasiswa/{nim}', [KegiatanController::class, 'hapusMahasiswa'])->name('kegiatan.hapusMahasiswa');
Route::get('detail_organisasi_mahasiswa/create/{id_organisasi}', [DetailOrganisasiMahasiswaController::class, 'create'])->name('detail_organisasi_mahasiswa.create');
Route::get('/organisasi/{id}/tambah-anggota', [OrganisasiController::class, 'formTambahAnggota'])->name('organisasi.tambahAnggota');
Route::post('/organisasi/tambah-anggota', [OrganisasiController::class, 'simpanAnggota'])->name('organisasi.simpanAnggota');
Route::get('detail_organisasi_mahasiswa/create/{id_organisasi}', [DetailOrganisasiMahasiswaController::class, 'create'])->name('detail_organisasi_mahasiswa.create');


// ======================== CEK RELASI ========================
Route::get('/cek-relasi', function () {
    $data = DB::table('detail_kegiatan_mahasiswa')
        ->join('mahasiswas', 'detail_kegiatan_mahasiswa.mahasiswa_nim', '=', 'mahasiswas.nim')
        ->join('kegiatans', 'detail_kegiatan_mahasiswa.kegiatan_id_ref', '=', 'kegiatans.id_kegiatan')
        ->select('mahasiswas.nama', 'kegiatans.nama_kegiatan')
        ->get();

    return $data;
});

// ======================== DETAIL ORGANISASI VIEW & DELETE ========================

// View detail organisasi mahasiswa dengan join
Route::get('/detail-organisasi', function () {
    $data = DB::table('detail_organisasi_mahasiswa')
        ->join('mahasiswas', 'detail_organisasi_mahasiswa.mahasiswa_nim', '=', 'mahasiswas.nim')
        ->join('organisasis', 'detail_organisasi_mahasiswa.id_organisasi', '=', 'organisasis.id_organisasi')
        ->select('detail_organisasi_mahasiswa.id', 'mahasiswas.nama', 'organisasis.nama_organisasi', 'detail_organisasi_mahasiswa.jabatan', 'detail_organisasi_mahasiswa.status_keanggotaan')
        ->get();

    return view('detail_organisasi_mahasiswa.index', compact('data'));
})->name('detail_organisasi_mahasiswa.index');

// Delete detail organisasi mahasiswa by id
Route::delete('/detail-organisasi/{id}', function ($id) {
    DB::table('detail_organisasi_mahasiswa')->where('id', $id)->delete();
    return redirect()->route('detail_organisasi_mahasiswa.index')->with('success', 'Data berhasil dihapus.');
})->name('detail_organisasi_mahasiswa.destroy');

