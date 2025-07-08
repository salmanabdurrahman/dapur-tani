<?php

use App\Http\Controllers\Auth\BuyerAuthController;
use App\Http\Controllers\Buyer\DashboardController;
use App\Http\Controllers\Buyer\OrderController;
use App\Http\Controllers\Buyer\ProfileController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
 * ---------------------------------------------------------------------------------------
 * Frontend Routes
 * ---------------------------------------------------------------------------------------
 */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us');
Route::resource('contact', ContactController::class)->only(['index', 'store']);
Route::post('subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');

/*
 * ---------------------------------------------------------------------------------------
 * Auth Routes
 * ---------------------------------------------------------------------------------------
 */

Route::middleware('guest')->group(function () {
    Route::get('auth', [BuyerAuthController::class, 'create'])->name('auth.create');
});

/*
 * ---------------------------------------------------------------------------------------
 * Buyer Dashboard Routes
 * ---------------------------------------------------------------------------------------
 */

Route::prefix('buyer')->name('buyer.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    Route::get('settings', [ProfileController::class, 'edit'])->name('settings.edit');
});