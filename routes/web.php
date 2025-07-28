<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\SKPIController;
use App\Http\Controllers\DetailOrganisasiMahasiswaController;
use App\Http\Controllers\PoinMahasiswaController;

// ========================== Default Admin ==========================
$defaultAdminEmail = 'rezaivander12@gmail.com';
$defaultAdminPasswordHash = password_hash('rahasia123', PASSWORD_DEFAULT);

// ========================== Halaman Utama ==========================
Route::get('/', fn () => view('dashboard'))->name('beranda');

// ========================== Login Mahasiswa ==========================
Route::prefix('login/mahasiswa')->group(function () {
    Route::get('/', fn () => view('mahasiswa.login'))->name('mahasiswa.login');

    Route::post('/', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

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
        if (!session('is_mahasiswa_logged_in')) {
            return redirect()->route('mahasiswa.login');
        }
        return view('mahasiswa.dashboard', [
            'mahasiswa' => [
                'nim' => session('mahasiswa_nim'),
                'email' => session('mahasiswa_email'),
                'nama' => session('mahasiswa_nama'),
            ],
        ]);
    })->name('mahasiswa.dashboard');

    Route::post('/logout/mahasiswa', function () {
        session()->forget([
            'is_mahasiswa_logged_in',
            'mahasiswa_nim',
            'mahasiswa_email',
            'mahasiswa_nama',
        ]);
        return redirect()->route('mahasiswa.login');
    })->name('logout.mahasiswa');
});

