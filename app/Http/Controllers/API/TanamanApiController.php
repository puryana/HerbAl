<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tanaman_obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TanamanApiController extends Controller
{
    // ===================== INDEX ================== //
    public function index()
    {
        try {
            $tanaman_obats = tanaman_obat::all();
            return response()->json(['success' => true, 'data' => $tanaman_obats], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ===================== STORE ================== //
    public function store(Request $request)
    {
        // Validasi inputan form
        $validated = $request->validate([
            'nama_tanaman'     => 'required|string|max:255',
            'gambar'           => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi'        => 'required|string',
            'bagian_tumbuhan'  => 'required|string',
            'khasiat'          => 'required|string',
            'penggunaan'       => 'required|string',
            'efekSamping'      => 'required|string',
        ]);

        try {
            // Menyimpan data tanaman obat
            $tanaman_obat = new tanaman_obat();
            $tanaman_obat->nama_tanaman = $validated['nama_tanaman'];
            $tanaman_obat->deskripsi = $validated['deskripsi'];
            $tanaman_obat->bagian_tumbuhan = $validated['bagian_tumbuhan'];
            $tanaman_obat->khasiat = $validated['khasiat'];
            $tanaman_obat->penggunaan = $validated['penggunaan'];
            $tanaman_obat->efekSamping = $validated['efekSamping'];

            // Menyimpan file gambar
            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/tanaman_obat', $imageName);
                $tanaman_obat->gambar = $imageName;
            }

            // Simpan data tanaman obat ke database
            $tanaman_obat->save();

            return response()->json([
                'success' => true,
                'message' => 'Tanaman obat berhasil ditambahkan.',
                'data' => $tanaman_obat,
                'redirect_url' => '/tanaman_obat'
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
            $tanaman_obat =tanaman_obat::findOrFail($id);
            return response()->json(['success' => true, 'data' => $tanaman_obat], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
    }

    // ===================== UPDATE ================== //
    public function update(Request $request, $id)
    {
        try {
            // Validasi inputan form
            $validated = $request->validate([
                'nama_tanaman'     => 'required|string|max:255',
                'gambar'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'deskripsi'        => 'required|string',
                'bagian_tumbuhan'  => 'required|string',
                'khasiat'          => 'required|string',
                'penggunaan'       => 'required|string',
                'efekSamping'      => 'required|string',
            ]);

            $tanaman_obat = tanaman_obat::findOrFail($id);

            // Update data tanaman obat
            $tanaman_obat->nama_tanaman = $validated['nama_tanaman'];
            $tanaman_obat->deskripsi = $validated['deskripsi'];
            $tanaman_obat->bagian_tumbuhan = $validated['bagian_tumbuhan'];
            $tanaman_obat->khasiat = $validated['khasiat'];
            $tanaman_obat->penggunaan = $validated['penggunaan'];
            $tanaman_obat->efekSamping = $validated['efekSamping'];

            // Cek dan upload gambar baru jika ada
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($tanaman_obat->gambar && Storage::exists('public/img/tanaman_obat/' . $tanaman_obat->gambar)) {
                    Storage::delete('public/img/tanaman_obat/' . $tanaman_obat->gambar);
                }

                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/tanaman_obat', $imageName);
                $tanaman_obat->gambar = $imageName;
            }

            // Simpan perubahan ke database
            $tanaman_obat->save();

            return response()->json([
                'success' => true,
                'message' => 'Tanaman obat berhasil diperbarui.',
                'data' => $tanaman_obat,
                'redirect_url' => '/tanaman_obat'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== DELETE ================== //
    public function destroy($id)
    {
        try {
            $tanaman_obat = tanaman_obat::findOrFail($id);

            // Hapus gambar jika ada
            if ($tanaman_obat->gambar && Storage::exists('public/img/tanaman_obat/' . $tanaman_obat->gambar)) {
                Storage::delete('public/img/tanaman_obat/' . $tanaman_obat->gambar);
            }

            $tanaman_obat->delete();

            return response()->json(['success' => true, 'message' => 'Tanaman obat berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
