<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;


class KeranjangApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $keranjangs = Keranjang::all();
            return response()->json(['success' => true, 'data' => $keranjangs], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== STORE ================== //
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:users,id', //id user
                'id_produk' => 'required|exists:produk,id_produk',
                'jumlah' => 'required|integer|min:1',
            ]);

            $keranjang = new Keranjang($validated);
            $keranjang->save();

            return response()->json(['success' => true, 'data' => $keranjang, 'message' => 'Item berhasil ditambahkan ke keranjang'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW BY USER ================== //
    public function showByUser($id) 
    {
        try {
            $keranjangs = Keranjang::where('id', $id)->get(); //id_user

            if ($keranjangs->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Keranjang kosong atau tidak ditemukan'], 404);
            }

            return response()->json(['success' => true, 'data' => $keranjangs], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== UPDATE ================== //
    public function update(Request $request, $id_keranjang)
    {
        try {
            $validated = $request->validate([
                'jumlah' => 'required|integer|min:1', 
            ]);

            $keranjang = Keranjang::findOrFail($id_keranjang); 
            $keranjang->jumlah = $validated['jumlah']; 
            $keranjang->save();
            return response()->json([
                'success' => true,
                'data' => $keranjang,
                'message' => 'Jumlah barang berhasil diperbarui'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== DESTROY ================== //
    public function destroy($id_keranjang)
    {
        try {
            $keranjang = Keranjang::findOrFail($id_keranjang);
            $keranjang->delete();

            return response()->json(['success' => true, 'message' => 'Item berhasil dihapus dari keranjang'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
