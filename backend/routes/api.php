<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\Auth\AuthAuthenticatedSessionController;
use App\Http\Controllers\Auth\AuthRegisteredUserController;



 
 Route::post('/register', [AuthRegisteredUserController::class, 'store']);
 Route::post('/login', [AuthAuthenticatedSessionController::class, 'store']);
 Route::post('/logout', [AuthAuthenticatedSessionController::class, 'destroy']);
 

 Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TaskController::class);
});
Route::apiResource('tasks', TaskController::class);