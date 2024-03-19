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
    // Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    //Halaman Peti
    // Route::controller(PetiController::class)->group(function () {
    //     Route::get('peti', 'index')->name('peti.index');
    //     Route::get('peti/create', 'create')->name('peti.create');
    //     Route::post('peti/store', 'store')->name('peti.store');
    //     Route::get('peti/{id}', 'show')->name('peti.show');
    //     Route::get('peti/{id}/edit', 'edit')->name('peti.edit');
    //     Route::put('peti/{id}', 'update')->name('peti.update');
    //     Route::delete('peti/delete/{id}', 'destroy')->name('peti.destroy');
    //     Route::get('peticetak_pdf/{id}', 'cetakPdf')->name('peticetakpdf.cetakpdf');
    //     Route::get('all-cetak/peti', 'AllPdf')->name('all-pdf.cetakpdf');
    //     Route::post('peti/import', 'importPeti')->name('peti.import');
    //     Route::post('peti/delete-selected', 'deleteSelected')->name('peti.delete-selected');
    // });

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

    // Route Laporan
    Route::get('/laporan-perhari', [LaporanPerhariController::class, 'index'])->name('laporan-perhari');
    Route::get('/laporan-perbulan', [LaporanPerbulanController::class, 'index'])->name('laporan-perbulan');
});

require __DIR__ . '/auth.php';
