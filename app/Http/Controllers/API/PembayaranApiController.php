<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PembayaranApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $pembayaran = Pembayaran::with('pesanan')->get();
            return response()->json(['success' => true, 'data' => $pembayaran], 200);
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
                'payment_gateway' => 'required|string|max:50',
                'transaction_id' => 'nullable|string|max:100',
                'amount' => 'required|numeric|min:0',
                'status' => 'required|in:pending,success,failed',
                'payment_date' => 'nullable|date',
            ]);

            $pembayaran = Pembayaran::create($validated);

            return response()->json([
                'success' => true,
                'data' => $pembayaran,
                'message' => 'Pembayaran berhasil ditambahkan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW ================== //
    public function show($id)
    {
        try {
            $pembayaran = Pembayaran::with('pesanan')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $pembayaran], 200);
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
                'payment_gateway' => 'required|string|max:50',
                'transaction_id' => 'nullable|string|max:100',
                'amount' => 'required|numeric|min:0',
                'status' => 'required|in:pending,success,failed',
                'payment_date' => 'nullable|date',
            ]);

            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->update($validated);

            return response()->json([
                'success' => true,
                'data' => $pembayaran,
                'message' => 'Pembayaran berhasil diperbarui.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== DESTROY ================== //
    public function destroy($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->delete();

            return response()->json(['success' => true, 'message' => 'Pembayaran berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
