<?php

use App\Http\Controllers\adminherbal_controller;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RamuanController;
use App\Http\Controllers\TanamanController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\AlamatPengirimanController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// =========================================== Login ==================================================== //
Route::get('/', fn() => redirect()->route('login'));
// Login dan Logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [adminherbal_controller::class, 'index'])->name('login');
    Route::post('/login', [adminherbal_controller::class, 'login'])->name('admin.login');
});
Route::post('/logout', [adminherbal_controller::class, 'logout'])->name('logout');
// Admin Dashboard
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [adminherbal_controller::class, 'indexDashboard'])->name('admin.home');
    Route::get('/dashboard', [adminherbal_controller::class, 'dashboard'])->name('admin.dashboard');
});


// ===================== Dashboard================== //
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

// ===================== Customer ================== //
Route::get('/customers', function () {
    return view('admin.customers');
});

// ===================== kategori ================== //
Route::get('/kategori', [KategoriController::class, 'indexKategori'])->name('kategori.index');
Route::get('/tambah_kategori', [KategoriController::class, 'createKategori'])->name('kategori.create');
Route::post('kategori/store', [KategoriController::class, 'storeKategori'])->name('kategori.store');
Route::get('/kategori/{id_kategori}/edit', [KategoriController::class, 'editKategori'])->name('kategori.edit');
Route::put('/kategori/{id_kategori}', [KategoriController::class, 'updateKategori'])->name('kategori.update');
Route::delete('/kategori/{id_kategori}', [KategoriController::class, 'destroyKategori'])->name('kategori.destroy');

// ======================= produk ================== //
Route::get('/produk', [ProdukController::class, 'indexProduk'])->name('produk.index');
Route::get('/tambah_produk', [ProdukController::class, 'createProduk'])->name('produk.create');
Route::post('produk/store', [ProdukController::class, 'storeProduk'])->name('produk.store');
Route::get('/produk/{id_produk}/edit', [ProdukController::class, 'editProduk'])->name('produk.edit');
Route::put('/produk/{id_produk}', [ProdukController::class, 'updateProduk'])->name('produk.update');
Route::delete('/produk/{id_produk}', [ProdukController::class, 'destroyProduk'])->name('produk.destroy');


// ================ tanaman Obat ================== //
Route::get('/tanaman_obat', [TanamanController::class, 'indexTanaman'])->name('tanaman.index');
Route::get('/tambah_tanaman_obat', [TanamanController::class, 'createTanaman'])->name('tanaman.create');
Route::post('tanaman_obat/store', [TanamanController::class, 'storeTanaman'])->name('tanaman.store');
Route::get('/tanaman_obat/{id_tanaman}/edit', [TanamanController::class, 'editTanaman'])->name('tanaman.edit');
Route::put('/tanaman_obat/{id_tanaman}', [TanamanController::class, 'updateTanaman'])->name('tanaman.update');
Route::delete('/tanaman_obat/{id_tanaman}', [TanamanController::class, 'destroyTanaman'])->name('tanaman.destroy');

// =================== ramuan ==================== //
Route::get('/ramuan', [RamuanController::class, 'indexRamuan'])->name('ramuan.index');
Route::get('/tambah_ramuan', [RamuanController::class, 'createRamuan'])->name('ramuan.create');
Route::post('ramuan/store', [RamuanController::class, 'storeRamuan'])->name('ramuan.store');
Route::get('/ramuan/{id_ramuan}/edit', [RamuanController::class, 'editRamuan'])->name('ramuan.edit');
Route::put('/ramuan/{id_ramuan}', [RamuanController::class, 'updateRamuan'])->name('ramuan.update');
Route::delete('/ramuan/{id_ramuan}', [RamuanController::class, 'destroyRamuan'])->name('ramuan.destroy');

// ================== penyakit ================== //
Route::get('/penyakit', [PenyakitController::class, 'indexPenyakit'])->name('penyakit.index');
Route::get('/tambah_penyakit', [PenyakitController::class, 'createPenyakit'])->name('penyakit.create');
Route::post('penyakit/store', [PenyakitController::class, 'storePenyakit'])->name('penyakit.store');
Route::get('/penyakit/{id_penyakit}/edit', [PenyakitController::class, 'editPenyakit'])->name('penyakit.edit');
Route::put('/penyakit{id_penyakit}', [PenyakitController::class, 'updatePenyakit'])->name('penyakit.update');
Route::delete('/penyakit/{id_penyakit}', [PenyakitController::class, 'destroyPenyakit'])->name('penyakit.destroy');

