<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public/home');
});

Route::get('/product/{id}', function ($id) {
    return view('public/product_show', ['id' => $id]);
})->name('product.show');

Route::get('/cart/index', function () {
    return view('public/cart/index');
})->name('cart.index');

Route::get('/checkout/index', function () {
    return view('public/checkout/index');
})->name('checkout');

Route::get('/payment/index', function () {
    return view('public/payment/index');
})->name('payment');

Route::get('/order/confirmed', function () {
    return view('public/order/confirmed');
})->name('order.success');
