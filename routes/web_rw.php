<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\Rw\DashboardController;
use App\Http\Controllers\App\Rw\Surat\ProsesSuratController;

$name = 'rw';
Route::get("/", [DashboardController::class, 'index'])
    ->name("$name.home")
    ->middleware("permission:$name.home");


$prefix = 'surat';
Route::prefix($prefix)->group(function () use ($name, $prefix) {
    $name = "$name.$prefix"; // rw.surat

    $prefix = 'proses';
    Route::prefix($prefix)->controller(ProsesSuratController::class)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // rw.surat.proses
        Route::get('/', 'index')->name($name)->middleware("permission:$name");
        Route::post('/simpan', 'simpan')->name("$name.simpan")->middleware("permission:$name");
    });
});
