<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tanaman_obat;
use Illuminate\Support\Facades\Storage;

class TanamanController extends Controller
{
    // ===================== tampil ================== //
    public function indexTanaman()
    {
        // Mengambil semua data tanaman obat dari database
        $tanaman_obats = tanaman_obat::all();
        // Mengirim data ke view
        return view('admin.tanaman_obat', compact('tanaman_obats'));
    }

    
    // ===================== create and store ================== //
    public function createTanaman()
    {
        return view('admin.tambah_tanaman_obat');
    }

    public function storeTanaman(Request $request)
    {
        // Validasi inputan form
        $validated = $request->validate([
            'nama_tanaman' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
            'bagian_tumbuhan' => 'required|string',
            'khasiat' => 'required|string',
            'penggunaan' => 'required|string',
            'efekSamping' => 'required|string',
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

            // Menyimpan berhasil, memberi respons sukses
            return response()->json([
                'success' => true, 
                'message' => 'Tanaman obat berhasil ditambahkan.',
                'redirect_url' => '/tanaman_obat'
            ],);

        } catch (\Exception $e) {
            // Menangani error jika ada
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    
    // ===================== edit and update ================== //
    public function editTanaman($id_tanaman)
{
    // Ambil data berdasarkan ID
    $tanaman = tanaman_obat::findOrFail($id_tanaman);

    // Kirim data ke view
    return view('admin.edit_tanaman_obat', compact('tanaman'));
}

public function updateTanaman(Request $request, $id_tanaman)
{
    try {
        // Validasi input
        $request->validate([
            'nama_tanaman' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar tidak selalu wajib
            'deskripsi' => 'required|string',
            'bagian_tumbuhan' => 'required|string',
            'khasiat' => 'required|string',
            'penggunaan' => 'required|string',
            'efekSamping' => 'required|string',
        ]);

        // Cari data
        $tanaman = tanaman_obat::findOrFail($id_tanaman);

        // Update data berdasarkan input pengguna
        $tanaman->nama_tanaman = $request->input('nama_tanaman');
        $tanaman->deskripsi = $request->input('deskripsi');
        $tanaman->bagian_tumbuhan = $request->input('bagian_tumbuhan');
        $tanaman->khasiat = $request->input('khasiat');
        $tanaman->penggunaan = $request->input('penggunaan');
        $tanaman->efekSamping = $request->input('efekSamping');

        // Jika ada file gambar yang diupload, proses penggantian gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($tanaman->gambar && Storage::exists('public/img/tanaman_obat/' . $tanaman->gambar)) {
                Storage::delete('public/img/tanaman_obat/' . $tanaman->gambar);
            }

            // Upload gambar baru
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/tanaman_obat', $imageName);
            $tanaman->gambar = $imageName;
        }

        // Simpan perubahan ke database
        $tanaman->save();

        // Berikan respons berhasil
        return response()->json([
            'success' => true,
            'message' => 'Tanaman obat berhasil diperbarui.',
            'redirect_url' => '/tanaman_obat',
        ]);
    } catch (\Exception $e) {
        // Tangani kesalahan umum
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

    // ===================== delete ================== //
    public function destroyTanaman($id_tanaman)
    {
    try {
        $tanaman = tanaman_obat::findOrFail($id_tanaman);

        // Hapus gambar dari folder jika ada
        if (Storage::exists('public/img/tanaman_obat/' . $tanaman->gambar)) {
            Storage::delete('public/img/tanaman_obat/' . $tanaman->gambar);
        }

        $tanaman->delete();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus Data: ' . $e->getMessage()]);
        }
    }
}
