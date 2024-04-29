<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


Auth::routes();
Route::get('/', [ProductController::class, 'home'])->name('products.home');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', [HomeController::class, 'home'])->name('home');

	// Users
	Route::group(['prefix' => 'users', 'controller' => UserController::class], function () {
		Route::get('/', 'index')->name('users.index')->middleware('can:users.index');
		Route::post('/store', 'store')->name('users.store')->middleware('can:users.store');
		Route::post('/update/{user}', 'update')->name('users.update')->middleware('can:users.update');
		Route::delete('/{user}', 'destroy')->name('users.destroy')->middleware('can:users.destroy');
	});


	// Product
	Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
		Route::get('/', 'index')->name('products.index')->middleware('can:products.index');
		Route::get('/show/{product}', 'show')->name('products.show');
		Route::post('/store', 'store')->name('products.store')->middleware('can:products.store');
		Route::post('/update/{product}', 'update')->name('products.update')->middleware('can:products.update');
		Route::delete('/{product}', 'destroy')->name('products.destroy')->middleware('can:products.destroy');
	});


	// Category
	Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
		Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
		Route::get('/get-all', 'index')->name('categories.get-all')->middleware('can:categories.get-all');
		Route::get('/show/{category}', 'show')->name('categories.show')->middleware('can:categories.show');
		Route::post('/store', 'store')->name('categories.store')->middleware('can:categories.store');
		Route::post('/update/{category}', 'update')->name('categories.update')->middleware('can:categories.update');
		Route::delete('/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
	});
});
