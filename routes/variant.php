<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\VariantController;
use Illuminate\Support\Facades\Route;

Route::controller(VariantController::class)->middleware('auth')->name('variants.')->group(function () {
	Route::get('/variants/create', 'create')->name('create');
	Route::post('/products/{product}/variants', 'store')->name('store');
});

Route::controller(AttributeController::class)->middleware('auth')->name('attributes.')->group(function () {
	Route::get('/attributes/create', 'create')->name('create');
	Route::post('/attributes', 'store')->name('store');
});

Route::controller(AttributeValueController::class)->middleware('auth')->name('attributes.values.')->group(function () {
	Route::get('/attributes/values/create', 'create')->name('create');
	Route::post('/attributes/{attribute}/values', 'store')->name('store');
});