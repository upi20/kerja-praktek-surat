<?php

use App\Http\Controllers\API\Penduduk\Surat\TrackingController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UtilityController;

$name = 'api.penduduk';
// utility
Route::prefix('utility')->controller(UtilityController::class)->group(function () {
    Route::get('/get_penduduk_by_nik', 'getPendudukByNik');
});
$prefix = 'surat';
Route::prefix($prefix)->group(function () {
    $prefix = 'pelacakan';
    Route::prefix($prefix)->controller(TrackingController::class)->group(function () {
        Route::get('/', 'list_surat');
        Route::get('detail', 'detail');
    });
    Route::post('/batalkan', [TrackingController::class, 'batalkan']);
});
