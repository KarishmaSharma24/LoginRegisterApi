<?php

use Illuminate\Http\Request;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/signup',[AuthController::class,'signup']);
Route::post('/signin',[AuthController::class,'signin']);

// Route::middleware('checkLogin')->group(function(){

    Route::post('/post',[PostController::class,'store']);
    Route::get('/get-post/{id}',[PostController::class,'show']);
    Route::post('/update-post/{id}',[PostController::class,'update']);     
    Route::get('/delete-post/{id}',[PostController::class,'destory' ]);
    Route::get('/logout',[PostController::class,'logout']);
    
// });
       