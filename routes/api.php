<?php

use App\Http\Controllers\Api\AlamatPengirimanApiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\DetailPesananApiController;
use App\Http\Controllers\Api\FavoritApiController;
use App\Http\Controllers\API\KategoriApiController;
use App\Http\Controllers\Api\KeranjangApiController;
use App\Http\Controllers\Api\PembayaranApiController;
use App\Http\Controllers\API\PenyakitApiController;
use App\Http\Controllers\Api\PesananApiController;
use App\Http\Controllers\API\ProdukApiController;
use App\Http\Controllers\API\RamuanApiController;
use App\Http\Controllers\API\TanamanApiController;
use App\Http\Controllers\API\TipsApiController;
use App\Http\Controllers\Api\UlasanApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\KeranjangController;
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

// ========================== User API ================================ //
Route::prefix('user')->group(function () {
    Route::post('/login-with-uid', [UserApiController::class, 'loginWithUID'])->name('api.user.loginWithUID');
});

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

// ================ keranjang API ================== //
Route::prefix('keranjang')->group(function () {
    Route::get('/', [KeranjangApiController::class, 'index'])->name('api.keranjang.index'); 
    Route::post('/', [KeranjangApiController::class, 'store'])->name('api.keranjang.store'); 
    Route::get('/user/{id}', [KeranjangApiController::class, 'showByUser'])->name('api.keranjang.showByUser'); 
    Route::put('/{id}', [KeranjangApiController::class, 'update'])->name('api.keranjang.update'); 
    Route::delete('/{id}', [KeranjangApiController::class, 'destroy'])->name('api.keranjang.destroy'); 
});

// ========================== Pesanan API ================================ //
Route::prefix('pesanan')->group(function () {
    Route::get('/', [PesananApiController::class, 'index'])->name('api.pesanan.index');
    Route::post('/', [PesananApiController::class, 'store'])->name('api.pesanan.store');
    Route::get('/{id}', [PesananApiController::class, 'edit'])->name('api.pesanan.edit');
    Route::put('/{id}', [PesananApiController::class, 'update'])->name('api.pesanan.update');
    Route::delete('/{id}', [PesananApiController::class, 'destroy'])->name('api.pesanan.destroy');
});

// ========================== Detail Pesanan API ================================ //
Route::prefix('detail-pesanan')->group(function () {
    Route::get('/', [DetailPesananApiController::class, 'index'])->name('api.detail-pesanan.index');
    Route::post('/', [DetailPesananApiController::class, 'store'])->name('api.detail-pesanan.store');
    Route::get('/{id}', [DetailPesananApiController::class, 'show'])->name('api.detail-pesanan.show');
    Route::put('/{id}', [DetailPesananApiController::class, 'update'])->name('api.detail-pesanan.update');
    Route::delete('/{id}', [DetailPesananApiController::class, 'destroy'])->name('api.detail-pesanan.destroy');
});

// ========================== Alamat Pengiriman API ================================ //
Route::prefix('alamat-pengiriman')->group(function () {
    Route::get('/', [AlamatPengirimanApiController::class, 'index'])->name('api.alamat-pengiriman.index');
    Route::post('/', [AlamatPengirimanApiController::class, 'store'])->name('api.alamat-pengiriman.store');
    Route::get('/{id}', [AlamatPengirimanApiController::class, 'show'])->name('api.alamat-pengiriman.show');
    Route::put('/{id}', [AlamatPengirimanApiController::class, 'update'])->name('api.alamat-pengiriman.update');
    Route::delete('/{id}', [AlamatPengirimanApiController::class, 'destroy'])->name('api.alamat-pengiriman.destroy');
});

// ========================== pembayaran API ================================ //
Route::prefix('pembayaran')->group(function () {
    Route::get('/', [PembayaranApiController::class, 'index'])->name('api.pembayaran.index');
    Route::post('/', [PembayaranApiController::class, 'store'])->name('api.pembayaran.store');
    Route::get('/{id}', [PembayaranApiController::class, 'show'])->name('api.pembayaran.show');
    Route::put('/{id}', [PembayaranApiController::class, 'update'])->name('api.pembayaran.update');
    Route::delete('/{id}', [PembayaranApiController::class, 'destroy'])->name('api.pembayaran.destroy');
});

// ========================== Favorit API ================================ //
Route::prefix('favorit')->group(function () {
    Route::get('/', [FavoritApiController::class, 'index'])->name('api.favorit.index');
    Route::post('/', [FavoritApiController::class, 'store'])->name('api.favorit.store');
    Route::get('/{id}', [FavoritApiController::class, 'show'])->name('api.favorit.show');
    Route::put('/{id}', [FavoritApiController::class, 'update'])->name('api.favorit.update');
    Route::delete('/{id}', [FavoritApiController::class, 'destroy'])->name('api.favorit.destroy');
});

// ========================== Ulasan API ================================ //
Route::prefix('ulasan')->group(function () {
    Route::get('/', [UlasanApiController::class, 'index'])->name('api.ulasan.index');
    Route::post('/', [UlasanApiController::class, 'store'])->name('api.ulasan.store');
    Route::get('/{id}', [UlasanApiController::class, 'show'])->name('api.ulasan.show');
    Route::put('/{id}', [UlasanApiController::class, 'update'])->name('api.ulasan.update');
    Route::delete('/{id}', [UlasanApiController::class, 'destroy'])->name('api.ulasan.destroy');
});