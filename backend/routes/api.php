<?php
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

Route::get('/user', function (Request $request) {
   return $request->user();
})->middleware('auth:sanctum');


/* 
Route::middleware(['guest'])->group(function () {
    Fortify::registerView(function () {
        return view('auth.register');
    });

Fortify::registerRequest(function (Request $request) {
        return Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();
    });
});
*/

/*

Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/', [TaskController::class, 'store']);
    Route::get('/{task}', [TaskController::class, 'show']);
    Route::post('/update', [TaskController::class, 'update']);
    Route::delete('/{task}', [TaskController::class, 'destroy']);
});
 */


Route::apiResource('tasks', TaskController::class);
