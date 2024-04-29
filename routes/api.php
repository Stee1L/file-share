<?php

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

Route::middleware('auth:sanctum')->group(function (){

Route::get('unfoUser', \App\Http\Controllers\UserController::class);

    Route::post('upload', [\App\Http\Controllers\FileController::class, 'uploadFile']);

    Route::get('download/{file}', [\App\Http\Controllers\FileController::class, 'downloadFile']);

    Route::get('/user-files', [\App\Http\Controllers\FileController::class, 'getFiles']);

});

Route::post('register', [\App\Http\Controllers\APIAuthController::class, 'register']);
Route::post('token', [\App\Http\Controllers\APIAuthController::class, 'token']);


Route::middleware('auth:sanctum')->get('/name', function (Request $request) {
    return response()->json(['name' => $request->user()->name]);
});

Route::apiResource('cats', \App\Http\Controllers\CatController::class);
Route::get('wellcomcat', [\App\Http\Controllers\HelloController::class, 'index']);

