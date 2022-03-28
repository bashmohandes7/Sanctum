<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\RegisterController;
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
Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::apiResource('projects', ProjectController::class);
});

// Authentication
Route::post('register', [RegisterController::class, 'register']);
Route::post('login',    [LoginController::class, 'login'])->middleware('guest:sanctum');
Route::get('tokens',    [LoginController::class, 'tokens'])->middleware('auth:sanctum');
Route::get('logout/single-device/{id}', [LogoutController::class, 'singleDevice']);
Route::get('logout/current-device', [LogoutController::class, 'CurrentDevice']);
Route::get('logout/all-devices', [LogoutController::class, 'allDevices']);

