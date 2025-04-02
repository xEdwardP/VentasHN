<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/logear', [AuthController::class, 'logear'])->name('logear');

Route::middleware("auth")->group(function(){
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/crear-admin', [AuthController::class, 'createAdmin']);

Route::prefix('sales')->middleware('auth')->group(function(){
    Route::get('/new-sale', [SaleController::class, 'index'])->name('new-sale');
    Route::get('/add-cart/{id_product}', [SaleController::class, 'addCart'])->name('sales.add.cart');
    Route::get('/delete-cart', [SaleController::class, 'deleteCart'])->name('sales.delete.cart');
    Route::get('/remove-cart/{id_product}', [SaleController::class, 'removeCart'])->name('sales.remove.cart');
});

Route::prefix('salesdetails')->middleware('auth')->group(function(){
});

Route::prefix('categories')->middleware('auth')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('categories');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/show{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::delete('/destroy{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::prefix('customers')->middleware('auth')->group(function(){
    Route::get('/', [CustomerController::class, 'index'])->name('customers');
    Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/edit{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/update{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::get('/show{id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::delete('/destroy{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});

Route::prefix('suppliers')->middleware('auth')->group(function(){
    Route::get('/', [SupplierController::class, 'index'])->name('suppliers');
    Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/store', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/edit{id}', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/update{id}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::get('/show{id}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::delete('/destroy{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
});

Route::prefix('products')->middleware('auth')->group(function(){
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edit{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/update{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/show{id}', [ProductController::class, 'show'])->name('products.show');
    Route::delete('/destroy{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::prefix('products_report')->middleware('auth')->group(function(){
});

Route::prefix('users')->middleware('auth')->group(function(){
});