<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthenticationController;

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::get('verify', [AuthenticationController::class, 'verify']);

Route::group([
    "middleware" => ["auth:sanctum"]
], function() {
    Route::get("profile", [AuthenticationController::class, "profile"]);
    Route::get("logout", [AuthenticationController::class, "logout"]);
    Route::apiResource('tasks', TaskController::class);

});

/**
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */
