<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryBlogController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SettingController;

// Rute Belajar & Matematika
Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah'])->name('tambah');
Route::post('actionTambah', [BelajarController::class, 'actionTambah'])->name('actionTambah');
Route::get('pengurangan', [BelajarController::class, 'kurang'])->name('pengurangan');
Route::post('actionKurang', [BelajarController::class, 'actionKurang'])->name('actionKurang');
Route::get('bagi', [BelajarController::class, 'bagi'])->name('bagi');
Route::post('actionBagi', [BelajarController::class, 'actionBagi'])->name('actionBagi');
Route::get('perkalian', [BelajarController::class, 'kali'])->name('perkalian');
Route::post('actionKali', [BelajarController::class, 'actionKali'])->name('actionKali');

// GRUP ROUTE ADMIN
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');
   
    // PERBAIKAN 1: Menambahkan tanda kurung (function() pada group
    Route::middleware(['auth'])->group(function() {
        Route::resource('/dashboard', DashboardController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/category', CategoryController::class);
        Route::resource('/product', ProductController::class);
        
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
        
        
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::resource('/category_blog', CategoryBlogController::class);
        Route::resource('blog', BlogController::class);
        
        });
}); // PERBAIKAN 2: Menutup kurung group untuk prefix('admin') secara benar di sini

// GRUP ROUTE PUBLIK / DEPAN (Sudah terpisah dari prefix admin)
Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{slug}', [CatalogController::class, 'category'])->name('category.show');
Route::get('/product', [CatalogController::class, 'listing'])->name('product.index');
Route::get('/product/{slug}', [CatalogController::class, 'product'])->name('product.show');
Route::get('/outlet', [PageController::class, 'outlet'])->name('outlet.index');
Route::get('/faq', [PageController::class, 'faq'])->name('faq.index');
Route::get('/contact', [PageController::class, 'contact'])->name('contact.index');
Route::get('/blog', [PageController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [PageController::class, 'blogShow'])->name('blog.show');
