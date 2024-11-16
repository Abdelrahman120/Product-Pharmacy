<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PharmacyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

/* ************************products routes************************************ */
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);  
    Route::post('/', [ProductController::class, 'store']);
    Route::get('{product}', [ProductController::class, 'show']); 
    Route::put('{product}', [ProductController::class, 'update']); 
    Route::delete('{product}', [ProductController::class, 'destroy']); 
});


/* ************************pharmacies routes************************************ */
Route::prefix('pharmacies')->group(function () {
    Route::get('/', [PharmacyController::class, 'index']);  
    Route::post('/', [PharmacyController::class, 'store']); 
    Route::get('{pharmacy}', [PharmacyController::class, 'show']); 
    Route::put('{pharmacy}', [PharmacyController::class, 'update']); 
    Route::delete('{pharmacy}', [PharmacyController::class, 'destroy']); 
});
