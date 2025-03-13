<?php

// api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;

Route::post('/users', [AuthController::class, 'store']);  // Đăng ký tài khoản mới
Route::post('/login', [AuthController::class, 'login']);  // Đăng nhập và nhận token

Route::middleware('auth:sanctum')->group(function () {
    // Các route cần token
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('/categories/{categoryId}/products', [ProductController::class, 'getByCategory']);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::put('/cart/{id}', [CartController::class, 'updateCart']);
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart']);
});





