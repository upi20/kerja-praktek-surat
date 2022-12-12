<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UtilityController;

// utility
Route::prefix('utility')->controller(UtilityController::class)->group(function () {
    Route::get('/get_penduduk_by_nik', 'getPendudukByNik');
});
