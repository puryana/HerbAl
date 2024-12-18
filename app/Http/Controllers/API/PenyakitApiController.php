<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenyakitApiController extends Controller
{
    // ===================== Tampilkan Semua Data ===================== //
    public function index()
    {
        $penyakits = Penyakit::all();

        return response()->json([
            'success' => true,
            'data' => $penyakits,
        ], 200);
    }

    // ===================== Tambah Data Baru ===================== //
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_penyakit' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
            'penyebab' => 'required|string',
            'gejala' => 'required|string',
            'pantangan' => 'required|string',
            'anjuran' => 'required|string',
        ]);

        // Simpan data
        $penyakit = new Penyakit();
        $penyakit->nama_penyakit = $request->input('nama_penyakit');
        $penyakit->deskripsi = $request->input('deskripsi');
        $penyakit->penyebab = $request->input('penyebab');
        $penyakit->gejala = $request->input('gejala');
        $penyakit->pantangan = $request->input('pantangan');
        $penyakit->anjuran = $request->input('anjuran');

        // Simpan file gambar
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/penyakit', $imageName);
            $penyakit->gambar = $imageName;
        }

        $penyakit->save();

        return response()->json([
            'success' => true,
            'message' => 'Data penyakit berhasil ditambahkan!',
            'data' => $penyakit,
        ], 201);
    }

    // ===================== Tampilkan Data Berdasarkan ID ===================== //
    public function show($id)
    {
        $penyakit = Penyakit::find($id);

        if (!$penyakit) {
            return response()->json([
                'success' => false,
                'message' => 'Data penyakit tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $penyakit,
        ], 200);
    }

    // ===================== Perbarui Data ===================== //
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_penyakit' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
            'penyebab' => 'required|string',
            'gejala' => 'required|string',
            'pantangan' => 'required|string',
            'anjuran' => 'required|string',
        ]);

        // Cari data
        $penyakit = Penyakit::find($id);

        if (!$penyakit) {
            return response()->json([
                'success' => false,
                'message' => 'Data penyakit tidak ditemukan!',
            ], 404);
        }

        // Update data
        $penyakit->nama_penyakit = $request->input('nama_penyakit');
        $penyakit->deskripsi = $request->input('deskripsi');
        $penyakit->penyebab = $request->input('penyebab');
        $penyakit->gejala = $request->input('gejala');
        $penyakit->pantangan = $request->input('pantangan');
        $penyakit->anjuran = $request->input('anjuran');

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($penyakit->gambar && Storage::exists('public/img/penyakit/' . $penyakit->gambar)) {
                Storage::delete('public/img/penyakit/' . $penyakit->gambar);
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/penyakit', $imageName);
            $penyakit->gambar = $imageName;
        }

        $penyakit->save();

        return response()->json([
            'success' => true,
            'message' => 'Data penyakit berhasil diperbarui!',
            'data' => $penyakit,
        ], 200);
    }

    // ===================== Hapus Data ===================== //
    public function destroy($id)
    {
        $penyakit = Penyakit::find($id);

        if (!$penyakit) {
            return response()->json([
                'success' => false,
                'message' => 'Data penyakit tidak ditemukan!',
            ], 404);
        }

        // Hapus gambar jika ada
        if ($penyakit->gambar && Storage::exists('public/img/penyakit/' . $penyakit->gambar)) {
            Storage::delete('public/img/penyakit/' . $penyakit->gambar);
        }

        $penyakit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data penyakit berhasil dihapus!',
        ], 200);
    }
}
