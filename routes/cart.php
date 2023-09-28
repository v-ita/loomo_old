<?php

use App\Http\Controllers\CartItemController;
use Illuminate\Support\Facades\Route;

Route::controller(CartItemController::class)->middleware('auth')->name('carts.items.')->group(function () {
	Route::get('/carts/items/create', 'create')->name('create');
	Route::post('/carts/{cart}/items', 'store')->name('store');
});