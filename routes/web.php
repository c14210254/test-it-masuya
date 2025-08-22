<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);
Route::resource('customers', CustomerController::class);
Route::resource('transactions', TransaksiController::class);
Route::post('/transactions/store', [TransaksiController::class, 'store'])->name('transactions.store');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

Route::get('/customers/{id}/json', [CustomerController::class, 'getJson'])->name('customers.json');
Route::get('/products/{id}/json', [ProductController::class, 'getJson'])->name('products.json');
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
