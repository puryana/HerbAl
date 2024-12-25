<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $ulasans = Ulasan::with('user', 'commentable')->get();
            return response()->json(['success' => true, 'data' => $ulasans], 200);
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
                'commentable_id' => 'required|integer',
                'commentable_type' => 'required|string',
                'text' => 'nullable|string',
                'gambar' => 'nullable|url|max:255',
                'rating' => 'nullable|integer|between:1,5',
            ]);

            $ulasan = Ulasan::create($validated);

            return response()->json([
                'success' => true,
                'data' => $ulasan,
                'message' => 'Ulasan berhasil ditambahkan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW ================== //
    public function show($id)
    {
        try {
            $ulasan = Ulasan::with('user', 'commentable')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $ulasan], 200);
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
                'commentable_id' => 'required|integer',
                'commentable_type' => 'required|string',
                'text' => 'nullable|string',
                'gambar' => 'nullable|url|max:255',
                'rating' => 'nullable|integer|between:1,5',
            ]);

            $ulasan = Ulasan::findOrFail($id);
            $ulasan->update($validated);

            return response()->json([
                'success' => true,
                'data' => $ulasan,
                'message' => 'Ulasan berhasil diperbarui.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== DESTROY ================== //
    public function destroy($id)
    {
        try {
            $ulasan = Ulasan::findOrFail($id);
            $ulasan->delete();

            return response()->json(['success' => true, 'message' => 'Ulasan berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
