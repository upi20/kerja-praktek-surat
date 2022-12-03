<?php

use App\Http\Controllers\App\Desa\DashboardController;
use App\Http\Controllers\App\Desa\Penduduk\PendudukMasukController;
use Illuminate\Support\Facades\Route;

$name = 'desa';
Route::get("/", [DashboardController::class, 'index'])
    ->name("$name.home")
    ->middleware("permission:$name.home");

$prefix = 'penduduk';
Route::prefix($prefix)->group(function () use ($name, $prefix) {
    $name = "$name.$prefix"; // desa.penduduk

    $prefix = 'masuk';
    Route::controller(PendudukMasukController::class)->prefix($prefix)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // desa.penduduk.masuk
        Route::get('/', 'index')->name($name)->middleware("permission:$name");
        Route::post('/', 'insert')->name("$name.insert")->middleware("permission:$name.insert");
        Route::delete('/{model}', 'delete')->name("$name.delete")->middleware("permission:$name.delete");
        Route::get('/find', 'find')->name("$name.find")->middleware("permission:$name.update");
        Route::get('/find_by_nik', 'find_by_nik')->name("$name.find_by_nik")->middleware("permission:$name");
        Route::post('/update', 'update')->name("$name.update")->middleware("permission:$name.update");
    });
});
