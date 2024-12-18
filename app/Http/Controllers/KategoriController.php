<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{   
    // ===================== tampil ================== //
    // public function index()
    // {
    //     $kategoris = Kategori::all();
    //     return view('admin.kategori', ['kategoris' => $kategoris]);
    // }
    
    public function indexKategori()
    {
        // Mengambil semua data kategori dari database
        $kategoris = Kategori::all();
        
        // Mengirim data ke view
        // return view('admin.kategori', ['kategoris' => $kategoris]);
        return view('admin.kategori', compact('kategoris')); 
    }

    // ===================== create and store ================== //
    public function createKategori()
    {
        return View('admin.tambah_kategori');
    }

    public function storeKategori(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',  // Validasi file gambar
        ]);

        // Menyimpan data kategori
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->input('nama_kategori');

        // Menyimpan file gambar
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/kategori', $imageName);  // Menyimpan file ke folder public/img/kategori
            $kategori->gambar = $imageName;
        }

        // Simpan kategori ke database
        $kategori->save();

        // Redirect atau beri notifikasi sukses
        if ($kategori) {
            return response()->json(['success' => true, 'redirect_url' => '/kategori']);
        }
    
        return response()->json(['success' => false, 'message' => 'Gagal menambahkan kategori.'], 500);
        
    }


    // ================================== edit and update =================================== //
    public function editKategori($id_kategori)
    {
        // Ambil data kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id_kategori);

        // Kirim data kategori ke view
        return view('admin.edit_kategori', compact('kategori'));
    }

    public function updateKategori(Request $request, $id_kategori)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cari data kategori
        $kategori = Kategori::findOrFail($id_kategori);

        // Update nama kategori
        $kategori->nama_kategori = $request->input('nama_kategori');

        // Jika ada gambar baru, upload dan ganti gambar lama
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kategori->gambar && Storage::exists('public/img/kategori/' . $kategori->gambar)) {
                Storage::delete('public/img/kategori/' . $kategori->gambar);
            }

            // Upload gambar baru
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/kategori', $imageName);
            $kategori->gambar = $imageName;
        }

        // Simpan perubahan
        if ($kategori->save()) {
            // Redirect ke halaman kategori dengan pesan sukses
                return response()->json(['success' => true, 'redirect_url' => '/kategori']);
            }
        
            return response()->json(['success' => false, 'message' => 'Gagal mengedit kategori.'], 500);
    }
    
    // ===================== delete ==================================== //
    public function destroyKategori($id_kategori)
    {
    try {
        // Cari kategori berdasarkan id_kategori
        $kategori = Kategori::where('id_kategori', $id_kategori)->firstOrFail();
        
        // Hapus gambar dari folder jika ada
        if ($kategori->gambar && Storage::exists('public/img/kategori/' . $kategori->gambar)) {
            Storage::delete('public/img/kategori/' . $kategori->gambar);
        }

        // Hapus data kategori
        $kategori->delete();
            return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus kategori: ' . $e->getMessage()]);
        }
    }
}
