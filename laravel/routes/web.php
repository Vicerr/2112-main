<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');

Route::view('/products', 'products')->name('products');

Route::view('/contact', 'contact')->name('contact');

Route::view('/login', 'login')->name('login');

Route::view('/register', 'register')->name('register');

Route::view('/cart', 'cart')->name('cart');

Route::view('/checkout', 'checkout')->name('checkout');

Route::view('/product', 'product')->name('product');

Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::view('/users', 'users')->name('users');

Route::view('/create', 'create')->name('create');

Route::view('/items', 'items')->name('items');


