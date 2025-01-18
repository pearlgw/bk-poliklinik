<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\DokterRoleController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\KonsultasiDokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PasienRoleController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:mengelola dokter')->group(function () {
        Route::get('/dokter', [DokterController::class, 'index'])->name('dokter');
        Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
        Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
        Route::get('/dokter/{id}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
        Route::patch('/dokter/{id}', [DokterController::class, 'update'])->name('dokter.update');
        Route::delete('/dokter/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');
    });
    Route::middleware('can:mengelola pasien')->group(function () {
        Route::get('/pasien', [PasienController::class, 'index'])->name('pasien');
        Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
        Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
        Route::get('/pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
        Route::patch('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
        Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
    });
    Route::middleware('can:mengelola poli')->group(function () {
        Route::get('/poli', [PoliController::class, 'index'])->name('poli');
        Route::get('/poli/create', [PoliController::class, 'create'])->name('poli.create');
        Route::post('/poli', [PoliController::class, 'store'])->name('poli.store');
        Route::get('/poli/{id}/edit', [PoliController::class, 'edit'])->name('poli.edit');
        Route::patch('/poli/{id}', [PoliController::class, 'update'])->name('poli.update');
        Route::delete('/poli/{id}', [PoliController::class, 'destroy'])->name('poli.destroy');
    });
    Route::middleware('can:mengelola obat')->group(function () {
        Route::get('/obat', [ObatController::class, 'index'])->name('obat');
        Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
        Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
        Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
        Route::patch('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
        Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
    });

    Route::middleware('can:memperbarui data dokter')->group(function () {
        Route::get('/data-dokter', [DokterRoleController::class, 'index'])->name('dokter.index');
        Route::get('/data-dokter/{id}/edit', [DokterRoleController::class, 'edit']);
        Route::patch('/data-dokter/{id}', [DokterRoleController::class, 'update']);
    });
    
    Route::middleware('can:input jadwal periksa')->group(function () {
        Route::get('/jadwal-periksa', [DokterRoleController::class, 'jadwalPeriksaIndex'])->name('dokter.jadwal_periksa');
        Route::get('/jadwal-periksa/create', [DokterRoleController::class, 'jadwalPeriksaCreate'])->name('dokter.jadwal_periksa.create');
        Route::post('/jadwal-periksa', [DokterRoleController::class, 'jadwalPeriksaStore'])->name('dokter.jadwal_periksa.store');
        Route::patch('/jadwal-periksa/{id}/aktif', [DokterRoleController::class, 'jadwalPeriksaUpdateAktif']);
        Route::patch('/jadwal-periksa/{id}/non-aktif', [DokterRoleController::class, 'jadwalPeriksaUpdateNonAktif']);
    });

    Route::middleware('can:mendaftar poli')->group(function () {
        Route::get('/daftar-poli', [PasienRoleController::class, 'daftarPoliIndex'])->name('pasien.daftarPoli');
        Route::post('/daftar-poli', [PasienRoleController::class, 'daftarPoliStore'])->name('pasien.daftarPoli.store');
    });

    Route::middleware('can:memeriksa pasien')->group(function () {
        Route::get('/daftar-pasien', [DokterRoleController::class, 'daftarPasienIndex'])->name('dokter.daftarPasien');
        Route::get('/daftar-pasien/{id}', [DokterRoleController::class, 'daftarPasienCreate'])->name('dokter.daftarPasien.create');
        Route::post('/daftar-pasien', [DokterRoleController::class, 'daftarPasienStore'])->name('dokter.daftarPasien.store');
    });

    Route::middleware('can:menampilkan riwayat pasien')->group(function () {
        Route::get('/riwayat-pasien', [DokterRoleController::class, 'riwayatPasien'])->name('dokter.riwayatPasien');
    });
    
    Route::middleware('can:konsultasi pasien')->group(function () {
        Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.pasien');
        Route::get('/konsultasi/{id}/chat', [KonsultasiController::class, 'getChat']);
        Route::post('/konsultasi/{id}', [KonsultasiController::class, 'postChat']);
        Route::get('/konsultasi/{id}/edit', [KonsultasiController::class, 'getEdit']);
        Route::patch('/konsultasi/{id}', [KonsultasiController::class, 'patchChat']);
        Route::delete('/konsultasi/{id}', [KonsultasiController::class, 'deleteChat']);
    });
    
    Route::middleware('can:konsultasi dokter')->group(function () {
        Route::get('/konsultasi-pasien', [KonsultasiDokterController::class, 'index'])->name('konsultasi.dokter');
        Route::get('/konsultasi-pasien/{id}/tanggapan', [KonsultasiDokterController::class, 'create']);
        Route::patch('/konsultasi-pasien/{id}', [KonsultasiDokterController::class, 'update']);
        Route::get('/konsultasi-pasien/{id}/edit', [KonsultasiDokterController::class, 'edit']);
    });
});

require __DIR__ . '/auth.php';
