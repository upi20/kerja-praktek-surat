<?php

use App\Http\Controllers\App\Admin\Address\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->controller(UserController::class)->group(function () {
    Route::get('user', 'fetch');
    Route::post('user', 'updateProfile');
    Route::post('logout', 'logout');
    Route::post('change_password', 'changePassword');
});

Route::post('login', [UserController::class, 'login']);
