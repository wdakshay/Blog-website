<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RoleListController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\Admin\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Frontend Routes
Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name("index");
Route::get('/about-us',[AppController::class,'aboutUs'])->name("about-us");
Route::get('/contact-us',[AppController::class,'contactUs'])->name("contact-us");
Route::get('/blog/{slug}',[AppController::class,'blog'])->name("front-blog");
Route::get('/category/{slug}',[AppController::class,'category'])->name("front-category");
Route::get('/submit-comment',[AppController::class,'submitComment'])->name("submit-comment");
Route::post('/search', [AppController::class, 'searchBlog'])->name('search');



//Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');

    //categories routes
    Route::get('categories',[CategoryController::class,'categories'])->name('admin-categories');
    Route::get('add-category',[CategoryController::class,'addCategory'])->name('add-category');
    Route::get('/edit-category/{id}',[CategoryController::class,'editCategory'])->name("edit-category");
    Route::post('store-category',[CategoryController::class,'storeCategory'])->name('store-category');


    //blog routes
    Route::get('blogs',[BlogController::class,'blogs'])->name('admin-blogs');
    Route::get('add-blog',[BlogController::class,'addBlog'])->name('add-blog');
    Route::get('/edit-blog/{id}',[BlogController::class,'editBlog'])->name("edit-blog");
    Route::post('store-blog',[BlogController::class,'storeBlog'])->name('store-blog');
    Route::get('/blog/{id}',[BlogController::class,'blog'])->name("admin-blog");


    //Comments Routes
    Route::get('comments',[CommentController::class,'comments'])->name('admin-comments');
    Route::get('/delete-comment/{id}',[CommentController::class,'deleteComment'])->name('delete-comment');


    //Users Routes
    Route::get('/users',[RoleListController::class,'users'])->name('admin-users');
    Route::get('/delete-user/{id}',[RoleListController::class,'deleteUser'])->name('delete-users');


    //Status Update Route
    Route::get('/update-status/{table}/{id}/{value}',[AdminController::class,'updateStatus'])->name("update-status");
});


//404 Page Route
Route::fallback(function () {
    return view('404');
});