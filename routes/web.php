<?php

// ====================================================================================================================
// utility ============================================================================================================

use App\Http\Controllers\App\Admin\UserController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

// Controller =========================================================================================================
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoaderController;

// ====================================================================================================================
// Frontend ===========================================================================================================
use App\Http\Controllers\Frontend\KontakController;
use App\Http\Controllers\Frontend\GaleriController as GaleriControllerFrontend;
use App\Http\Controllers\Frontend\ArtikelController;

// ====================================================================================================================
// ====================================================================================================================

// auth ===============================================================================================================
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name("login");
    Route::post('/login', 'check_login')->name("login.check_login");
    Route::get('/logout', 'logout')->name("login.logout");
});
// ====================================================================================================================




// home default =======================================================================================================

Route::get('/', function () {
    if (!auth()->user()) return Redirect::route('login');
    if (auth_has_role(config('app.role_super_admin'))) {
        return Redirect::route('admin.dashboard');
    } else if (auth_has_role('Penduduk')) {
        return Redirect::route('penduduk.home');
    } else {
        return Redirect::route('login');
    }
})->name("home");
// home default =======================================================================================================

// artikel ============================================================================================================
$prefix = 'artikel';
Route::controller(ArtikelController::class)->prefix($prefix)->group(function () use ($prefix) {
    Route::get('/', 'index')->name($prefix);
    Route::get('/{model:slug}', 'detail')->name("$prefix.detail");
});
// ====================================================================================================================



// Kontak =============================================================================================================
$name = 'kontak';
Route::controller(KontakController::class)->prefix($name)->group(function () use ($name) {
    Route::get('/', 'index')->name($name);
    Route::post('/send', 'insert')->name("$name.send");
    Route::get('/faq', 'faq')->name("$name.faq");
});
// ====================================================================================================================


// Galeri =============================================================================================================
$name = 'galeri';
Route::controller(GaleriControllerFrontend::class)->prefix($name)->group(function () use ($name) {
    Route::get('/', 'index')->name($name);
    Route::get('/detail/{model:slug}', 'detail')->name("$name.detail");
});
// ====================================================================================================================




// dashboard ==========================================================================================================
Route::get('/dashboard', function () {
    if (!auth()->user()) return Redirect::route('login');
    if (auth_has_role(config('app.role_super_admin'))) {
        return Redirect::route('admin.dashboard');
    } else {
        return Redirect::route('member.dashboard');
    }
})->name("dashboard");
// ====================================================================================================================

// Utility ============================================================================================================
$prefix = 'loader';
Route::controller(LoaderController::class)->prefix($prefix)->group(function () {
    Route::prefix('js')->group(function () {
        Route::get('/{file}.js', 'js')->name("load_js");
        Route::get('/{f}/{file}.js', 'js_f')->name("load_js_a");
        Route::get('/{f}/{f_a}/{file}.js', 'js_a')->name("load_js_b");
        Route::get('/{f}/{f_a}/{f_b}/{file}.js', 'js_b')->name("load_js_b");
        Route::get('/{f}/{f_a}/{f_b}/{f_c}/{file}.js', 'js_c')->name("load_js_c");
        Route::get('/{f}/{f_a}/{f_b}/{f_c}/{f_d}/{file}.js', 'js_d')->name("load_js_d");
    });
});
// ====================================================================================================================

$prefix = "password";
Route::controller(UserController::class)->prefix($prefix)->group(function () use ($prefix) {
    $name = "$prefix"; // password
    Route::get('/', 'change_password')->name($name)->middleware("permission:$name");
    Route::post('/save', 'save_password')->name("$name.save")->middleware("permission:$name.save");
});
