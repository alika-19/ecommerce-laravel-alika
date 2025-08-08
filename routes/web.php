<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (produk untuk user biasa)
Route::get('/', [ProductController::class, 'index'])->name('home');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Checkout-admin ngga bisa make khusus user
Route::middleware('auth')->group(function () {
     Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.form');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

// admin - buat yang di tunjuk sebagai admin yang bisa masuk
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // crud produk
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [AdminController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminController::class, 'destroy'])->name('products.destroy');
});
