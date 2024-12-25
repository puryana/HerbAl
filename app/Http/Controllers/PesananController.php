<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // ===================== tampil ================== //
    public function indexPesanan()
    {
        $pesanans = Pesanan::with('user')->get(); // Mengambil semua pesanan beserta data pengguna
        return view('admin.pesanan', compact('pesanans'));
    }

    // ===================== create and store ================== //
    public function createPesanan()
    {
        $users = User::all(); // Mengambil data semua pengguna
        return view('admin.tambah_pesanan', compact('users'));
    }

    public function storePesanan(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id' => 'required|exists:users,id', //id user
                'total' => 'required|numeric|min:0',
                'biaya_pengiriman' => 'required|numeric|min:0',
                'status' => 'required|in:menunggu,dibayar,dikirim,selesai,dibatalkan',
                'payment_method' => 'nullable|string|max:50',
                'payment_status' => 'required|in:menunggu,berhasil,gagal',
                'no_resi' => 'nullable|string|max:50',
                'shipping_name' => 'nullable|string|max:50',
                'transaction_id' => 'nullable|string|max:100',
                'payment_details' => 'nullable|json',
            ]);

            // Simpan data pesanan
            $pesanan = Pesanan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil ditambahkan.',
                'redirect_url' => '/pesanan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== edit and update ================== //
    public function editPesanan($id_pesanan)
    {
        $pesanan = Pesanan::findOrFail($id_pesanan);
        $users = User::all();
        return view('admin.edit_pesanan', compact('pesanan', 'users'));
    }

    public function updatePesanan(Request $request, $id_pesanan)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id' => 'required|exists:users,id', //id user
                'total' => 'required|numeric|min:0',
                'biaya_pengiriman' => 'required|numeric|min:0',
                'status' => 'required|in:menunggu,dibayar,dikirim,selesai,dibatalkan',
                'payment_method' => 'nullable|string|max:50',
                'payment_status' => 'required|in:menunggu,berhasil,gagal',
                'no_resi' => 'nullable|string|max:50',
                'shipping_name' => 'nullable|string|max:50',
                'transaction_id' => 'nullable|string|max:100',
                'payment_details' => 'nullable|json',
            ]);

            // Perbarui data pesanan
            $pesanan = Pesanan::findOrFail($id_pesanan);
            $pesanan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil diperbarui.',
                'redirect_url' => '/pesanan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== delete ================== //
    public function destroyPesanan($id_pesanan)
    {
        try {
            $pesanan = Pesanan::findOrFail($id_pesanan);
            $pesanan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dihapus.',
                'redirect_url' => '/pesanan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
