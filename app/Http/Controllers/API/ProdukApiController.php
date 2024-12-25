<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $produks = Produk::all();
            return response()->json(['success' => true, 'data' => $produks], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== STORE ================== //
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_kategori' => 'required|exists:kategoris,id',
                'nama_produk' => 'required|string|max:255',
                'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'harga' => 'required|string',
                'stock' => 'required|integer|min:0',
                'deskripsi' => 'required|string',
                'manfaat' => 'required|string',
                'efekSamping' => 'required|string',
                'waktuKonsumsi' => 'required|string',
            ]);

            $produk = new Produk($validated);

            // Menyimpan file gambar
            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/produk', $imageName);
                $produk->gambar = $imageName;
            }

            $produk->save();

            return response()->json(['success' => true, 'data' => $produk, 'message' => 'Produk berhasil ditambahkan'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW ================== //
    public function show($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            return response()->json(['success' => true, 'data' => $produk], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
    }

    // ===================== UPDATE ================== //
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'id_kategori' => 'required|exists:kategoris,id',
                'nama_produk' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'harga' => 'required|string',
                'stock' => 'required|integer|min:0',
                'deskripsi' => 'required|string',
                'manfaat' => 'required|string',
                'efekSamping' => 'required|string',
                'waktuKonsumsi' => 'required|string',
            ]);

            $produk = Produk::findOrFail($id);
            $produk->fill($validated);

            // Jika ada gambar baru
            if ($request->hasFile('gambar')) {
                if ($produk->gambar && Storage::exists('public/img/produk/' . $produk->gambar)) {
                    Storage::delete('public/img/produk/' . $produk->gambar);
                }

                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/produk', $imageName);
                $produk->gambar = $imageName;
            }

            $produk->save();

            return response()->json(['success' => true, 'data' => $produk, 'message' => 'Produk berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== DESTROY ================== //
    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);

            // Hapus gambar jika ada
            if ($produk->gambar && Storage::exists('public/img/produk/' . $produk->gambar)) {
                Storage::delete('public/img/produk/' . $produk->gambar);
            }

            $produk->delete();

            return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
