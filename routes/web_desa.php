<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;

$name = 'desa';
Route::get('/dashboard', [DashboardController::class, 'index'])->name("$name.dashboard")->middleware("permission:$name.dashboard");
