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

Route::prefix('task')->group(function(){
    Route::resource('',App\Http\Controllers\Api\TaskController::class);
    Route::post('/start/{id}',[App\Http\Controllers\Api\TaskController::class,'startTask']);
    Route::post('/stop/{id}',[App\Http\Controllers\Api\TaskController::class,'stopTask']);

    Route::prefix('pack')->group(function(){
        Route::post('',[App\Http\Controllers\Api\TaskPakcController::class,'store']);
        Route::post('/stop',[App\Http\Controllers\Api\TaskPakcController::class,'stopTask']);
        Route::post('/start',[App\Http\Controllers\Api\TaskPakcController::class,'startTask']);
        Route::post('/all',[App\Http\Controllers\Api\TaskPakcController::class,'showpack']);
    });
    
});



Route::get('/jobs',[App\Http\Controllers\Api\JobController::class,'index']);


