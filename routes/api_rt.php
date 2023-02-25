<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Rt\Surat\ProsesController;

$name = 'api.rt';
// proses surat
$prefix = 'surat';
Route::prefix($prefix)->group(function () {
    $prefix = 'proses';
    Route::prefix($prefix)->controller(ProsesController::class)->group(function () {
        // api.rt.proses
        Route::get('/', 'list_surat');
        Route::post('setujui', 'setujui');
        Route::post('tolak', 'tolak');
        Route::get('detail', 'detail');
        Route::get('detail/pelacakan', 'pelacakan');
        Route::get('download', 'download');
    });
});
