<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use Illuminate\Http\Request;

class FavoritController extends Controller
{
    // ===================== tampil ================== //
    public function indexFavorit()
    {
        $favorits = Favorit::with(['user', 'ramuan', 'produk', 'tanaman', 'penyakit', 'tips'])->get(); // Mengambil semua favorit beserta relasi
        return view('admin.favorit', compact('favorits'));
    }

    // ===================== create and store ================== //
    public function createFavorit()
    {
        return view('admin.tambah_favorit'); // Menampilkan form untuk menambahkan favorit
    }

    public function storeFavorit(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id' => 'required|exists:users,id',
                'id_ramuan' => 'nullable|exists:ramuan,id_ramuan',
                'id_produk' => 'nullable|exists:produk,id_produk',
                'id_tanaman' => 'nullable|exists:tanaman_obat,id_tanaman',
                'id_penyakit' => 'nullable|exists:penyakit,id_penyakit',
                'id_tips' => 'nullable|exists:tips,id_tips',
            ]);

            // Simpan data favorit
            Favorit::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Favorit berhasil ditambahkan.',
                'redirect_url' => '/favorit',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== edit and update ================== //
    public function editFavorit($id_favorit)
    {
        $favorit = Favorit::findOrFail($id_favorit);
        return view('admin.edit_favorit', compact('favorit'));
    }

    public function updateFavorit(Request $request, $id_favorit)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id' => 'required|exists:users,id',
                'id_ramuan' => 'nullable|exists:ramuan,id_ramuan',
                'id_produk' => 'nullable|exists:produk,id_produk',
                'id_tanaman' => 'nullable|exists:tanaman_obat,id_tanaman',
                'id_penyakit' => 'nullable|exists:penyakit,id_penyakit',
                'id_tips' => 'nullable|exists:tips,id_tips',
            ]);

            // Perbarui data favorit
            $favorit = Favorit::findOrFail($id_favorit);
            $favorit->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Favorit berhasil diperbarui.',
                'redirect_url' => '/favorit',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== delete ================== //
    public function destroyFavorit($id_favorit)
    {
        try {
            $favorit = Favorit::findOrFail($id_favorit);
            $favorit->delete();

            return response()->json([
                'success' => true,
                'message' => 'Favorit berhasil dihapus.',
                'redirect_url' => '/favorit',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
