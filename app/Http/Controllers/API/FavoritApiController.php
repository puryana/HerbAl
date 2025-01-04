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
            $favorits = Favorit::all();
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

            // Loop untuk setiap kategori item
            $categories = ['id_ramuan', 'id_produk', 'id_tanaman', 'id_penyakit', 'id_tips'];
            foreach ($categories as $category) {
                if (isset($validated[$category]) && $validated[$category]) {
                    // Cek apakah kategori ini sudah ada untuk user
                    $existingFavorit = Favorit::where('id', $validated['id'])->where($category, $validated[$category])->first();

                    if (!$existingFavorit) {
                        // Tambahkan baris baru jika belum ada data untuk kategori ini
                        Favorit::create([
                            'id' => $validated['id'],
                            $category => $validated[$category],
                        ]);
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Favorit berhasil ditambahkan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW BY USER ================== //
    public function show($id) 
    {
        try {
            $favorit = Favorit::with('ramuan', 'produk', 'tanaman', 'penyakit', 'tips') 
                ->where('id', $id) // Pastikan ini sesuai dengan user ID
                ->get();

            return response()->json([
                'success' => true,
                'data' => $favorit
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }


    // ===================== UPDATE ================== //
    // public function update(Request $request, $id_favorit)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'id' => 'required|exists:users,id',
    //             'id_ramuan' => 'nullable|exists:ramuan,id_ramuan',
    //             'id_produk' => 'nullable|exists:produk,id_produk',
    //             'id_tanaman' => 'nullable|exists:tanaman_obat,id_tanaman',
    //             'id_penyakit' => 'nullable|exists:penyakit,id_penyakit',
    //             'id_tips' => 'nullable|exists:tips,id_tips',
    //         ]);

    //         $favorit = Favorit::findOrFail($id_favorit);

    //         foreach ($validated as $key => $value) {
    //             if ($value && $favorit->$key !== $value) {
    //                 $favorit->$key = $value;
    //             }
    //         }

    //         $favorit->save();

    //         return response()->json([
    //             'success' => true,
    //             'data' => $favorit,
    //             'message' => 'Favorit berhasil diperbarui.',
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    //     }
    // }

    // ===================== DESTROY ================== //
    public function destroy($id_favorit)
    {
        try {
            // Cari favorit berdasarkan ID Favorit
            $favorit = Favorit::find($id_favorit);

            // Jika tidak ditemukan, berikan respons error
            if (!$favorit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Favorit tidak ditemukan.',
                ], 404);
            }

            // Hapus data favorit
            $favorit->delete();

            return response()->json([
                'success' => true,
                'message' => 'Favorit berhasil dihapus.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


}
