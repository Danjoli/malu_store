<?php

use App\Http\Controllers\CartController;
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

Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrinho/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrinho/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrinho/update/{id}', [CartController::class, 'update'])->name('cart.update');




