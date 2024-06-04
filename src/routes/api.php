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

    Route::post('files/upload/{file}', [\App\Http\Controllers\FileController::class, 'uploadFile']);
    Route::post('files/create', [\App\Http\Controllers\FileController::class, 'createFile']);

    Route::get('download/{file}', [\App\Http\Controllers\FileController::class, 'downloadFile']);

    Route::put('files/update/{file}', [\App\Http\Controllers\FileController::class, 'update']);

    Route::put('files/move/{file}', [\App\Http\Controllers\FileController::class, 'move']);

    Route::get('/user-files', [\App\Http\Controllers\FileController::class, 'getFiles']);

    Route::delete('del/{file}', [\App\Http\Controllers\FileController::class, 'deleteFile']);

    Route::post('folders', [\App\Http\Controllers\FolderController::class, 'create']);
    Route::delete('folders/{folder}', [\App\Http\Controllers\FolderController::class, 'delete']);

    Route::get('users', [\App\Http\Controllers\UserController::class, 'all']);
    Route::put('users/{user}', [UserController::class, 'update']);

});

Route::apiResource('cats', \App\Http\Controllers\CatController::class);
Route::get('wellcomcat', [\App\Http\Controllers\HelloController::class, 'index']);

