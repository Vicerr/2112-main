<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

Route::view('/', 'index')->name('home');

Route::view('/products', 'products')->name('products');

Route::view('/contact', 'contact')->name('contact');

//Show registration form
Route::get('/register', [UserController::class,'create'])->name('register');

// Create a new user
Route::post('/auth/register', [UserController::class,'store'])->name('user');

//Show login form
Route::get('/login', [UserController::class, 'login'])->name('login');

//Authenticate user
Route::post('/auth/login', [UserController::class, 'authenticate'])->name('authenticate');

//Log user out
Route::post('/logout', [UserController::class,'logout'])->name('logout');

Route::view('/cart', 'cart')->name('cart');

Route::view('/checkout', 'checkout')->name('checkout');

Route::view('/product', 'product')->name('product');

Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

Route::get('/users', [AdminController::class,'users'])->name('users');

Route::get('/create', [AdminController::class,'create'])->name('create');

Route::get('/items', [AdminController::class,'items'])->name('items');

Route::post('/product/create', [ProductController::class,'create'])->name('stock');

