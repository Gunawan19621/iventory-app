<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthApi\EditApiController;
use App\Http\Controllers\Api\V1\AuthApi\LoginApiController;
use App\Http\Controllers\Api\V1\AuthApi\LogoutApiController;
use App\Http\Controllers\Api\V1\AuthApi\RegisterApiController;
use App\Http\Controllers\Api\V1\BarangApi\BarangApiController;
use App\Http\Controllers\Api\V1\PabrikApi\PabrikApiController;
use App\Http\Controllers\Api\V1\KategoriApi\KategoriApiController;
use App\Http\Controllers\Api\V1\SuratJalanApi\SuratJalanApiController;
use App\Http\Controllers\Api\V1\ListBarangnApi\ListBarangApiController;

Route::prefix('v1')->group(function () {
    Route::post('/register', RegisterApiController::class)->name('user.register');
    Route::post('/login', LoginApiController::class)->name('user.login');
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', LogoutApiController::class)->name('user.logout');
    Route::post('/user/edit', EditApiController::class)->name('user.edit');

    // Kategori
    Route::get('/kategori', [KategoriApiController::class, 'index'])->name('kategori.index');

    // Barang
    Route::get('/barang', [BarangApiController::class, 'index'])->name('barang.index');

    // Pabrik   
    Route::get('/pabrik', [PabrikApiController::class, 'index'])->name('pabrik.index');

    // Surat Jalan
    Route::get('/surat-jalan', [SuratJalanApiController::class, 'index'])->name('surat-jalan.index');
    Route::post('/surat-jalan/store', [SuratJalanApiController::class, 'store'])->name('surat-jalan.store');

    // List Barang
    Route::get('/list-barang', [ListBarangApiController::class, 'index'])->name('list-barang.index');
    Route::post('/list-barang/store', [ListBarangApiController::class, 'store'])->name('list-barang.store');
});