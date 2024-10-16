<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReadNotificationController;

Route::get('/', [HomeController::class, 'home']);

Route::get('/login', function(){
    return view('auth.login');
});

Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'manualLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/post/createSlug', [PostController::class, 'createSlug']);
Route::resource('post', PostController::class);
Route::resource('post.comment', CommentController::class);
Route::get('/oauth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/oauth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::post('/notificationRead', [ReadNotificationController::class, 'store']);
Route::post('/addview', [PostController::class, 'addView']);