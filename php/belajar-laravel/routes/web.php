<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('belajar',[BelajarController::class, 'index']);
Route::get('tambah',[BelajarController::class, 'tambah'])->name('tambah');
route::post('actionTambah', [BelajarController::class, 'actionTambah'])->name('actionTambah');
Route::get('pengurangan',[BelajarController::class, 'kurang'])->name('pengurangan');
route::post('actionKurang', [BelajarController::class, 'actionKurang'])->name('actionKurang');
Route::get('bagi',[BelajarController::class, 'bagi'])->name('bagi');
route::post('actionBagi', [BelajarController::class, 'actionBagi'])->name('actionBagi');
Route::get('perkalian',[BelajarController::class, 'kali'])->name('perkalian');;
route::post('actionKali', [BelajarController::class, 'actionKali'])->name('actionKali');