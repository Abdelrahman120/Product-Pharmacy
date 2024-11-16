<?php

use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::resource('products', ProductController::class);
Route::resource('Pharmacies', PharmacyController::class);

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');