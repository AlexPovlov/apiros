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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/task',App\Http\Controllers\Api\TaskController::class);
Route::post('/task/start/{id}',[App\Http\Controllers\Api\TaskController::class,'startTask']);
Route::post('/task/stop/{id}',[App\Http\Controllers\Api\TaskController::class,'stopTask']);

Route::resource('/jobs',App\Http\Controllers\Api\JobController::class);

Route::resource('/task/pack',App\Http\Controllers\Api\TaskPakcController::class);
Route::post('/task/pack/all',[App\Http\Controllers\Api\TaskPakcController::class,'showpack']);

//Route::resource('/task',App\Http\Controllers\Api\TaskController::class);
