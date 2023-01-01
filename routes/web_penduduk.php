<?php

use App\Http\Controllers\App\Admin\PendudukController;
use App\Http\Controllers\App\Penduduk\DashboardController;
use Illuminate\Support\Facades\Route;

// Surat ==============================================================================================================
use App\Http\Controllers\App\Penduduk\PengajuanSuratController;
use App\Http\Controllers\App\Penduduk\Surat\TrackingController;
use App\Http\Controllers\App\Penduduk\Surat\DomisiliController;
use App\Http\Controllers\App\Penduduk\Surat\KeteranganController;
use App\Http\Controllers\App\Penduduk\Surat\NikahController;
use App\Http\Controllers\App\Penduduk\Surat\KelahiranController;

$name = 'penduduk';
Route::get("/", [DashboardController::class, 'index'])
    ->name("$name.home")
    ->middleware("permission:$name.home");

$prefix = 'surat';
Route::prefix($prefix)->group(function () use ($name, $prefix) {
    $name = "$name.$prefix"; // penduduk.surat
    Route::get('/', [PengajuanSuratController::class, 'index'])->name("$name");

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

    $prefix = 'domisili';
    Route::prefix($prefix)->controller(DomisiliController::class)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // penduduk.surat.domisili
        Route::get('/', 'index')->name($name)->middleware("permission:$name");
        Route::post('/simpan', 'simpan')->name("$name.simpan")->middleware("permission:$name");
        Route::post('/perbaiki_simpan', 'perbaiki_simpan')->name("$name.perbaiki_simpan")->middleware("permission:$name");
        Route::get('/detail/{surat}', 'detail')->name("$name.detail")->middleware("permission:$name");
        Route::get('/print/{surat}', 'print')->name("$name.print")->middleware("permission:$name");
        Route::get('/perbaiki/{surat}', 'perbaiki')->name("$name.perbaiki")->middleware("permission:$name");
    });

    $prefix = 'nikah';
    Route::prefix($prefix)->controller(NikahController::class)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // penduduk.surat.nikah
        Route::get('/', 'index')->name($name)->middleware("permission:$name");
        Route::post('/simpan', 'simpan')->name("$name.simpan")->middleware("permission:$name");
        Route::post('/perbaiki_simpan', 'perbaiki_simpan')->name("$name.perbaiki_simpan")->middleware("permission:$name");
        Route::get('/detail/{surat}', 'detail')->name("$name.detail")->middleware("permission:$name");
        Route::get('/print/{surat}', 'print')->name("$name.print")->middleware("permission:$name");
        Route::get('/perbaiki/{surat}', 'perbaiki')->name("$name.perbaiki")->middleware("permission:$name");
    });

    $prefix = 'kelahiran';
    Route::prefix($prefix)->controller(KelahiranController::class)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // penduduk.surat.kelahiran
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

Route::get('cari_penduduk', [PendudukController::class, 'cari_penduduk'])->name("$name.cari_penduduk");
