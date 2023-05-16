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
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\PrintPDFController;

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


// route của admin
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
	Route::get('/password', [ProfileController::class, 'changepass'])->name('admin.changepass');
	Route::post('/password', [ProfileController::class, 'updatepass'])->name('admin.changepass.post');
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
	Route::get('/blog/{id}/show', [BlogController::class, 'show'])->name('admin.blog.show');
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
	Route::get('/product/{id}/show', [ProductController::class, 'show'])->name('admin.product.show');
	Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
	Route::post('/product/{id}/edit', [ProductController::class, 'update'])->name('admin.product.update');
	Route::get('/product/{id}/delete', [ProductController::class, 'destroy'])->name('admin.product.delete');
	Route::get('/product/trash', [ProductController::class, 'trash'])->name('admin.product.trash');
	Route::get('/product/{id}/restore', [ProductController::class, 'restore'])->name('admin.product.restore');
		// Quản lý nhà cung cấp
	Route::get('/vendor', [VendorController::class, 'index'])->name('admin.vendor');
	Route::post('/vendor', [VendorController::class, 'store'])->name('admin.vendor.add');
	Route::post('/vendor/{id}/edit', [VendorController::class, 'update'])->name('admin.vendor.edit');
	Route::get('/vendor/{id}/delete', [VendorController::class, 'destroy'])->name('admin.vendor.delete');
	Route::get('/vendor/trash', [VendorController::class, 'trash'])->name('admin.vendor.trash');
	Route::get('/vendor/{id}/restore', [VendorController::class, 'restore'])->name('admin.vendor.restore');
		// Quản lý đơn nhập kho
	Route::get('/purchase', [PurchaseController::class, 'index'])->name('admin.purchase');
	Route::get('/purchase/add', [PurchaseController::class, 'create'])->name('admin.purchase.create');
	Route::post('/purchase/add', [PurchaseController::class, 'store'])->name('admin.purchase.store');
	Route::get('/purchase/{id}/show', [PurchaseController::class, 'show'])->name('admin.purchase.show');
	Route::get('/purchase/{id}/edit', [PurchaseController::class, 'edit'])->name('admin.purchase.edit');
	Route::post('/purchase/{id}/edit', [PurchaseController::class, 'update'])->name('admin.purchase.update');
	Route::get('/purchase/{id}/delete', [PurchaseController::class, 'destroy'])->name('admin.purchase.delete');
	Route::get('/purchase/print/{id_purchase}', [PrintPDFController::class, 'printPDF'])->name('admin.purchase.print');
});

