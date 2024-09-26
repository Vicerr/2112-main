<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/contact', [HomeController::class,'contact'])->name('contact');

//Show registration form
Route::get('/register', [UserController::class,'create'])->name('register');

// Create a new user
Route::post('/auth/register', [UserController::class,'store'])->name('user');

// email verifiaction routes
Route::get('/email/verify', function () {
    return view('users.verify');
})->middleware('auth')->name('verification.notice');

 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect()->name('home')->with('message', 'You have been successfully verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Show login form
Route::get('/login', [UserController::class, 'login'])->name('login');

//Authenticate user
Route::post('/auth/login', [UserController::class, 'authenticate'])->name('authenticate');

//Log user out
Route::post('/logout', [UserController::class,'logout'])->name('logout');

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

Route::prefix('order')->name('order.')->group(function () {
    
    Route::get('/status', [OrderController::class, 'status'])->name('status');
    
    Route::get('/{order}', [OrderController::class, 'order'])->name('order');
    
    Route::put('/deliver/{order}', [OrderController::class, 'deliver'])->name('deliver');
    
    Route::delete('/cancel/{order}', [OrderController::class, 'cancel'])->name('cancel');
    
});

Route::get('/cart', [OrderController::class, 'show_cart'])->name('cart');

Route::prefix('cart')->name('cart.')->group(function () {
    
    Route::post('/add', [OrderController::class, 'add'])->name('add');
    
    Route::delete('/clear', [OrderController::class, 'clear_cart'])->name('clear');
    
    Route::put('/edit/{cart}', [OrderController::class, 'update_cart'])->name('update');
    
    Route::delete('/delete/{cart}', [OrderController::class, 'delete_cart'])->name('delete');
    
});

Route::get('/billing', [OrderController::class, 'billing'])->name('billing');

Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
