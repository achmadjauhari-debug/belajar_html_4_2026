<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Route::get('belajar',[BelajarController::class, 'index']);
Route::get('tambah',[BelajarController::class, 'tambah'])->name('tambah');
route::post('actionTambah', [BelajarController::class, 'actionTambah'])->name('actionTambah');
Route::get('pengurangan',[BelajarController::class, 'kurang'])->name('pengurangan');
route::post('actionKurang', [BelajarController::class, 'actionKurang'])->name('actionKurang');
Route::get('bagi',[BelajarController::class, 'bagi'])->name('bagi');
route::post('actionBagi', [BelajarController::class, 'actionBagi'])->name('actionBagi');
Route::get('perkalian',[BelajarController::class, 'kali'])->name('perkalian');;
route::post('actionKali', [BelajarController::class, 'actionKali'])->name('actionKali');

//prefix
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'login']);
    Route::post('/actionLogin', [\App\Http\Controllers\LoginController::class, 'actionLogin'])->name('actionLogin');
    Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);
    //resource bawaan dari Laravel yg sudah berisi semua method (get,post,put, dll)
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::resource('category', \App\Http\Controllers\CategoryController::class);
    Route::get('/settings', [\App\Http\Controllers\SettingController::class,'index'])->name('settings');
    Route::post('/settings', [\App\Http\Controllers\SettingController::class,'update'])->name('settings.update');
     
     });