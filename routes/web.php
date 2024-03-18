<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PabrikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanPerhariController;
use App\Http\Controllers\LaporanPerbulanController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/pabrik', [PabrikController::class, 'index'])->name('pabrik');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang');

    // Route User
    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'index')->name('user.index');
        Route::get('user/create', 'create')->name('user.create');
        Route::post('user/store', 'store')->name('user.store');
        // Route::get('user/{id}', 'show')->name('user.show');
        Route::get('user/{id}/edit', 'edit')->name('user.edit');
        Route::put('user/{id}', 'update')->name('user.update');
        Route::delete('user/delete/{id}', 'destroy')->name('user.destroy');

        Route::get('/user/data', 'data')->name('user.data');
    });

    // Route::get('/user', [UserController::class, 'index'])->name('user');

    Route::get('/role', [RoleController::class, 'index'])->name('role');
    Route::get('/laporan-perhari', [LaporanPerhariController::class, 'index'])->name('laporan-perhari');
    Route::get('/laporan-perbulan', [LaporanPerbulanController::class, 'index'])->name('laporan-perbulan');
});

require __DIR__ . '/auth.php';