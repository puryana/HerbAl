<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class KategoriApiController extends Controller
{
    // ===================== Index: Tampilkan Semua Kategori ================== //
    public function index()
    {
        $kategoris = Kategori::all();

        return response()->json([
            'success' => true,
            'data' => $kategoris,
        ], 200);
    }

    // ===================== Store: Tambah Kategori Baru ================== //
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Menyimpan data kategori
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->input('nama_kategori');

        // Menyimpan file gambar
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/kategori', $imageName);
            $kategori->gambar = $imageName;
        }

        // Simpan ke database
        $kategori->save();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan!',
            'data' => $kategori,
        ], 201);
    }

    // ===================== Show: Tampilkan Satu Kategori ================== //
    public function show($id_kategori)
    {
        $kategori = Kategori::find($id_kategori);

        if ($kategori) {
            return response()->json([
                'success' => true,
                'data' => $kategori,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Kategori tidak ditemukan!',
        ], 404);
    }

    // ===================== Update: Ubah Data Kategori ================== //
    public function update(Request $request, $id_kategori)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cari data kategori
        $kategori = Kategori::find($id_kategori);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan!',
            ], 404);
        }

        // Update nama kategori
        $kategori->nama_kategori = $request->input('nama_kategori');

        // Jika ada gambar baru, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('gambar')) {
            if ($kategori->gambar && Storage::exists('public/img/kategori/' . $kategori->gambar)) {
                Storage::delete('public/img/kategori/' . $kategori->gambar);
            }

            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/kategori', $imageName);
            $kategori->gambar = $imageName;
        }

        // Simpan perubahan
        $kategori->save();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui!',
            'data' => $kategori,
        ], 200);
    }

    // ===================== Destroy: Hapus Kategori ================== //
    public function destroy($id_kategori)
    {
        $kategori = Kategori::find($id_kategori);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan!',
            ], 404);
        }

        // Hapus gambar jika ada
        if ($kategori->gambar && Storage::exists('public/img/kategori/' . $kategori->gambar)) {
            Storage::delete('public/img/kategori/' . $kategori->gambar);
        }

        // Hapus data kategori
        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus!',
        ], 200);
    }
}
