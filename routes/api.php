<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControler;

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

Route::post('/register',[AuthControler::class, 'register']);
Route::post('/login',[AuthControler::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    
    Route::get('/user',[AuthControler::class, 'user']);
    Route::post('/logout',[AuthControler::class, 'logout']);

    Route::get('/posts',[PostController::class, 'index']);
    Route::post('/posts',[PostController::class, 'store']);
    Route::get('/posts/{id}',[PostController::class, 'show']);
    Route::put('/posts/{id}',[PostController::class, 'update']);
    Route::delete('/posts/{id}',[PostController::class, 'destroy']);

    Route::get('/posts/{id}/comments',[CommentController::class, 'index']);
    Route::post('/posts/{id}/comments',[CommentController::class, 'store']);
    Route::put('/comments{id}',[CommentController::class, 'update']);
    Route::delete('/comments{id}',[CommentController::class, 'destroy']);

    Route::post('/posts{id}/likes',[LikeController::class, 'likeOrUnlike']);

});