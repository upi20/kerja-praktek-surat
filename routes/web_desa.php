<?php

use App\Http\Controllers\App\Desa\DashboardController;
use Illuminate\Support\Facades\Route;

$name = 'desa';
Route::get("/", [DashboardController::class, 'index'])
    ->name("$name.home")
    ->middleware("permission:$name.home");
