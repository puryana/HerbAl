<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorit;
use Illuminate\Http\Request;

class FavoritApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $favorits = Favorit::with(['user', 'ramuan', 'produk', 'tanaman', 'penyakit', 'tips'])->get();
            return response()->json(['success' => true, 'data' => $favorits], 200);
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
                'id_ramuan' => 'nullable|exists:ramuan,id_ramuan',
                'id_produk' => 'nullable|exists:produk,id_produk',
                'id_tanaman' => 'nullable|exists:tanaman_obat,id_tanaman',
                'id_penyakit' => 'nullable|exists:penyakit,id_penyakit',
                'id_tips' => 'nullable|exists:tips,id_tips',
            ]);

            $favorit = Favorit::create($validated);

            return response()->json([
                'success' => true,
                'data' => $favorit,
                'message' => 'Favorit berhasil ditambahkan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW ================== //
    public function show($id)
    {
        try {
            $favorit = Favorit::with(['user', 'ramuan', 'produk', 'tanaman', 'penyakit', 'tips'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $favorit], 200);
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
                'id_ramuan' => 'nullable|exists:ramuan,id_ramuan',
                'id_produk' => 'nullable|exists:produk,id_produk',
                'id_tanaman' => 'nullable|exists:tanaman_obat,id_tanaman',
                'id_penyakit' => 'nullable|exists:penyakit,id_penyakit',
                'id_tips' => 'nullable|exists:tips,id_tips',
            ]);

            $favorit = Favorit::findOrFail($id);
            $favorit->update($validated);

            return response()->json([
                'success' => true,
                'data' => $favorit,
                'message' => 'Favorit berhasil diperbarui.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== DESTROY ================== //
    public function destroy($id)
    {
        try {
            $favorit = Favorit::findOrFail($id);
            $favorit->delete();

            return response()->json(['success' => true, 'message' => 'Favorit berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
