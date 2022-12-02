<?php

use App\Http\Controllers\App\Rw\DashboardController;
use Illuminate\Support\Facades\Route;

$name = 'rw';
Route::get("/", [DashboardController::class, 'index'])
    ->name("$name.home")
    ->middleware("permission:$name.home");
