<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VnpayController;
use App\Http\Controllers\DashboardController;

// Đăng ký và đăng nhập
Route::post('/users', [AuthController::class, 'store']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/forgot-password', [AuthController::class, 'sendResetPasswordToken']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Các route không yêu cầu xác thực
Route::resource('products', ProductController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::resource('categories', CategoryController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::get('/categories/{categoryId}/products', [ProductController::class, 'getByCategory']);
Route::get('/products/{id}/related', [ProductController::class, 'getRelatedProducts']);


// Các route yêu cầu xác thực
Route::middleware('auth:sanctum')->group(function () {
    // Giỏ hàng
    Route::post('/cart', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::put('/cart/{id}', [CartController::class, 'updateCart']);
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart']);

    // Đơn hàng
    Route::post('/orders', [OrderController::class, 'createOrder']);
    Route::get('/orders', [OrderController::class, 'getOrders']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::put('/orders/{id}', [OrderController::class, 'updateStatus']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancelOrder']);
    Route::post('/orders/{id}/send-email', [OrderController::class, 'sendEmail']);

    
    Route::get('/dashboard-summary', [DashboardController::class, 'getSummary']);




    Route::get('/users', [AuthController::class, 'index']);
    Route::put('/users/{id}', [AuthController::class, 'update']);


    Route::post('/vnpay/payment', [VnpayController::class, 'createPaymentUrl']);
    Route::get('/vnpay/return', [VnpayController::class, 'vnpayReturn']);
    Route::get('/vnpay/cancel', [VnpayController::class, 'vnpayCancel']);
});
