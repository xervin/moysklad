<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * MSAuth - middleware, которое отвечает за проверку аутентификации пользователя
 */
Route::middleware(['MSAuth'])->group(function() {
    Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');
    Route::post('state/{uid}/change/{value}', [\App\Http\Controllers\StateController::class, 'changeState']);
});

Route::post('login', [\App\Http\Controllers\MSLoginController::class, 'auth'])->name('login.auth');
Route::get('login', [\App\Http\Controllers\MSLoginController::class, 'index'])->name('login');
Route::get('logout', [\App\Http\Controllers\MSLoginController::class, 'logout'])->name('logout');