// ========================== Login Admin ==========================
Route::prefix('login/admin')->group(function () use ($defaultAdminEmail, $defaultAdminPasswordHash) {
    Route::get('/', fn () => view('admin.login'))->name('admin.login');

    Route::post('/', function (Request $request) use ($defaultAdminEmail, $defaultAdminPasswordHash) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === $defaultAdminEmail && password_verify($request->password, $defaultAdminPasswordHash)) {
            session([
                'is_admin_logged_in' => true,
                'admin_email' => $request->email,
                'admin_name' => 'Admin Sistem',
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    })->name('admin.login.submit');
});

Route::get('/admin/dashboard', function () {
    if (!session('is_admin_logged_in')) {
        return redirect()->route('admin.login');
    }
    return view('admin.dashboard');
})->name('admin.dashboard');

// ========================== Login Organisasi ==========================
Route::prefix('login/organisasi')->group(function () {
    Route::get('/', fn () => view('organisasi.login'))->name('organisasi.login');

    Route::post('/', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === 'organisasi@unai.ac.id' && $request->password === 'org123') {
            session(['is_org_logged_in' => true]);
            return redirect()->route('organisasi.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    })->name('organisasi.login.submit');
});

Route::get('/organisasi/dashboard', function () {
    if (!session('is_org_logged_in')) {
        return redirect()->route('organisasi.login');
    }
    return view('organisasi.dashboard_organisasi');
})->name('organisasi.dashboard');

// ========================== Login Warek ==========================
Route::prefix('login/warek')->group(function () {
    Route::get('/', fn () => view('warek.login'))->name('warek.login');

    Route::post('/', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === 'warek@unai.ac.id' && $request->password === 'warek123') {
            session(['is_warek_logged_in' => true]);
            return redirect()->route('warek.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    })->name('warek.login.submit');
});

Route::get('/warek/dashboard', function () {
    if (!session('is_warek_logged_in')) {
        return redirect()->route('warek.login');
    }
    return view('warek.dashboard_warek');
})->name('warek.dashboard');

// ========================== Logout ==========================
Route::post('/logout/warek', function () {
    session()->forget('is_warek_logged_in');
    return redirect()->route('warek.login');
})->name('logout.warek');

Route::post('/logout', function () {
    session()->flush();
    return redirect()->route('admin.login');
})->name('logout');

// ========================== SKPI Routes ==========================
Route::prefix('skpi')->group(function () {
    Route::get('/form', [SKPIController::class, 'form'])->name('skpi.form');
    Route::post('/generate', [SKPIController::class, 'generate'])->name('skpi.generate');
    Route::post('/generate-diploma', [SKPIController::class, 'generateDiploma'])->name('skpi.generateDiploma');
    Route::get('/{skpi}/export-pdf', [SKPIController::class, 'exportPdf'])->name('skpi.exportPdf');
});
Route::resource('skpi', SKPIController::class);

// ========================== Mahasiswa Routes ==========================
Route::get('/mahasiswa/data', [MahasiswaController::class, 'dataMahasiswa'])->name('mahasiswa.data');
Route::get('/mahasiswa/data_kegiatan', fn () => view('kegiatan.data_kegiatan'))->name('mahasiswa.data_kegiatan');
Route::resource('mahasiswa', MahasiswaController::class);

// ========================== Organisasi Routes ==========================
Route::resource('organisasi', OrganisasiController::class)->except(['create', 'store', 'show']);
Route::get('/organisasi/create', [OrganisasiController::class, 'create'])->name('organisasi.create');
Route::post('/organisasi', [OrganisasiController::class, 'store'])->name('organisasi.store');
Route::get('/organisasi/{id_organisasi}', [OrganisasiController::class, 'show'])->name('organisasi.show');
Route::get('/organisasi/{id_organisasi}/anggota/create', [OrganisasiController::class, 'formTambahAnggota'])->name('organisasi.anggota.create');
Route::post('/organisasi/{id_organisasi}/anggota', [OrganisasiController::class, 'simpanAnggota'])->name('organisasi.anggota.store');

// ========================== Kegiatan Routes ==========================
Route::resource('kegiatan', KegiatanController::class);
Route::get('/kegiatan/{id_kegiatan}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaForm'])->name('kegiatan.tambahMahasiswaForm');
Route::post('/kegiatan/{id_kegiatan}/tambah-mahasiswa', [KegiatanController::class, 'tambahMahasiswaStore'])->name('kegiatan.storeMahasiswa');
Route::delete('/kegiatan/{id_kegiatan}/mahasiswa/{nim}', [KegiatanController::class, 'hapusMahasiswa'])->name('kegiatan.hapusMahasiswa');

// ========================== Detail Organisasi Mahasiswa Routes ==========================
Route::get('/detail-organisasi', function () {
    $data = DB::table('detail_organisasi_mahasiswa')
        ->join('mahasiswas', 'detail_organisasi_mahasiswa.mahasiswa_nim', '=', 'mahasiswas.nim')
        ->join('organisasis', 'detail_organisasi_mahasiswa.id_organisasi', '=', 'organisasis.id_organisasi')
        ->select(
            'detail_organisasi_mahasiswa.id',
            'mahasiswas.nama',
            'organisasis.nama_organisasi',
            'detail_organisasi_mahasiswa.jabatan',
            'detail_organisasi_mahasiswa.status_keanggotaan'
        )
        ->get();

    return view('detail_organisasi_mahasiswa.index', compact('data'));
})->name('detail_organisasi_mahasiswa.index');

Route::delete('/detail-organisasi/{id}', function ($id) {
    DB::table('detail_organisasi_mahasiswa')->where('id', $id)->delete();
    return redirect()->route('detail_organisasi_mahasiswa.index')->with('success', 'Data berhasil dihapus.');
})->name('detail_organisasi_mahasiswa.destroy');

Route::get('/detail_organisasi_mahasiswa/create/{id_organisasi}', [DetailOrganisasiMahasiswaController::class, 'create'])->name('detail_organisasi_mahasiswa.create');
Route::post('/detail_organisasi_mahasiswa/store', [DetailOrganisasiMahasiswaController::class, 'store'])->name('detail_organisasi_mahasiswa.store');
Route::resource('detail_organisasi_mahasiswa', DetailOrganisasiMahasiswaController::class)->except(['create', 'store']);

// ========================== Poin Mahasiswa Routes ==========================
Route::resource('poin', PoinMahasiswaController::class);

// ========================== Debug: Cek Relasi ==========================
Route::get('/cek-relasi', function () {
    return DB::table('detail_kegiatan_mahasiswa')
        ->join('mahasiswas', 'detail_kegiatan_mahasiswa.mahasiswa_nim', '=', 'mahasiswas.nim')
        ->join('kegiatans', 'detail_kegiatan_mahasiswa.id_kegiatan', '=', 'kegiatans.id')
        ->select('detail_kegiatan_mahasiswa.*', 'mahasiswas.nama', 'kegiatans.nama_kegiatan')
        ->get();
})->name('cek-relasi');

// ========================== Poin Additional Routes ==========================
Route::get('/poin/create', [PoinMahasiswaController::class, 'create'])->name('poin.create');
Route::post('/poin/store', [PoinMahasiswaController::class, 'store'])->name('poin.store');
Route::get('/poin/latest/all', [PoinMahasiswaController::class, 'getAllLatestPoin']);
