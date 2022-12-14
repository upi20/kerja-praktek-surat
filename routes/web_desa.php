<?php

use App\Http\Controllers\App\Desa\DashboardController;
use App\Http\Controllers\App\Desa\Surat\ProsesSuratController;
use Illuminate\Support\Facades\Route;

$name = 'desa';
Route::get("/", [DashboardController::class, 'index'])
    ->name("$name.home")
    ->middleware("permission:$name.home");

$prefix = 'surat';
Route::prefix($prefix)->group(function () use ($name, $prefix) {
    $name = "$name.$prefix"; // desa.surat

    $prefix = 'proses';
    Route::prefix($prefix)->controller(ProsesSuratController::class)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // desa.surat.proses
        Route::get('/', 'index')->name($name)->middleware("permission:$name");
        Route::post('/simpan', 'simpan')->name("$name.simpan")->middleware("permission:$name");
        Route::get('/pegawai', 'pegawai_select2')->name("$name.pegawai")->middleware("permission:$name");
        Route::post('/selesai', 'selesai')->name("$name.selesai")->middleware("permission:$name");
        Route::post('/serahkan', 'serahkan')->name("$name.serahkan")->middleware("permission:$name");
    });
});
