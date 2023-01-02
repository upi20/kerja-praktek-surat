<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UtilityController;

use App\Http\Controllers\API\Penduduk\Surat\TrackingController;
use App\Http\Controllers\API\Penduduk\Surat\KeteranganController;
use App\Http\Controllers\API\Penduduk\Surat\DomisiliController;

$name = 'api.penduduk';
// utility
Route::prefix('utility')->controller(UtilityController::class)->group(function () {
    Route::get('/get_penduduk_by_nik', 'getPendudukByNik');
});
$prefix = 'surat';
Route::prefix($prefix)->group(function () {
    $prefix = 'pelacakan';
    Route::prefix($prefix)->controller(TrackingController::class)->group(function () {
        // api.penduduk.pelacakan
        Route::get('/', 'list_surat');
        Route::get('detail', 'detail');
    });
    Route::post('/batalkan', [TrackingController::class, 'batalkan']);

    $prefix = 'keterangan';
    Route::prefix($prefix)->controller(KeteranganController::class)->group(function () {
        // api.penduduk.surat.keterangan
        Route::get('/jenis', 'jenis');
        Route::get('/detail', 'detail');
        Route::get('/download', 'download');
        Route::post('/simpan', 'simpan');
        Route::post('/perbaiki', 'perbaiki');
    });

    $prefix = 'domisili';
    Route::prefix($prefix)->controller(DomisiliController::class)->group(function () {
        // api.penduduk.surat.domisili
        Route::get('/jenis', 'jenis');
        Route::get('/detail', 'detail');
        Route::get('/download', 'download');
        Route::post('/simpan', 'simpan');
        Route::post('/perbaiki', 'perbaiki');
    });
});
