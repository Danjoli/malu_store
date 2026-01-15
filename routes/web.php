<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'message' => 'Bem-vindo à loja da Malu'
    ]);
});

Route::get('/produtos', function () {
    return Inertia::render('Products');
});

Route::get('/produtos', [ProductController::class, 'index']);

Route::get('/produtos/{id}', [ProductController::class, 'show']);




