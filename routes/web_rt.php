<?php

use App\Http\Controllers\App\Rt\DashboardController;
use Illuminate\Support\Facades\Route;

$name = 'rt';
Route::get("/", [DashboardController::class, 'index'])
    ->name("$name.home")
    ->middleware("permission:$name.home");
