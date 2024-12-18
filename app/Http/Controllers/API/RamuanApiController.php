<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ramuan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RamuanApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $ramuans = Ramuan::all();
            return response()->json(['success' => true, 'data' => $ramuans], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== STORE ================== //
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_kategori'      => 'required|exists:kategoris,id',
                'nama_ramuan'      => 'required|string|max:255',
                'gambar'           => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'deskripsi'        => 'required|string',
                'manfaat'          => 'required|string',
                'efekSamping'      => 'required|string',
                'waktuKonsumsi'    => 'required|string',
                'saranPenggunaan'  => 'required|string',
                'bahan'            => 'required|string',
                'langkahPembuatan' => 'required|string',
            ]);

            $ramuan = new Ramuan($validated);

            // Simpan gambar jika ada
            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/ramuan', $imageName);
                $ramuan->gambar = $imageName;
            }

            $ramuan->save();

            return response()->json(['success' => true, 'data' => $ramuan, 'message' => 'Ramuan berhasil ditambahkan'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== SHOW ================== //
    public function show($id)
    {
        try {
            $ramuan = Ramuan::findOrFail($id);
            return response()->json(['success' => true, 'data' => $ramuan], 200);
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
                'nama_ramuan' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'deskripsi' => 'required|string',
                'manfaat' => 'required|string',
                'efekSamping' => 'required|string',
                'waktuKonsumsi' => 'required|string',
                'saranPenggunaan' => 'required|string',
                'bahan' => 'required|string',
                'langkahPembuatan' => 'required|string',
            ]);

            $ramuan = Ramuan::findOrFail($id);
            $ramuan->fill($validated);

            // Jika ada gambar baru, upload dan ganti gambar lama
            if ($request->hasFile('gambar')) {
                if ($ramuan->gambar && Storage::exists('public/img/ramuan/' . $ramuan->gambar)) {
                    Storage::delete('public/img/ramuan/' . $ramuan->gambar);
                }

                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/ramuan', $imageName);
                $ramuan->gambar = $imageName;
            }

            $ramuan->save();

            return response()->json(['success' => true, 'data' => $ramuan, 'message' => 'Ramuan berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== DESTROY ================== //
    public function destroy($id)
    {
        try {
            $ramuan = Ramuan::findOrFail($id);

            // Hapus gambar jika ada
            if ($ramuan->gambar && Storage::exists('public/img/ramuan/' . $ramuan->gambar)) {
                Storage::delete('public/img/ramuan/' . $ramuan->gambar);
            }

            $ramuan->delete();

            return response()->json(['success' => true, 'message' => 'Ramuan berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
