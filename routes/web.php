<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/add-blog',[BlogController::class,'addBlog']);
Route::post('/create-blog',[BlogController::class,'createBlog'])->name('blog.create');
Route::get('/blogs',[BlogController::class,'getBlog']);
Route::get('/blogs/{id}',[BlogController::class,'getBlogById']);
Route::get('/delete-blog/{id}',[BlogController::class,'deleteBlog']);
Route::get('/edit-blog/{id}',[BlogController::class,'editBlog']);
Route::post('/update-blog',[BlogController::class,'updateBlog'])->name('blog.update');



