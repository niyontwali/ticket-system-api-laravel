<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// users
Route::get('/users', [UserController::class, 'users'])->middleware('auth:sanctum');
Route::get('/user', [UserController::class, 'user'])->middleware('auth:sanctum');

// auth
Route::post('/register', [AuthController::class, 'register'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// tickets
Route::apiResource('tickets', TicketController::class)->middleware('auth:sanctum');

// comments
Route::apiResource('comments', CommentController::class)->middleware(['auth:sanctum', 'role:admin']);