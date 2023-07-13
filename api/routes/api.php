<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TaskController;

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('tasks', [TaskController::class, 'index']);
        Route::post('tasks', [TaskController::class, 'store']);
        Route::put('tasks/{task}', [TaskController::class, 'update']);
        Route::delete('tasks/{task}', [TaskController::class, 'destroy']);
    });
});
