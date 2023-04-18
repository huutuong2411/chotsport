<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AjaxAddressController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Login-logout
Route::get('/adminlogin', [LoginController::class, 'index'])->name('admin.login');
Route::post('/adminlogin', [LoginController::class, 'login'])->name('admin.login.post');
Route::get('/adminlogout', [LoginController::class, 'logout'])->name('admin.logout');
// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// profile
Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
Route::post('/profile', [ProfileController::class, 'update_profile'])->name('admin.profile.post');
