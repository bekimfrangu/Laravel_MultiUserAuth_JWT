<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentProviderController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\SubadminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailController;
use App\Models\Supplier;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//We could make resource routes for each of them :)

//Suppliers
    //get all suppliers
    Route::get('/suppliers', [SupplierController::class, 'index']);

    //insert supplier
    Route::post('/supplier', [SupplierController::class, 'store']);

    //get specific supplier
    Route::get('/supplier/{id}', [SupplierController::class, 'supplier']);

    //update supplier
    Route::put('/supplier/{id}', [SupplierController::class, 'update']);

    //delete supplier
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);

    
//Shippers
    //get all shippers
    Route::get('/shippers', [ShipperController::class, 'index']);

    //insert shipper
    Route::post('/shipper', [ShipperController::class, 'store']);

    //get specific shipper
    Route::get('/shipper/{id}', [ShipperController::class, 'shipper']);

    //update shipper
    Route::put('/shipper/{id}', [ShipperController::class, 'update']);

    //delete shipper
    Route::delete('/shipper/{id}', [ShipperController::class, 'destroy']);

//Payments
    //get all payments
    Route::get('/payments', [PaymentController::class, 'index']);

    //insert payment
    Route::post('/payment', [PaymentController::class, 'store']);

    //get specific payment
    Route::get('/payment/{id}', [PaymentController::class, 'payment']);

    //update payment
    Route::put('/payment/{id}', [PaymentController::class, 'update']);

    //delete payment
    Route::delete('/payment/{id}', [PaymentController::class, 'destroy']);

//Payment Types
    //get all payment types
    Route::get('/payment-types', [PaymentTypeController::class, 'index']);

    //insert payment type
    Route::post('/payment-type', [PaymentTypeController::class, 'store']);

    //get specific payment type
    Route::get('/payment-type/{id}', [PaymentTypeController::class, 'paymentType']);

    //update payment type
    Route::put('/payment-type/{id}', [PaymentTypeController::class, 'update']);

    //delete payment type
    Route::delete('/payment-type/{id}', [PaymentTypeController::class, 'destroy']);

//Payment Providers
    //get all payment providers
    Route::get('/payment-providerss', [PaymentProviderController::class, 'index']);

    //insert payment provider
    Route::post('/payment-provider', [PaymentProviderController::class, 'store']);

    //get specific payment provider
    Route::get('/payment-provider/{id}', [PaymentProviderController::class, 'paymentProvider']);

    //update payment provider
    Route::put('/payment-provider/{id}', [PaymentProviderController::class, 'update']);

    //delete payment provider
    Route::delete('/payment-provider/{id}', [PaymentProviderController::class, 'destroy']);

//Users
    //get all users
    Route::get('/users', [UserController::class, 'index']);

    //insert provider
    Route::post('/user', [UserController::class, 'store']);

    //get specific provider
    Route::get('/user/{id}', [UserController::class, 'user']);

    //update provider
    Route::put('/user/{id}', [UserController::class, 'update']);

    //delete provider
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

//User Details
    //get all users details
    Route::get('/users-details', [UserDetailController::class, 'index']);

    //insert user details
    // Route::post('/user-details', [UserDetailController::class, 'store']);

    //get specific user details
    Route::get('/user-details/{id}', [UserDetailController::class, 'userDetail']);

    //update user details
    Route::put('/user-details/{id}', [UserDetailController::class, 'update']);

    //delete user details
    Route::delete('/user-details/{id}', [UserDetailController::class, 'destroy']);

//Categories
    //get all categories
    Route::get('/categories', [CategoryController::class, 'index']);

    //insert category
    Route::post('/category', [CategoryController::class, 'store']);

    //get specific category
    Route::get('/category/{id}', [CategoryController::class, 'category']);

    //update category
    Route::post('/category/{id}', [CategoryController::class, 'update']);

    //delete category
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

//Orders
    //get all orders
    Route::get('/orders', [OrderController::class, 'index']);

    //insert order
    Route::post('/order', [OrderController::class, 'store']);

    //get specific order
    Route::get('/order/{id}', [OrderController::class, 'order']);

    //update order
    Route::put('/order/{id}', [OrderController::class, 'update']);

    //delete order
    Route::delete('/order/{id}', [OrderController::class, 'destroy']);

//Products
    //get all products
    Route::get('/products', [ProductController::class, 'index']);

    //insert order
    Route::post('/product', [ProductController::class, 'store']);

    //get specific product
    Route::get('/product/{id}', [ProductController::class, 'product']);

    //update product
    Route::post('/product/{id}', [ProductController::class, 'update']);

    //delete product
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

//User

Route::group([

    'middleware' => 'api'

], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('profile', [AuthController::class, 'profile']);

    Route::get('/user-details', [UserDetailController::class, 'store']);
});


//Multi user
Route::prefix('admin')->controller(AdminController::class)->group(function () {

    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::middleware('auth:admin_api')->group(function () {
        Route::post('/logout', 'logout');
        Route::post('/me', 'me');
        Route::get('/orders', 'index');
    });
});

Route::prefix('subadmin')->controller(SubadminController::class)->group(function () {

    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::middleware('auth:subadmin_api')->group(function () {
        Route::post('/logout', 'logout');
        Route::post('/me', 'me');
        Route::get('/products', 'index');
    });
});



