<?php

use App\Http\Controllers\Auth\BuyerAuthController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

/*
 * ---------------------------------------------------------------------------------------
 * Frontend Routes
 * ---------------------------------------------------------------------------------------
 */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
Route::resource('contact', ContactController::class)->only(['index', 'store']);

Route::get('/auth', [BuyerAuthController::class, 'create'])->name('auth.create');
