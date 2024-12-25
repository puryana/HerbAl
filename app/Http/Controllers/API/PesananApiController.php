<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $pesanans = Pesanan::with('user')->get(); // Menyertakan relasi user
            return response()->json(['success' => true, 'data' => $pesanans], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW ================== //
    public function show($id)
    {
        try {
            $pesanan = Pesanan::with('user')->findOrFail($id); // Menyertakan relasi user
            return response()->json(['success' => true, 'data' => $pesanan], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan'], 404);
        }
    }

    // ===================== UPDATE ================== //
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:menunggu,dibayar,dikirim,selesai,dibatalkan',
                'payment_status' => 'required|in:menunggu,berhasil,gagal',
                'no_resi' => 'nullable|string|max:50',
                'shipping_name' => 'nullable|string|max:50',
                'transaction_id' => 'nullable|string|max:100',
                'payment_details' => 'nullable|json',
            ]);

            $pesanan = Pesanan::findOrFail($id);
            $pesanan->update($validated);

            return response()->json([
                'success' => true,
                'data' => $pesanan,
                'message' => 'Pesanan berhasil diperbarui.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== DESTROY ================== //
    public function destroy($id)
    {
        try {
            $pesanan = Pesanan::findOrFail($id);
            $pesanan->delete();

            return response()->json(['success' => true, 'message' => 'Pesanan berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
