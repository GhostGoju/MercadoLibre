<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;


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
		Route::get('/products/by-category/{category_id}', 'showByCategory')->name('products.byCategory');
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


	//Carrito
	Route::group(['prefix' => 'carts', 'controller' => CartController::class], function () {
		Route::get('/', 'index')->name('carts.index');
		Route::post('/addToCart', 'addToCart')->name('carts.addToCart');
		Route::post('/removeFromCart', 'removeFromCart')->name('carts.removeFromCart');
	});


	// Roles
	Route::group(['prefix' => 'roles', 'controller' => RoleController::class], function () {
		Route::get('/', 'index')->name('roles.index')->middleware('can:roles.index');
		Route::get('/get-all', 'index')->name('roles.get-all')->middleware('can:roles.get-all');
		Route::post('/store', 'store')->name('roles.store')->middleware('can:roles.store');
		Route::post('/update/{role}', 'update')->name('roles.update')->middleware('can:roles.update');
		Route::delete('/{role}', 'destroy')->name('roles.destroy')->middleware('can:roles.destroy');
	});
});
