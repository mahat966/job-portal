<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/welcome', function () {
    return view('/');
});

Route::get('auth/login',[AdminController::class,'login'])->name('login');
Route::get('auth/register',[AdminController::class,'registerAdmin'])->name('auth.register');
Route::post('/auth/save',[AdminController::class,'save'])->name('auth.save');
Route::post('/auth/check',[AdminController::class,'check'])->name('auth.check');

Route::middleware('auth')->group(function () {
    Route::get('/add-blog', [BlogController::class, 'addBlog']);
    Route::post('/create-blog', [BlogController::class, 'createBlog'])->name('blog.create');
    Route::get('/blogs', [BlogController::class, 'getBlog']);
    Route::get('/blogs/{id}', [BlogController::class, 'getBlogById']);
    Route::get('/delete-blog/{id}', [BlogController::class, 'deleteBlog']);
    Route::get('/edit-blog/{id}', [BlogController::class, 'editBlog']);
    Route::post('/update-blog', [BlogController::class, 'updateBlog'])->name('blog.update');
    Route::get('/dashboard', [BlogController::class, 'dashboard'])->name('dashboard');
});




