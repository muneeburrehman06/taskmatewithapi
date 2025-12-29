<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\SocialAuthController;
use App\Http\Controllers\Api\ProfileController;

// ------------------------
// Public Auth Routes
// ------------------------ 

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthApiController::class, 'user'])->middleware('auth:sanctum');

// ------------------------
// Social Login Routes
// ------------------------
Route::get('auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback']);

// ------------------------
// Protected Routes (Sanctum)
// ------------------------
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::post('/logout', [AuthApiController::class, 'logout']);
});

//task management routes 
use App\Http\Controllers\Api\TaskController;

// Protect task routes with auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
});

//profile routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::put('/user/profile', [ProfileController::class, 'update']);
});

//test frontend and backend connection
Route::get('/test', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'Laravel API connected successfully'
    ]);
});

