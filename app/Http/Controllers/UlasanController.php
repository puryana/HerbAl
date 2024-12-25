<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    // ===================== tampil ================== //
    public function indexUlasan()
    {
        $ulasans = Ulasan::with('user', 'commentable')->get(); // Mengambil semua ulasan beserta relasi
        return view('admin.ulasan', compact('ulasans'));
    }

    // ===================== create and store ================== //
    public function createUlasan()
    {
        return view('admin.tambah_ulasan'); // Menampilkan form untuk menambahkan ulasan
    }

    public function storeUlasan(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id' => 'required|exists:users,id',
                'commentable_id' => 'required|integer',
                'commentable_type' => 'required|string',
                'text' => 'nullable|string',
                'gambar' => 'nullable|url|max:255',
                'rating' => 'nullable|integer|between:1,5',
            ]);

            // Simpan data ulasan
            Ulasan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil ditambahkan.',
                'redirect_url' => '/ulasan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== edit and update ================== //
    public function editUlasan($id_ulasan)
    {
        $ulasan = Ulasan::findOrFail($id_ulasan);
        return view('admin.edit_ulasan', compact('ulasan'));
    }

    public function updateUlasan(Request $request, $id_ulasan)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id' => 'required|exists:users,id',
                'commentable_id' => 'required|integer',
                'commentable_type' => 'required|string',
                'text' => 'nullable|string',
                'gambar' => 'nullable|url|max:255',
                'rating' => 'nullable|integer|between:1,5',
            ]);

            // Perbarui data ulasan
            $ulasan = Ulasan::findOrFail($id_ulasan);
            $ulasan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil diperbarui.',
                'redirect_url' => '/ulasan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== delete ================== //
    public function destroyUlasan($id_ulasan)
    {
        try {
            $ulasan = Ulasan::findOrFail($id_ulasan);
            $ulasan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil dihapus.',
                'redirect_url' => '/ulasan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
