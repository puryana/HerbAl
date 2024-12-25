<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPesananController extends Controller
{
    // ===================== tampil ================== //
    public function indexDetailPesanan()
    {
        $detailPesanans = DetailPesanan::with(['pesanan', 'produk'])->get(); 
        return view('admin.detail_pesanan', compact('detailPesanans'));
    }

    // ===================== create and store ================== //
    public function createDetailPesanan()
    {
        $pesanans = Pesanan::all(); // Mengambil data semua pesanan
        $produks = Produk::all(); // Mengambil data semua produk
        return view('admin.tambah_detail_pesanan', compact('pesanans', 'produks'));
    }

    public function storeDetailPesanan(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'id_produk' => 'required|exists:produk,id_produk',
                'jumlah' => 'required|integer|min:1',
                'harga_satuan' => 'required|numeric|min:0',
                'subtotal' => 'required|numeric|min:0',
                'diskon' => 'nullable|numeric|min:0',
            ]);

            // Simpan data detail pesanan
            $detailPesanan = DetailPesanan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Detail pesanan berhasil ditambahkan.',
                'redirect_url' => '/detail-pesanan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== edit and update ================== //
    public function editDetailPesanan($id_detail_pesanan)
    {
        $detailPesanan = DetailPesanan::findOrFail($id_detail_pesanan);
        $pesanans = Pesanan::all(); // Data pesanan
        $produks = Produk::all(); // Data produk
        return view('admin.edit_detail_pesanan', compact('detailPesanan', 'pesanans', 'produks'));
    }

    public function updateDetailPesanan(Request $request, $id_detail_pesanan)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'id_produk' => 'required|exists:produk,id_produk',
                'jumlah' => 'required|integer|min:1',
                'harga_satuan' => 'required|numeric|min:0',
                'subtotal' => 'required|numeric|min:0',
                'diskon' => 'nullable|numeric|min:0',
            ]);

            // Perbarui data detail pesanan
            $detailPesanan = DetailPesanan::findOrFail($id_detail_pesanan);
            $detailPesanan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Detail pesanan berhasil diperbarui.',
                'redirect_url' => '/detail-pesanan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== delete ================== //
    public function destroyDetailPesanan($id_detail_pesanan)
    {
        try {
            $detailPesanan = DetailPesanan::findOrFail($id_detail_pesanan);
            $detailPesanan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Detail pesanan berhasil dihapus.',
                'redirect_url' => '/detail-pesanan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
