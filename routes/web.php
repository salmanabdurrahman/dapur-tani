<?php

use App\Http\Controllers\Auth\BuyerAuthController;
use App\Http\Controllers\Auth\BuyerGoogleLoginController;
use App\Http\Controllers\Buyer\CheckoutController;
use App\Http\Controllers\Buyer\DashboardController;
use App\Http\Controllers\Buyer\OrderController;
use App\Http\Controllers\Buyer\ProfileController;
use App\Http\Controllers\Buyer\RecurringOrderController;
use App\Http\Controllers\Buyer\ReviewController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SubscriptionController;
use App\Http\Controllers\Frontend\SupplierProfileController;
use Illuminate\Support\Facades\Route;

/*
 * ---------------------------------------------------------------------------------------
 * Frontend Routes
 * ---------------------------------------------------------------------------------------
 */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::get('/supplier/{supplier}', [SupplierProfileController::class, 'show'])->name('supplier.profile');
Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy']);
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
    Route::post('register', [BuyerAuthController::class, 'store'])->name('auth.store');
    Route::post('login', [BuyerAuthController::class, 'login'])->name('auth.login');

    Route::get('/google/redirect', [BuyerGoogleLoginController::class, 'redirectToGoogle'])->name('auth.google.redirect');
    Route::get('/google/callback', [BuyerGoogleLoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

Route::post('logout', [BuyerAuthController::class, 'logout'])->name('auth.logout')
    ->middleware('auth');

/*
 * ---------------------------------------------------------------------------------------
 * Buyer Dashboard Routes
 * ---------------------------------------------------------------------------------------
 */

Route::middleware('role:buyer')->prefix('buyer')->name('buyer.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    Route::post('orders/{order}/review', [ReviewController::class, 'store'])->name('orders.review.store');
    Route::resource('recurring-orders', RecurringOrderController::class)->only(['index', 'store', 'destroy']);
    Route::get('settings', [ProfileController::class, 'edit'])->name('settings.edit');
    Route::put('settings/profile', [ProfileController::class, 'updateProfile'])->name('settings.updateProfile');
    Route::put('settings/address', [ProfileController::class, 'updateAddress'])->name('settings.updateAddress');
    Route::put('settings/password', [ProfileController::class, 'updatePassword'])->name('settings.updatePassword');
    Route::put('settings/bank-details', [ProfileController::class, 'updateBankDetails'])->name('settings.updateBankDetails');

    Route::resource('checkout', CheckoutController::class)->only(['index', 'store']);
});