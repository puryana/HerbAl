<?php

namespace App\Http\Controllers;

use App\Models\Ramuan;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RamuanController extends Controller
{
    // ===================== tampil ================== //
    public function indexRamuan()
    {
        $ramuans = Ramuan::all();
        return view('admin.ramuan', compact('ramuans'));
    }

    // ===================== create and store ================== //
    public function createRamuan()
    {
        // Ambil daftar kategori dari database untuk ditampilkan di form
        $kategori = Kategori::all();
        // Kirim data kategori ke view 'tambah_ramuan'
        return view('admin.tambah_ramuan', compact('kategori'));
    }

    // Menyimpan ramuan baru
    public function storeRamuan(Request $request)
    {
        try {
            // Validasi inputan form
            $validated = $request->validate([
                'id_kategori'      => 'required|string',
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

            // Proses penyimpanan
            $ramuan = new Ramuan();
            $ramuan->id_kategori      = $validated['id_kategori'];
            $ramuan->nama_ramuan      = $validated['nama_ramuan'];
            $ramuan->deskripsi        = $validated['deskripsi'];
            $ramuan->manfaat          = $validated['manfaat'];
            $ramuan->efekSamping      = $validated['efekSamping'];
            $ramuan->waktuKonsumsi    = $validated['waktuKonsumsi'];
            $ramuan->saranPenggunaan  = $validated['saranPenggunaan'];
            $ramuan->bahan            = $validated['bahan'];
            $ramuan->langkahPembuatan = $validated['langkahPembuatan'];

            // Simpan gambar jika ada
            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/ramuan', $imageName);
                $ramuan->gambar = $imageName;
            }

            // Simpan ramuan ke database
            $ramuan->save();

            // Menyimpan berhasil, memberi respons sukses
                return response()->json([
                    'success' => true, 
                    'message' => 'Ramuan berhasil ditambahkan.',
                    'redirect_url' => '/ramuan'
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
    public function editRamuan($id_ramuan)
    {
        // Ambil data produk berdasarkan ID
        $ramuan = Ramuan::findOrFail($id_ramuan);
        $kategori = Kategori::all(); 
        // Kirim data produk ke view
        return view('admin.edit_ramuan', compact('ramuan', 'kategori'));
    }

    public function updateRamuan(Request $request, $id_ramuan)
    {
        // Validasi input
        try{
            $request->validate([
                'id_kategori' => 'required|string',
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

            // Cari data ramuan
            $ramuan = ramuan::findOrFail($id_ramuan);

            // Update nama ramuan
            $ramuan->id_kategori = $request->input('id_kategori');
            $ramuan->nama_ramuan = $request->input('nama_ramuan');
            $ramuan->deskripsi = $request->input('deskripsi');
            $ramuan->manfaat = $request->input('manfaat');
            $ramuan->efekSamping = $request->input('efekSamping');
            $ramuan->waktuKonsumsi = $request->input('waktuKonsumsi');
            $ramuan->saranPenggunaan = $request->input('saranPenggunaan');
            $ramuan->bahan = $request->input('bahan');
            $ramuan->langkahPembuatan = $request->input('langkahPembuatan');

            // Jika ada gambar baru, upload dan ganti gambar lama
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($ramuan->gambar && Storage::exists('public/img/ramuan/' . $ramuan->gambar)) {
                    Storage::delete('public/img/ramuan/' . $ramuan->gambar);
                }

                // Upload gambar baru
                $imageName = time() . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/img/ramuan', $imageName);
                $ramuan->gambar = $imageName;
            }

        // Simpan perubahan
        $ramuan->save();
            return response()->json([
                'success' => true, 
                'message' => 'Produk berhasil di edit.',
                'redirect_url' => '/ramuan'
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
    public function destroyRamuan($id_ramuan)
    {
    try {
        $ramuan = ramuan::findOrFail($id_ramuan);

        // Hapus gambar dari folder jika ada
        if (Storage::exists('public/img/ramuan/' . $ramuan->gambar)) {
            Storage::delete('public/img/ramuan/' . $ramuan->gambar);
        }

        $ramuan->delete();

            return response()->json([
                'success' => true, 
                'message' => 'Produk berhasil di edit.',
                'redirect_url' => '/ramuan'
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
