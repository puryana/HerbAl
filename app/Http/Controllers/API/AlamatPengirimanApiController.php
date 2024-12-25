<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlamatPengiriman;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AlamatPengirimanApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $alamatPengiriman = AlamatPengiriman::with(['user', 'pesanan'])->get();
            return response()->json(['success' => true, 'data' => $alamatPengiriman], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== STORE ================== //
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:users,id',
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'province' => 'required|string|max:100',
                'postal_code' => 'required|string|max:10',
            ]);

            $alamatPengiriman = AlamatPengiriman::create($validated);

            return response()->json(['success' => true, 'data' => $alamatPengiriman, 'message' => 'Alamat pengiriman berhasil ditambahkan'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW ================== //
    public function show($id)
    {
        try {
            $alamatPengiriman = AlamatPengiriman::with(['user', 'pesanan'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $alamatPengiriman], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
    }

    // ===================== UPDATE ================== //
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:users,id',
                'id_pesanan' => 'required|exists:pesanan,id_pesanan',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'province' => 'required|string|max:100',
                'postal_code' => 'required|string|max:10',
            ]);

            $alamatPengiriman = AlamatPengiriman::findOrFail($id);
            $alamatPengiriman->update($validated);

            return response()->json(['success' => true, 'data' => $alamatPengiriman, 'message' => 'Alamat pengiriman berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== DESTROY ================== //
    public function destroy($id)
    {
        try {
            $alamatPengiriman = AlamatPengiriman::findOrFail($id);
            $alamatPengiriman->delete();

            return response()->json(['success' => true, 'message' => 'Alamat pengiriman berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
