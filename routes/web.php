<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;

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
	Route::get('/category/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.delete');
	Route::get('/category/trash', [CategoryController::class, 'trash'])->name('admin.category.trash');
	Route::get('/category/{id}/restore', [CategoryController::class, 'restore'])->name('admin.category.restore');
		// Thương hiệu
	Route::get('/brand', [BrandController::class, 'index'])->name('admin.brand');
	Route::post('/brand', [BrandController::class, 'store'])->name('admin.brand.add');
	Route::post('/brand/{id}', [BrandController::class, 'update'])->name('admin.brand.edit');
	Route::get('/brand/{id}/delete', [BrandController::class, 'destroy'])->name('admin.brand.delete');
	Route::get('/brand/trash', [BrandController::class, 'trash'])->name('admin.brand.trash');
	Route::get('/brand/{id}/restore', [BrandController::class, 'restore'])->name('admin.brand.restore');
		// Bài viết:
	Route::get('/blog', [BlogController::class, 'index'])->name('admin.blog');
	Route::get('/blog/add', [BlogController::class, 'create'])->name('admin.blog.create');
	Route::post('/blog/add', [BlogController::class, 'store'])->name('admin.blog.store');
	Route::get('/blog/{id}', [BlogController::class, 'show'])->name('admin.blog.show');
	Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
	Route::post('/blog/{id}/edit', [BlogController::class, 'update'])->name('admin.blog.update');
	Route::get('/blog/{id}/delete', [BlogController::class, 'destroy'])->name('admin.blog.delete');
		// Quản lý size
	Route::get('/size', [SizeController::class, 'index'])->name('admin.size');
	Route::post('/size', [SizeController::class, 'store'])->name('admin.size.add');
	Route::post('/size/{id}/edit', [SizeController::class, 'update'])->name('admin.size.edit');
	Route::get('/size/{id}/delete', [SizeController::class, 'destroy'])->name('admin.size.delete');
	Route::get('/size/{id}/restore', [SizeController::class, 'restore'])->name('admin.size.restore');
		// Quản lý banner
	Route::get('/banner', [BannerController::class, 'index'])->name('admin.banner');
	Route::post('/banner', [BannerController::class, 'store'])->name('admin.banner.add');
	Route::post('/banner/{id}/edit', [BannerController::class, 'update'])->name('admin.banner.edit');
	Route::get('/banner/{id}/delete', [BannerController::class, 'destroy'])->name('admin.banner.delete');
		// Quản lý sản phẩm
	Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
	Route::get('/product/add', [ProductController::class, 'create'])->name('admin.product.create');
	Route::post('/product/add', [ProductController::class, 'store'])->name('admin.product.store');
	Route::get('/product/trash', [ProductController::class, 'trash'])->name('admin.product.trash');
	Route::get('/product/{id}', [ProductController::class, 'show'])->name('admin.product.show');
	Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
	Route::post('/product/{id}/edit', [ProductController::class, 'update'])->name('admin.product.update');
	Route::get('/product/{id}/delete', [ProductController::class, 'destroy'])->name('admin.product.delete');
	Route::get('/product/{id}/restore', [ProductController::class, 'restore'])->name('admin.product.restore');
});