<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::apiResource('posts', PostController::class);

Route::get('posts/{id}/comments', [PostController::class, 'comments']);

Route::apiResource('comments', CommentController::class);

Route::apiResource('users', UserController::class);

Route::get('users/{id}/posts', [UserController::class, 'posts']);

Route::get('users/{id}/comments', [UserController::class, 'comments']);

