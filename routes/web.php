<?php

use Illuminate\Support\Facades\Route;
use Insyht\LarvelousShop\Http\Controllers\CartController;
use Insyht\LarvelousShop\Http\Controllers\FilterController;
use Insyht\LarvelousShop\Http\Controllers\ProductCategoryController;
use Insyht\LarvelousShop\Http\Controllers\ProductController;
use Insyht\LarvelousShop\Http\Controllers\WishlistController;

Route::middleware(['web'])->group(function () {
    // Filters
    Route::post('/filter', [FilterController::class, 'apply']);
    Route::delete('/filter', [FilterController::class, 'remove']);

    // Product
    Route::get('/product/{product:url}', [ProductController::class, 'show']);
    Route::get('/category/{productCategory:url}', [ProductCategoryController::class, 'show']);

    // Cart
    Route::post('/add-to-cart', [CartController::class, 'addToCart']);

    // Wishlist
    Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist']);
});
