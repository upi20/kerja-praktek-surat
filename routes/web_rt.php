<?php

use App\Http\Controllers\App\Rt\DashboardController;
use App\Http\Controllers\App\Rt\Surat\ProsesSuratController;
use Illuminate\Support\Facades\Route;

$name = 'rt';
Route::get("/", [DashboardController::class, 'index'])
    ->name("$name.home")
    ->middleware("permission:$name.home");

$prefix = 'surat';
Route::prefix($prefix)->group(function () use ($name, $prefix) {
    $name = "$name.$prefix"; // rt.surat

    $prefix = 'proses';
    Route::prefix($prefix)->controller(ProsesSuratController::class)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // rt.surat.proses
        Route::get('/', 'index')->name($name)->middleware("permission:$name");
        Route::post('/simpan', 'simpan')->name("$name.simpan")->middleware("permission:$name");
    });
});
