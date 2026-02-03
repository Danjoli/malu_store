<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function() {
    return view('admin.auth.login');
})->name('admin.login');


Route::get('/dashboard', function() {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/clients', function() {
    return view('admin.clients.index');
})->name('admin.clients.index');
