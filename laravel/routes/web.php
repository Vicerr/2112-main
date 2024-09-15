<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class,'index'])->name('home');

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

Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

Route::get('/orders', [AdminController::class,'orders'])->name('orders');

Route::get('/create', [AdminController::class,'create'])->name('create');

Route::get('/items', [AdminController::class,'items'])->name('items');

Route::get('/products', [ProductController::class,'all'])->name('products');

Route::get('/product/{productId}', [ProductController::class,'show'])->name('product/{product}');

Route::post('/product/create', [ProductController::class,'create'])->name('product/create');

Route::get('/product/edit/{productId}', [ProductController::class,'edit'])->name('product/edit/{product}');

Route::post('/product/edit', [ProductController::class,'update'])->name('product/edit');

Route::get('order/{order}', [OrderController::class, 'order']);

Route::get('order/deliver/{order}', [OrderController::class, 'deliver']);

Route::get('order/cancel/{order}', [OrderController::class, 'cancel']);
