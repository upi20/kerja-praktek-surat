<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\Admin\UserController;
use App\Http\Controllers\DashboardController;

$name = 'rt';
Route::get('/dashboard', [DashboardController::class, 'index'])->name("$name.dashboard")->middleware("permission:$name.dashboard");
