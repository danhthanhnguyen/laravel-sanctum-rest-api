<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Publc routes
Route::get('/products', [ProductsController::class, 'index']);// get all products
Route::get('/products/{id}', [ProductsController::class, 'show']);// get a product by id
Route::get('/products/search/{name}', [ProductsController::class, 'search']);// search product by name

Route::post('/register', [AuthController::class, 'register']);// create user
Route::post('/login', [AuthController::class, 'login']);// login

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/products', [ProductsController::class, 'store']);// create product
    Route::put('/products/{id}', [ProductsController::class, 'update']);// update product
    Route::delete('/products/{id}', [ProductsController::class, 'destroy']);// delete product

    Route::post('/logout', [AuthController::class, 'logout']);// logout
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
