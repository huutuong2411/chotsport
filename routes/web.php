<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BlogController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['prefix'=>'/admin',], function () {
	// Login-logout
	Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
	Route::post('/login', [LoginController::class, 'login'])->name('admin.login.post');
	Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
	// dashboard
	Route::get('/home', [DashboardController::class, 'index'])->name('admin.dashboard');
	// profile
	Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
	Route::post('/profile', [ProfileController::class, 'update_profile'])->name('admin.profile.post');
	// mặt hàng
		// Danh mục
	Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
	Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.add');
	Route::post('/category/{id}', [CategoryController::class, 'update'])->name('admin.category.edit');
	Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');
		// Thương hiệu
	Route::get('/brand', [BrandController::class, 'index'])->name('admin.brand');
	Route::post('/brand', [BrandController::class, 'store'])->name('admin.brand.add');
	Route::post('/brand/{id}', [BrandController::class, 'update'])->name('admin.brand.edit');
	Route::get('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('admin.brand.delete');
		// Bài viết:
	Route::get('/blog', [BlogController::class, 'index'])->name('admin.blog');
	Route::get('/blog/add', [BlogController::class, 'create'])->name('admin.blog.create');
	Route::post('/blog/add', [BlogController::class, 'store'])->name('admin.blog.store');
	Route::get('/blog/{id}', [BlogController::class, 'show'])->name('admin.blog.show');
	Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
	Route::post('/blog/{id}/edit', [BlogController::class, 'update'])->name('admin.blog.update');
	Route::get('/blog/{id}/delete', [BlogController::class, 'destroy'])->name('admin.blog.delete');
});