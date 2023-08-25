<?php

use Illuminate\Support\Facades\Route;



Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/newpost', [App\Http\Controllers\NewpostController::class, 'index'])->name('newpost');

Route::post('/posts/store', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{postId}/show', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/posts/all', [App\Http\Controllers\HomeController::class, 'allPosts'])->name('posts.all');
Route::get('/posts/{postId}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/{postId}/update', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::get('/posts/{postId}/delete', [App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');


Route::post('/posts/{postId}/comment',[App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}',[App\Http\Controllers\CommentController::class, 'delete'])->name('comments.delete');
Route::get('/comments/{id}/edit',[App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
Route::post('/comments/{id}',[App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');

Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('admin')->name('admin.dashboard');

Route::get('/send-mail', [App\Http\Controllers\SendMailController::class, 'index'])->name('mail');