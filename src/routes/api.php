<?php

use App\Http\Controllers\UserController;
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

Route::post('token', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){

    Route::post('create-user', [UserController::class, 'create']);

    Route::post('upload', [\App\Http\Controllers\FileController::class, 'uploadFile']);

    Route::get('download/{file}', [\App\Http\Controllers\FileController::class, 'downloadFile']);

    Route::get('/user-files', [\App\Http\Controllers\FileController::class, 'getFiles']);

    Route::delete('del/{file}', [\App\Http\Controllers\FileController::class, 'deleteFile']);


});

Route::apiResource('cats', \App\Http\Controllers\CatController::class);
Route::get('wellcomcat', [\App\Http\Controllers\HelloController::class, 'index']);

