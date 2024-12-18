<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TipsApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $tips = Tips::all();
            return response()->json(['success' => true, 'data' => $tips], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== STORE ================== //
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nama_tips' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
            'deskripsi' => 'required|string',
            'resep1' => 'required|string',
            'resep2' => 'required|string', 
            'resep3' => 'required|string',
        ]);

        try {
            // Menyimpan data Tips
            $tips = new Tips();
            $tips->nama_tips = $request->input('nama_tips');
            $tips->deskripsi = $request->input('deskripsi');
            $tips->resep1 = $request->input('resep1');
            $tips->resep2 = $request->input('resep2');
            $tips->resep3 = $request->input('resep3');

            // Menyimpan file gambar
            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/tips', $imageName);
                $tips->gambar = $imageName;
            }

            // Simpan data ke database
            $tips->save();

            return response()->json([
                'success' => true,
                'message' => 'Tips berhasil ditambahkan.',
                'data' => $tips
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // ===================== SHOW ================== //
    public function show($id)
    {
        try {
            $tips = Tips::findOrFail($id);
            return response()->json(['success' => true, 'data' => $tips], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
    }

    // ===================== UPDATE ================== //
    public function update(Request $request, $id)
    {
        // Validasi inputan form
        $request->validate([
            'nama_tips' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'deskripsi' => 'required|string',
            'resep1' => 'required|string',
            'resep2' => 'required|string', 
            'resep3' => 'required|string',
        ]);

        try {
            // Cari data Tips
            $tips = Tips::findOrFail($id);

            // Update data Tips
            $tips->nama_tips = $request->input('nama_tips');
            $tips->deskripsi = $request->input('deskripsi');
            $tips->resep1 = $request->input('resep1');
            $tips->resep2 = $request->input('resep2');
            $tips->resep3 = $request->input('resep3');

            // Cek jika ada gambar baru, upload dan ganti gambar lama
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($tips->gambar && Storage::exists('public/img/tips/' . $tips->gambar)) {
                    Storage::delete('public/img/tips/' . $tips->gambar);
                }

                // Upload gambar baru
                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/tips', $imageName);
                $tips->gambar = $imageName;
            }

            // Simpan perubahan ke database
            $tips->save();

            return response()->json([
                'success' => true,
                'message' => 'Tips berhasil diperbarui.',
                'data' => $tips
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // ===================== DELETE ================== //
    public function destroy($id)
    {
        try {
            $tips = Tips::findOrFail($id);

            // Hapus gambar jika ada
            if ($tips->gambar && Storage::exists('public/img/tips/' . $tips->gambar)) {
                Storage::delete('public/img/tips/' . $tips->gambar);
            }

            $tips->delete();

            return response()->json(['success' => true, 'message' => 'Tips berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
