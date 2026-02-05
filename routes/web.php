<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | LOGIN ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


    /*
    |--------------------------------------------------------------------------
    | ÁREA PROTEGIDA (QUALQUER ADMIN LOGADO)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


        /*
        |--------------------------------------------------------------------------
        | APENAS SUPERADMIN PODE GERENCIAR ADMINS
        |--------------------------------------------------------------------------
        */
        Route::middleware(['auth:admin', 'admin.role:superadmin'])->group(function () {
            Route::resource('admins', AdminController::class);
            Route::resource('clients', ClientController::class);
        });

        Route::middleware(['auth:admin', 'admin.role:admin'])->group(function () {

        });

        Route::middleware(['auth:admin', 'admin.role:suporte'])->group(function () {

        });

    });
});


