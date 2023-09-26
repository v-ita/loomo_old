<?php
use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::controller(CurrencyController::class)->middleware('auth')->name('currencies.')->group(function () {
	Route::get('/currencies/create', 'create')->name('create');
	Route::post('/currencies', 'store')->name('store');
});