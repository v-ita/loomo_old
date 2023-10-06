<?php
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleUserController;
use Illuminate\Support\Facades\Route;

Route::controller(RoleController::class)->middleware('auth')->name('roles.')->group(function () {
	Route::get('/roles/create', 'create')->name('create');
	Route::post('/roles', 'store')->name('store');
});

Route::controller(RoleUserController::class)->middleware('auth')->name('users.roles.')->group(function () {
	Route::get('/users/roles/create', 'create')->name('create');
	Route::post('/users/{user}/roles/{role}/assign', 'store')->name('store');
});