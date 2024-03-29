<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TaskController::class)->group(function () {
    Route::post('/task', 'create');
    Route::put('/task/{id}', 'update');
    Route::delete('/task/{id}', 'delete');
    Route::get('/task/{id}', 'read');
    Route::get('/task', 'readAll');
});
