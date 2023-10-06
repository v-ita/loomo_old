<?php
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::controller(RoleController::class)->middleware('auth')->name('roles.')->group(function () {
	Route::get('/roles/create', 'create')->name('create');
	Route::post('/roles', 'store')->name('store');
});