// ================ tips sehat ================== //
Route::get('/tips_sehat', [TipsController::class, 'indexTips'])->name('tips.index');
Route::get('/tambah_tips_sehat', [TipsController::class, 'createTips'])->name('tips.create');
Route::post('tips_sehat/store', [TipsController::class, 'storeTips'])->name('tips.store');
Route::get('/tips_sehat/{id_tips}/edit', [TipsController::class, 'editTips'])->name('tips.edit');
Route::put('/tips_sehat/{id_tips}', [TipsController::class, 'updateTips'])->name('tips.update');
Route::delete('/tips_sehat/{id_tips}', [TipsController::class, 'destroyTips'])->name('tips.destroy');


// ================ keranjang ================== //
Route::get('keranjang', [KeranjangController::class, 'indexKeranjang']);
Route::post('keranjang', [KeranjangController::class, 'storeKeranjang']);
Route::delete('keranjang/{id_keranjang}', [KeranjangController::class, 'destroyKeranjang']);



Route::get('/pesanan', [PesananController::class, 'indexPesanan'])->name('pesanan.index');
Route::get('/tambah_pesanan', [PesananController::class, 'createPesanan'])->name('pesanan.create');
Route::post('pesanan/store', [PesananController::class, 'storePesanan'])->name('pesanan.store');
Route::get('/pesanan/{id_pesanan}/edit', [PesananController::class, 'editPesanan'])->name('pesanan.edit');
Route::put('/pesanan/{id_pesanan', [PesananController::class, 'updatePesanan'])->name('pesanan.update');
Route::delete('/pesanan/{id_pesanan}', [PesananController::class, 'destroyPesanan'])->name('pesanan.destroy');


// ================ Detail pesanan ================== //
Route::get('/detail-pesanan', [DetailPesananController::class, 'indexDetailPesanan']);
Route::get('/detail-pesanan/create', [DetailPesananController::class, 'createDetailPesanan']);
Route::post('/detail-pesanan', [DetailPesananController::class, 'storeDetailPesanan']);
Route::get('/detail-pesanan/{id}/edit', [DetailPesananController::class, 'editDetailPesanan']);
Route::put('/detail-pesanan/{id}', [DetailPesananController::class, 'updateDetailPesanan']);
Route::delete('/detail-pesanan/{id}', [DetailPesananController::class, 'destroyDetailPesanan']);


// ================ Alamat Pengiriman ================== //
Route::get('/alamat-pengiriman', [AlamatPengirimanController::class, 'indexAlamatPengiriman']);
Route::get('/alamat-pengiriman/create', [AlamatPengirimanController::class, 'createAlamatPengiriman']);
Route::post('/alamat-pengiriman', [AlamatPengirimanController::class, 'storeAlamatPengiriman']);
Route::get('/alamat-pengiriman/{id_pengiriman}/edit', [AlamatPengirimanController::class, 'editAlamatPengiriman']);
Route::put('/alamat-pengiriman/{id_pengiriman}', [AlamatPengirimanController::class, 'updateAlamatPengiriman']);
Route::delete('/alamat-pengiriman/{id_pengiriman}', [AlamatPengirimanController::class, 'destroyAlamatPengiriman']);

// ================ Pembayaran ================== //
Route::get('/pembayaran', [PembayaranController::class, 'indexPembayaran']);
Route::get('/pembayaran/create', [PembayaranController::class, 'createPembayaran']);
Route::post('/pembayaran', [PembayaranController::class, 'storePembayaran']);
Route::get('/pembayaran/{id_pembayaran}/edit', [PembayaranController::class, 'editPembayaran']);
Route::put('/pembayaran/{id_pembayaran}', [PembayaranController::class, 'updatePembayaran']);
Route::delete('/pembayaran/{id_pembayaran}', [PembayaranController::class, 'destroyPembayaran']);

// ================ Favorit ================== //
Route::get('/favorit', [FavoritController::class, 'indexFavorit']);
Route::get('/favorit/create', [FavoritController::class, 'createFavorit']);
Route::post('/favorit', [FavoritController::class, 'storeFavorit']);
Route::get('/favorit/{id_favorit}/edit', [FavoritController::class, 'editFavorit']);
Route::put('/favorit/{id_favorit}', [FavoritController::class, 'updateFavorit']);
Route::delete('/favorit/{id_favorit}', [FavoritController::class, 'destroyFavorit']);

// ================ Ulasan ================== //
Route::get('/ulasan', [UlasanController::class, 'indexUlasan']);
Route::get('/ulasan/create', [UlasanController::class, 'createUlasan']);
Route::post('/ulasan', [UlasanController::class, 'storeUlasan']);
Route::get('/ulasan/{id_ulasan}/edit', [UlasanController::class, 'editUlasan']);
Route::put('/ulasan/{id_ulasan}', [UlasanController::class, 'updateUlasan']);
Route::delete('/ulasan/{id_ulasan}', [UlasanController::class, 'destroyUlasan']);
