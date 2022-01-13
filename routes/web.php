<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class,'index'])->name('home');
Auth::routes();
//blogpost
Route::get('/blog', [App\Http\Controllers\HomeController::class,'blogPost'])->name('blog');
//single post
Route::get('/post/{id}', [App\Http\Controllers\HomeController::class, 'singlePost'])->name('single.post');
//blog categories
Route::get('/blog/categories', [App\Http\Controllers\HomeController::class, 'blogCategory'])->name('blog.category');
//latest post
Route::get('/latest-post', [App\Http\Controllers\HomeController::class, 'latestPost'])->name('blog.category');
//post by category
Route::get('/category/post/{id}', [App\Http\Controllers\HomeController::class, 'postByCategory'])->name('category.post');
//search post
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

//Route::get('/{any}',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->where('any', '.*');
//blogpost

Route::group(['prefix'=> 'admin', 'middleware'=> 'auth'], function(){
    //category
    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category');
    Route::post('/category/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/destroy/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::get('/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
//    delete by checkbox
    Route::get('/category-destroy/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deleteByCheckbox'])->name('admin.category-delete');

    //post
    Route::get('/post', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.post');
    Route::post('/post/store', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('admin.post.store');
    Route::get('/post/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.post.edit');
    Route::post('/post/update/{id}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('admin.post.update');
    Route::get('/post/destroy/{id}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('admin.post.destroy');
});
