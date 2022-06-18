<?php

use App\Http\Controllers\Api\V1\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;

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


Route::prefix('users/v1/')->group(function () {

    //public routes
    Route::post('/register', [AuthController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/all', [AuthController::class, 'index']);

    //protected routes
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user/{user}', [AuthController::class, 'show']);
        Route::delete('/user/{user}', [AuthController::class, 'destroy']);

        Route::post('/all', [AuthController::class, 'index']);
    });
});


//Route::resource('users', AuthController::class);


Route::prefix('addresses/v1/')->group(function () {
    //protected routs
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::delete('/address/{address}', [AddressController::class, 'destroy']);
    });
});
