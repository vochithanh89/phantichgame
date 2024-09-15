<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::feeds();

Route::middleware('guest')->group(function () {
    Route::get('dang-nhap', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('dang-nhap', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('dang-xuat', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(BlogController::class)->name('blog.')->group(function () {
    Route::get('/bai-viet-moi-nhat', 'index')->name('index');
    Route::get('/tim-kiem', 'viewSearch')->name('viewSearch');
    Route::get('/tag-{slug}', 'viewTag')->name('viewTag');
    Route::get('/{category_slug}/{slug}', 'viewPost')->name('viewPost');
    Route::get('/{slug}', 'viewCategory')->name('viewCategory');
});


