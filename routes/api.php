<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthUserAPIController;



Route::post('/login', [AuthUserAPIController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);


// Rutas protegidas
Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::post('/logout', [AuthUserAPIController::class, 'logout']);
	Route::get('/profile', [AuthUserAPIController::class, 'profile']);




	//? USUARIOS
	Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
		return $request->user();
	});

	Route::group(['prefix' => 'users', 'controller' => UserController::class], function () {
		Route::get('/', 'index');
		Route::get('/{user}', 'show');
		Route::post('/', 'store');
		Route::put('/{user}', 'update');
		Route::delete('/{user}', 'destroy');
	});


	//? CATEGORIAS
	Route::middleware('auth:sanctum')->get('/category', function (Request $request) {
		return $request->category();
	});

	Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
		Route::get('/', 'index');
		Route::get('/{category}', 'show');
		Route::post('/', 'store');
		Route::put('/{category}', 'update');
		Route::delete('/{category}', 'destroy');
	});


	//? LIBROS
	Route::middleware('auth:sanctum')->get('/product', function (Request $request) {
		return $request->product();
	});

	Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
		Route::get('/', 'index');
		Route::get('/{product}', 'show');
		Route::post('/', 'store');
		Route::put('/{product}', 'update');
		Route::delete('/{product}', 'destroy');
	});
});
