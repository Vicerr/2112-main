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

Route::prefix('product')->name('product.')->group(function () {
    
    Route::delete('/cancel/{productId}', [ProductController::class,'cancel'])->name('cancel');
    
    Route::put('/stock/{productId}', [ProductController::class,'stock'])->name('stock');
    
    Route::post('/create', [ProductController::class,'create'])->name('create');
    
    Route::post('/edit', [ProductController::class,'update'])->name('edit');
    
    Route::get('/edit/{productId}', [ProductController::class,'edit'])->name('edit');
    
    Route::get('/{productId}', [ProductController::class,'show'])->name('show');
    
});

Route::prefix('product')->name('order.')->group(function () {

    Route::get('/{order}', [OrderController::class, 'order'])->name('order');

    Route::put('/deliver/{order}', [OrderController::class, 'deliver'])->name('deliver');

    Route::delete('/cancel/{order}', [OrderController::class, 'cancel'])->name('cancel');

});