<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriApiController;
use App\Http\Controllers\API\PenyakitApiController;
use App\Http\Controllers\API\ProdukApiController;
use App\Http\Controllers\API\RamuanApiController;
use App\Http\Controllers\API\TanamanApiController;
use App\Http\Controllers\API\TipsApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// =========================== Login dan Logout ============================= //
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('api.logout');

// ========================== Kategori API ================================== //
Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriApiController::class, 'index'])->name('api.kategori.index');
    Route::post('/', [KategoriApiController::class, 'store'])->name('api.kategori.store');
    Route::get('/{id}', [KategoriApiController::class, 'edit'])->name('api.kategori.edit');
    Route::put('/{id}', [KategoriApiController::class, 'update'])->name('api.kategori.update');
    Route::delete('/{id}', [KategoriApiController::class, 'destroy'])->name('api.kategori.destroy');
});

// ========================== Produk API ==================================== //
Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukApiController::class, 'index'])->name('api.produk.index');
    Route::post('/', [ProdukApiController::class, 'store'])->name('api.produk.store');
    Route::get('/{id}', [ProdukApiController::class, 'edit'])->name('api.produk.edit');
    Route::put('/{id}', [ProdukApiController::class, 'update'])->name('api.produk.update');
    Route::delete('/{id}', [ProdukApiController::class, 'destroy'])->name('api.produk.destroy');
});

// ========================== Tanaman Obat API ============================== //
Route::prefix('tanaman')->group(function () {
    Route::get('/', [TanamanApiController::class, 'index'])->name('api.tanaman.index');
    Route::post('/', [TanamanApiController::class, 'store'])->name('api.tanaman.store');
    Route::get('/{id}', [TanamanApiController::class, 'edit'])->name('api.tanaman.edit');
    Route::put('/{id}', [TanamanApiController::class, 'update'])->name('api.tanaman.update');
    Route::delete('/{id}', [TanamanApiController::class, 'destroy'])->name('api.tanaman.destroy');
});

// ========================== Ramuan API ==================================== //
Route::prefix('ramuan')->group(function () {
    Route::get('/', [RamuanApiController::class, 'index'])->name('api.ramuan.index');
    Route::post('/', [RamuanApiController::class, 'store'])->name('api.ramuan.store');
    Route::get('/{id}', [RamuanApiController::class, 'edit'])->name('api.ramuan.edit');
    Route::put('/{id}', [RamuanApiController::class, 'update'])->name('api.ramuan.update');
    Route::delete('/{id}', [RamuanApiController::class, 'destroy'])->name('api.ramuan.destroy');
});

// ========================== Penyakit API ================================== //
Route::prefix('penyakit')->group(function () {
    Route::get('/', [PenyakitApiController::class, 'index'])->name('api.penyakit.index');
    Route::post('/', [PenyakitApiController::class, 'store'])->name('api.penyakit.store');
    Route::get('/{id}', [PenyakitApiController::class, 'edit'])->name('api.penyakit.edit');
    Route::put('/{id}', [PenyakitApiController::class, 'update'])->name('api.penyakit.update');
    Route::delete('/{id}', [PenyakitApiController::class, 'destroy'])->name('api.penyakit.destroy');
});

// ========================== Tips Sehat API ================================ //
Route::prefix('tips')->group(function () {
    Route::get('/', [TipsApiController::class, 'index'])->name('api.tips.index');
    Route::post('/', [TipsApiController::class, 'store'])->name('api.tips.store');
    Route::get('/{id}', [TipsApiController::class, 'edit'])->name('api.tips.edit');
    Route::put('/{id}', [TipsApiController::class, 'update'])->name('api.tips.update');
    Route::delete('/{id}', [TipsApiController::class, 'destroy'])->name('api.tips.destroy');
});
