<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // ===================== tampil ================== //
    public function indexProduk()
    {
        $produks = Produk::all();
        return view('admin.produk', compact('produks'));
    }

    // ===================== create and store ================== //
    public function createProduk()
    {
        $kategori = kategori::all();
        return View('admin.tambah_produk', compact('kategori'));
    }

    public function storeProduk(Request $request)
    {   
        try {
            // Validasi inputan form
            $validated = $request->validate([
                'id_kategori' => 'required|string',
                'nama_produk' => 'required|string|max:255',
                'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
                'harga' => 'required|string',
                'deskripsi' => 'required|string',
                'manfaat' => 'required|string',
                'efekSamping' => 'required|string', 
                'waktuKonsumsi' => 'required|string',
            ]);

            // Menyimpan data Produk
            $produk = new produk();
            $produk->id_kategori = $validated['id_kategori'];
            $produk->nama_produk = $validated['nama_produk'];
            $produk->harga = $validated['harga'];
            $produk->deskripsi = $validated['deskripsi'];
            $produk->manfaat = $validated['manfaat'];
            $produk->efekSamping = $validated['efekSamping'];
            $produk->waktuKonsumsi = $validated['waktuKonsumsi'];

        // Menyimpan file gambar
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/produk', $imageName);  // Menyimpan file ke folder public/img/kategori
            $produk->gambar = $imageName;
        }

        // Simpan kategori ke database
        $produk->save();

            return response()->json([
                'success' => true, 
                'message' => 'Produk berhasil ditambahkan.',
                'redirect_url' => '/produk'
            ]);
        } catch (\Exception $e) {
            // Menangani error jika ada
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== edit and update ================== //
    public function editProduk($id_produk)
    {
        // Ambil data produk berdasarkan ID
        $produk = Produk::findOrFail($id_produk);
        $kategori = Kategori::all(); 
        // Kirim data produk ke view
        return view('admin.edit_produk', compact('produk', 'kategori'));
    }

    public function updateProduk(Request $request, $id_produk)
    {
        // Validasi input
        try{
            $request->validate([
                'id_kategori' => 'required|string',
                'nama_produk' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
                'harga' => 'required|string',
                'deskripsi' => 'required|string',
                'manfaat' => 'required|string',
                'efekSamping' => 'required|string', 
                'waktuKonsumsi' => 'required|string',
            ]);

            // Cari data produk
            $produk = Produk::findOrFail($id_produk);

            // Update nama produk
            $produk->id_kategori = $request->input('id_kategori');
            $produk->nama_produk = $request->input('nama_produk');
            $produk->harga = $request->input('harga');
            $produk->deskripsi = $request->input('deskripsi');
            $produk->manfaat = $request->input('manfaat');
            $produk->efekSamping = $request->input('efekSamping');
            $produk->waktuKonsumsi = $request->input('waktuKonsumsi');

            // Jika ada gambar baru, upload dan ganti gambar lama
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($produk->gambar && Storage::exists('public/img/produk/' . $produk->gambar)) {
                    Storage::delete('public/img/produk/' . $produk->gambar);
                }

                // Upload gambar baru
                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/produk', $imageName);
                $produk->gambar = $imageName;
            }

        // Simpan kategori ke database
        $produk->save();

            return response()->json([
                'success' => true, 
                'message' => 'Produk berhasil di edit.',
                'redirect_url' => '/produk'
            ]);
        } catch (\Exception $e) {
            // Menangani error jika ada
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ===================== delete ================== //
    public function destroyProduk($id_produk)
    {
    try {
        $produk = produk::findOrFail($id_produk);

        // Hapus gambar dari folder jika ada
        if (Storage::exists('public/img/produk/' . $produk->gambar)) {
            Storage::delete('public/img/produk/' . $produk->gambar);
        }

        $produk->delete();

        return response()->json([
            'success' => true, 
            'message' => 'Produk berhasil di hapus.',
            'redirect_url' => '/produk'
        ]);
    } catch (\Exception $e) {
        // Menangani error jika ada
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
    }
}
