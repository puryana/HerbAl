<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // ===================== tampil ================== //
    public function indexPembayaran()
    {
        $pembayaran = Pembayaran::with('pesanan')->get(); // Mengambil semua pembayaran beserta data pesanan
        return view('admin.pembayaran', compact('pembayaran'));
    }

    // ===================== create and store ================== //
    public function createPembayaran()
    {
        $pesanan = Pesanan::all(); // Mengambil semua data pesanan
        return view('admin.tambah_pembayaran', compact('pesanan'));
    }

    public function storePembayaran(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'payment_gateway' => 'required|string|max:50',
                'transaction_id' => 'nullable|string|max:100',
                'amount' => 'required|numeric|min:0',
                'status' => 'required|in:pending,success,failed',
                'payment_date' => 'nullable|date',
            ]);

            // Simpan data pembayaran
            $pembayaran = Pembayaran::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil ditambahkan.',
                'redirect_url' => '/pembayaran',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== edit and update ================== //
    public function editPembayaran($id_pembayaran)
    {
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        $pesanan = Pesanan::all();
        return view('admin.edit_pembayaran', compact('pembayaran', 'pesanan'));
    }

    public function updatePembayaran(Request $request, $id_pembayaran)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'payment_gateway' => 'required|string|max:50',
                'transaction_id' => 'nullable|string|max:100',
                'amount' => 'required|numeric|min:0',
                'status' => 'required|in:pending,success,failed',
                'payment_date' => 'nullable|date',
            ]);

            // Perbarui data pembayaran
            $pembayaran = Pembayaran::findOrFail($id_pembayaran);
            $pembayaran->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil diperbarui.',
                'redirect_url' => '/pembayaran',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== delete ================== //
    public function destroyPembayaran($id_pembayaran)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id_pembayaran);
            $pembayaran->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil dihapus.',
                'redirect_url' => '/pembayaran',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
