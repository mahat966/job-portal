<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeDislikeController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'prevent-back-history'],function(){

Route::get('auth/login',[AdminController::class,'login'])->name('login');
Route::get('auth/register',[AdminController::class,'registerAdmin'])->name('auth.register');
Route::post('/auth/save',[AdminController::class,'save'])->name('auth.save');
Route::post('/auth/check',[AdminController::class,'check'])->name('auth.check');
route::get('/auth/logout',[AdminController::class,'logout'])->name('logout');

Route::middleware(['auth', 'isAdmins'])->group(function () {
    Route::get('/add-blog', [BlogController::class, 'addBlog']);
    Route::post('/create-blog', [BlogController::class, 'createBlog'])->name('blog.create');
    Route::get('/blogs', [BlogController::class, 'getBlog'])->name('blogs');
    Route::get('/blogs/{id}', [BlogController::class, 'getBlogById']);
    Route::get('/delete-blog/{id}', [BlogController::class, 'deleteBlog']);
    Route::get('/edit-blog/{id}', [BlogController::class, 'editBlog']);
    Route::post('/update-blog', [BlogController::class, 'updateBlog'])->name('blog.update');
    Route::get('/dashboard', [BlogController::class, 'dashboard'])->name('dashboard');
});
});

// user ui route
Route::get('/home',[BlogController::class,'blogHome'])->name('home');
Route::get('/home-blog/{id}',[BlogController::class,'getBlogHome'])->name('home.view');

// Comments route
Route::post('comments',[CommentController::class,'store']);
Route::post('/delete-comment', [CommentController::class, 'deleteComment'])->name('comment.delete');
Route::get('/edit-comment/{id}',[CommentController::class,'editComment']);
Route::put('/update-comment',[CommentController::class,'updateComment']);

// like-dislike route
Route::post('save-dislike',[LikeDislikeController::class,'save_dislike'])->name('dislike');
Route::post('save-like',[LikeDislikeController::class,'save_like'])->name('like');





