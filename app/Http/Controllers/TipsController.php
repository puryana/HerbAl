<?php

namespace App\Http\Controllers;

use App\Models\tips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TipsController extends Controller
{
    // ===================== tampil ================== //
    public function indexTips()
    {
        // Mengambil semua data dari database
        $tips = tips::all();
        // if ($tips->isEmpty()) {
        //     return redirect()->route('tips_sehat.index')->with('error', 'Tidak ada data.');
        // }
         // Mengirim data ke view
        return view('admin.tips_sehat', compact('tips'));
    }

    // ===================== create and store ================== //
    public function createTips()
    {
        return View('admin.tambah_tips_sehat');
    }

    public function storeTips(Request $request)
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

        // Menyimpan data 
        $tips = new tips();
        $tips->nama_tips = $request->input('nama_tips');
        $tips->deskripsi = $request->input('deskripsi');
        $tips->resep1 = $request->input('resep1');
        $tips->resep2 = $request->input('resep2');
        $tips->resep3 = $request->input('resep3');

        // Menyimpan file gambar
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/tips', $imageName);  // Menyimpan file ke folder
            $tips->gambar = $imageName;
        }

        // Simpan kategori ke database
        $tips->save();

        // Redirect atau beri notifikasi sukses
        if ($tips) {
            return response()->json(['success' => true, 'redirect_url' => '/tips'], 200);
        }
    
        return response()->json(['success' => false, 'message' => 'Gagal menambahkan Tips'], 500);
        
    }

    // ===================== edit and update ================== //
    public function editTips($id_tips)
    {
        // Ambil data produk berdasarkan ID
        $tips = tips::findOrFail($id_tips);

        // Kirim data produk ke view
        return view('admin.edit_tips', compact('tips'));
    }

    public function updateTips(Request $request, $id_tips)
    {
        // Validasi input
        $request->validate([
            'nama_tips' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'deskripsi' => 'required|string',
            'resep1' => 'required|string',
            'resep2' => 'required|string', 
            'resep3' => 'required|string',
        ]);
        
         // Cari data 
        $tips = tips::findOrFail($id_tips);

        // Update nama 
        $tips->nama_tips = $request->input('nama_tips');
        $tips->deskripsi = $request->input('deskripsi');
        $tips->resep1 = $request->input('resep1');
        $tips->resep2 = $request->input('resep2');
        $tips->resep3 = $request->input('resep3');


        // Jika ada gambar baru, upload dan ganti gambar lama
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

        // Simpan perubahan
        if ($tips->save()) {
            return response()->json([
                'success' => true,
                'redirect_url' =>'/tips_sehat'
            ], 200);
        }

        // Jika gagal menyimpan perubahan
        return response()->json(['success' => false, 'message' => 'Gagal memperbarui data penyakit.'], 500);
    }

    // ===================== delete ================== //
    public function destroyTips($id_tips)
    {
    try {
        $tips = tips::findOrFail($id_tips);

        // Hapus gambar dari folder jika ada
        if (Storage::exists('public/img/tips/' . $tips->gambar)) {
            Storage::delete('public/img/tips/' . $tips->gambar);
        }

        $tips->delete();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus Data: ' . $e->getMessage()]);
        }
    }
}
