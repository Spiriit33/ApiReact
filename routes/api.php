<?php

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
    Route::get('',function () {
       return new \Illuminate\Http\JsonResponse('',200);
    });
    Route::group(['middleware' => 'guest'],function () {
        Route::prefix('users')->group(function () {
            Route::post('/create', ['App\Http\Controllers\UserController', 'store'])->name('users.create');
            Route::post('/login', ['App\Http\Controllers\UserController', 'login'])->name('users.login');
        });
    });
    Route::group(['middleware' => 'auth:api'],function () {
        Route::prefix('/promotions')->group(function () {
            Route::get('/all', ['App\Http\Controllers\PromotionController', 'index'])->name('promotions.index');
            Route::group(['middleware' => 'admin'], function () {
                Route::patch('/{id}/update', ['App\Http\Controllers\PromotionController', 'update'])->name('promotions.update');
                Route::post('/{id}/create', ['App\Http\Controllers\PromotionController', 'store'])->name('promotions.create');
                Route::delete('/{id}/delete', ['App\Http\Controllers\PromotionController', 'delete'])->name('promotions.delete');
            });
        });

        Route::prefix('coupons')->group(function () {
            Route::get('/qr/{qr}', ['App\Http\Controllers\CouponController', 'getScan']);
            Route::group(['middleware' => 'admin'], function () {
                Route::patch('/{id}/update', ['App\Http\Controllers\CouponController', 'update']);
                Route::patch('/{id}/update', ['App\Http\Controllers\CouponController', 'update'])->name('coupons.update');
                Route::post('/{id}/create', ['App\Http\Controllers\CouponController', 'store'])->name('coupons.create');
                Route::delete('/{id}/delete', ['App\Http\Controllers\CouponController', 'delete'])->name('promotions.delete');
            });
        });
    });
