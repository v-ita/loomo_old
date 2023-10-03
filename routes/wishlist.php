<?php

use App\Http\Controllers\WishlistItemController;
use Illuminate\Support\Facades\Route;

Route::controller(WishlistItemController::class)->middleware('auth')->name('wishlists.items.')->group(function () {
	Route::get('/wishlists/items/create', 'create')->name('create');
	Route::post('/wishlists/{wishlist}/items', 'store')->name('store');
});