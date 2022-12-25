<?php

use App\Http\Controllers\App\Admin\PendudukController;
use App\Http\Controllers\App\Penduduk\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\Penduduk\PengajuanSuratController;

// Surat ==============================================================================================================
use App\Http\Controllers\App\Penduduk\Surat\KeteranganController;
use App\Http\Controllers\App\Penduduk\Surat\TrackingController;

$name = 'penduduk';
Route::get("/", [DashboardController::class, 'index'])
    ->name("$name.home")
    ->middleware("permission:$name.home");

$prefix = 'surat';
Route::prefix($prefix)->group(function () use ($name, $prefix) {
    $name = "$name.$prefix"; // penduduk.surat

    $prefix = 'keterangan';
    Route::prefix($prefix)->controller(KeteranganController::class)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // penduduk.surat.keterangan
        Route::get('/', 'index')->name($name)->middleware("permission:$name");
        Route::post('/simpan', 'simpan')->name("$name.simpan")->middleware("permission:$name");
        Route::post('/perbaiki_simpan', 'perbaiki_simpan')->name("$name.perbaiki_simpan")->middleware("permission:$name");
        Route::get('/detail/{surat}', 'detail')->name("$name.detail")->middleware("permission:$name");
        Route::get('/print/{surat}', 'print')->name("$name.print")->middleware("permission:$name");
        Route::get('/perbaiki/{surat}', 'perbaiki')->name("$name.perbaiki")->middleware("permission:$name");
    });
});

$prefix = 'pelacakan';
Route::prefix($prefix)->controller(TrackingController::class)->group(function () use ($name, $prefix) {
    $name = "$name.$prefix"; // penduduk.pelacakan
    Route::get('/', 'index')->name($name)->middleware("permission:$name");
    Route::get('list_tracking', 'list_tracking_api')->name("$name.list_tracking_api")->middleware("permission:$name");
    Route::get('list_tracking/{surat}', 'list_tracking')->name("$name.list_tracking")->middleware("permission:$name");
    Route::post('batalkan_surat', 'batalkan_surat')->name("$name.batalkan_surat")->middleware("permission:$name");
});

// tidak di pakai jika sudah selesai maka hapus saja
$prefix = 'pengajuan';
Route::prefix($prefix)->controller(PengajuanSuratController::class)->group(function () use ($name, $prefix) {
    $name = "$name.$prefix"; // penduduk.pengajuan
    Route::get('/', 'index')->name("$name");







    Route::get('keterangan', 'keterangan')->name("$name.keterangan");
    Route::get('kelahiran', 'kelahiran')->name("$name.kelahiran");
    Route::get('domisili', 'domisili')->name("$name.domisili");
    Route::get('kartu_keluarga', 'kartu_keluarga')->name("$name.kartu_keluarga");
    Route::get('pindah', 'pindah')->name("$name.pindah");
    Route::get('nikah', 'nikah')->name("$name.nikah");
    Route::get('kematian', 'kematian')->name("$name.kematian");


    // cari warga berdasarkan nik
    Route::get('cari_penduduk', 'cari_penduduk')->name("$name.cari_penduduk");
});

Route::get('cari_penduduk', [PendudukController::class, 'cari_penduduk'])->name("$name.cari_penduduk");
