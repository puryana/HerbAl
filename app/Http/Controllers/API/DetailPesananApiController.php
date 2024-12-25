<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPesananApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $detailPesanans = DetailPesanan::with(['pesanan', 'produk'])->get();
            return response()->json(['success' => true, 'data' => $detailPesanans], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== STORE ================== //
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'id_produk' => 'required|exists:produk,id_produk',
                'jumlah' => 'required|integer|min:1',
                'harga_satuan' => 'required|numeric|min:0',
                'subtotal' => 'required|numeric|min:0',
                'diskon' => 'nullable|numeric|min:0',
            ]);

            $detailPesanan = DetailPesanan::create($validated);

            return response()->json(['success' => true, 'data' => $detailPesanan, 'message' => 'Detail pesanan berhasil ditambahkan'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW ================== //
    public function show($id)
    {
        try {
            $detailPesanan = DetailPesanan::with(['pesanan', 'produk'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $detailPesanan], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
    }

    // ===================== UPDATE ================== //
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'id_produk' => 'required|exists:produk,id_produk',
                'jumlah' => 'required|integer|min:1',
                'harga_satuan' => 'required|numeric|min:0',
                'subtotal' => 'required|numeric|min:0',
                'diskon' => 'nullable|numeric|min:0',
            ]);

            $detailPesanan = DetailPesanan::findOrFail($id);
            $detailPesanan->update($validated);

            return response()->json(['success' => true, 'data' => $detailPesanan, 'message' => 'Detail pesanan berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== DESTROY ================== //
    public function destroy($id)
    {
        try {
            $detailPesanan = DetailPesanan::findOrFail($id);
            $detailPesanan->delete();

            return response()->json(['success' => true, 'message' => 'Detail pesanan berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
