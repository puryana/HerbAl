<?php

namespace App\Http\Controllers;

use App\Models\AlamatPengiriman;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AlamatPengirimanController extends Controller
{
    // ===================== tampil ================== //
    public function indexAlamatPengiriman()
    {
        $alamatPengiriman = AlamatPengiriman::with(['user', 'pesanan'])->get();
        return view('admin.alamat_pengiriman', compact('alamatPengiriman'));
    }

    // ===================== create and store ================== //
    public function createAlamatPengiriman()
    {
        $users = User::all(); // Mengambil data semua pengguna
        $pesanans = Pesanan::all(); // Mengambil data semua pesanan
        return view('admin.tambah_alamat_pengiriman', compact('users', 'pesanans'));
    }

    public function storeAlamatPengiriman(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id' => 'required|exists:users,id',
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'province' => 'required|string|max:100',
                'postal_code' => 'required|string|max:10',
            ]);

            // Simpan data alamat pengiriman
            $alamatPengiriman = AlamatPengiriman::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Alamat pengiriman berhasil ditambahkan.',
                'redirect_url' => '/alamat-pengiriman',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== edit and update ================== //
    public function editAlamatPengiriman($id_pengiriman)
    {
        $alamatPengiriman = AlamatPengiriman::findOrFail($id_pengiriman);
        $users = User::all(); // Data pengguna
        $pesanans = Pesanan::all(); // Data pesanan
        return view('admin.edit_alamat_pengiriman', compact('alamatPengiriman', 'users', 'pesanans'));
    }

    public function updateAlamatPengiriman(Request $request, $id_pengiriman)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id' => 'required|exists:users,id',
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'province' => 'required|string|max:100',
                'postal_code' => 'required|string|max:10',
            ]);

            // Perbarui data alamat pengiriman
            $alamatPengiriman = AlamatPengiriman::findOrFail($id_pengiriman);
            $alamatPengiriman->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Alamat pengiriman berhasil diperbarui.',
                'redirect_url' => '/alamat-pengiriman',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== delete ================== //
    public function destroyAlamatPengiriman($id_pengiriman)
    {
        try {
            $alamatPengiriman = AlamatPengiriman::findOrFail($id_pengiriman);
            $alamatPengiriman->delete();

            return response()->json([
                'success' => true,
                'message' => 'Alamat pengiriman berhasil dihapus.',
                'redirect_url' => '/alamat-pengiriman',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
