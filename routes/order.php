<?php
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::controller(OrderController::class)->middleware('auth')->name('orders.')->group(function () {
	Route::get('/orders/create', 'create')->name('create');
	Route::post('/orders', 'store')->name('store');
});