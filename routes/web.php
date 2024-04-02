<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PabrikController;
use App\Http\Controllers\ProfileController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanPerhariController;
use App\Http\Controllers\LaporanPerbulanController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/edit-password', [ProfileController::class, 'changePassword'])->name('profile.edit-password');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    // Route Pabrik
    Route::controller(PabrikController::class)->group(function () {
        Route::get('pabrik', 'index')->name('pabrik.index');
        Route::get('pabrik/create', 'create')->name('pabrik.create');
        Route::post('pabrik/store', 'store')->name('pabrik.store');
        // Route::get('pabrik/{id}', 'show')->name('pabrik.show');
        Route::get('pabrik/{id}/edit', 'edit')->name('pabrik.edit');
        Route::put('pabrik/{id}', 'update')->name('pabrik.update');
        Route::delete('pabrik/delete/{id}', 'destroy')->name('pabrik.destroy');
        Route::get('/pabrik/data', 'data')->name('pabrik.data');
    });

    // Route Kategori
    Route::controller(KategoriController::class)->group(function () {
        Route::get('kategori', 'index')->name('kategori.index');
        Route::get('kategori/create', 'create')->name('kategori.create');
        Route::post('kategori/store', 'store')->name('kategori.store');
        // Route::get('kategori/{id}', 'show')->name('kategori.show');
        Route::get('kategori/{id}/edit', 'edit')->name('kategori.edit');
        Route::put('kategori/{id}', 'update')->name('kategori.update');
        Route::delete('kategori/delete/{id}', 'destroy')->name('kategori.destroy');
        Route::get('/kategori/data', 'data')->name('kategori.data');
    });

    // Route Barang
    Route::controller(BarangController::class)->group(function () {
        Route::get('barang', 'index')->name('barang.index');
        Route::get('barang/create', 'create')->name('barang.create');
        Route::post('barang/store', 'store')->name('barang.store');
        // Route::get('barang/{id}', 'show')->name('barang.show');
        Route::get('barang/{id}/edit', 'edit')->name('barang.edit');
        Route::put('barang/{id}', 'update')->name('barang.update');
        Route::delete('barang/delete/{id}', 'destroy')->name('barang.destroy');
        Route::get('/barang/data', 'data')->name('barang.data');
        Route::get('barangcetak_pdf/{id}', 'cetakPdf')->name('barangcetakpdf.cetakpdf');
    });

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

    // Route Role
    Route::controller(RoleController::class)->group(function () {
        Route::get('role', 'index')->name('role.index');
        Route::get('role/create', 'create')->name('role.create');
        Route::post('role/store', 'store')->name('role.store');
        // Route::get('role/{id}', 'show')->name('role.show');
        Route::get('role/{id}/edit', 'edit')->name('role.edit');
        Route::put('role/{id}', 'update')->name('role.update');
        Route::delete('role/delete/{id}', 'destroy')->name('role.destroy');
        Route::get('/role/data', 'data')->name('role.data');
    });

    // Route Laporan Perhari
    Route::controller(LaporanPerhariController::class)->group(function () {
        Route::get('laporan-perhari', 'index')->name('laporan-perhari.index');
        // Route::get('laporan-perhari/create', 'create')->name('laporan-perhari.create');
        // Route::post('laporan-perhari/store', 'store')->name('laporan-perhari.store');
        // Route::get('laporan-perhari/{id}', 'show')->name('laporan-perhari.show');
        Route::get('laporan-perhari/{id}/edit', 'edit')->name('laporan-perhari.edit');
        // Route::put('laporan-perhari/{id}', 'update')->name('laporan-perhari.update');
        // Route::delete('laporan-perhari/delete/{id}', 'destroy')->name('laporan-perhari.destroy');
        Route::get('/laporan-perhari/data', 'data')->name('laporan-perhari.data');
        Route::get('laporan-perhari/{id}', 'listBarang')->name('laporan-perhari.show'); // inihalaman list barang
        Route::get('/laporan-perhari/list-barang/dataListBarang', 'dataListBarang')->name('list-barang.dataListBarang');
    });

    // Route Laporan Perbulan
    Route::controller(LaporanPerbulanController::class)->group(function () {
        Route::get('laporan-perbulan', 'index')->name('laporan-perbulan.index');
        // Route::get('laporan-perbulan/create', 'create')->name('laporan-perbulan.create');
        // Route::post('laporan-perbulan/store', 'store')->name('laporan-perbulan.store');
        // Route::get('laporan-perbulan/{id}', 'show')->name('laporan-perbulan.show');
        // Route::get('laporan-perbulan/{id}/edit', 'edit')->name('laporan-perbulan.edit');
        // Route::put('laporan-perbulan/{id}', 'update')->name('laporan-perbulan.update');
        // Route::delete('laporan-perbulan/delete/{id}', 'destroy')->name('laporan-perbulan.destroy');
        Route::get('/laporan-perbulan/data', 'data')->name('laporan-perbulan.data');
    });
});


// Route::get('qrcode', function () {

//     return QrCode::size(300)->generate('A basic example of QR code!');
// });
require __DIR__ . '/auth.php';
