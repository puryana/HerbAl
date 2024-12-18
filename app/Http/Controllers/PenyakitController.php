<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenyakitController extends Controller
{
    // ===================== tampil ================== //
    public function indexPenyakit()
    {
        // Mengambil semua data dari database
        $penyakits = Penyakit::all();
        // Mengirim data ke view
        return view('admin.penyakit', compact('penyakits'));
    }


    // ===================== create and store ================== //
    public function createPenyakit()
    {
        return View('admin.tambah_penyakit');
    }

    public function storePenyakit(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nama_penyakit' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',  // Validasi file gambar
            'deskripsi' => 'required|string',
            'penyebab' => 'required|string',
            'gejala' => 'required|string',
            'pantangan' => 'required|string',
            'anjuran' => 'required|string',
        ]);

        // Menyimpan data 
        $penyakit = new Penyakit();
        $penyakit->nama_penyakit = $request->input('nama_penyakit');
        $penyakit->deskripsi = $request->input('deskripsi');
        $penyakit->penyebab = $request->input('penyebab');
        $penyakit->gejala = $request->input('gejala');
        $penyakit->pantangan= $request->input('pantangan');
        $penyakit->anjuran = $request->input('anjuran');

        // Menyimpan file gambar
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/penyakit', $imageName); 
            $penyakit->gambar = $imageName;
        }

        // Simpan data ke database
        $penyakit->save();

        if ($penyakit){
        // Menyimpan berhasil, memberi respons sukses
            return response()->json(['success' => true, 'redirect_url' => '/penyakit'], 200);
        }

        return response()->json(['success' => false, 'message' => 'Gagal menambahkan data Penyakit.'], 500);
    }
        
    
    // ===================== edit and update ================== //
    public function editPenyakit($id_penyakit)
    {
        // Ambil data berdasarkan ID
        $penyakit = Penyakit::findOrFail($id_penyakit);

        // Kirim data ke view
        return view('admin.edit_penyakit', compact('penyakit'));
    }

    public function updatePenyakit(Request $request, $id_penyakit)
    {
        // Validasi inputan form
        $request->validate([
            'nama_penyakit' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar bisa nullable
            'deskripsi' => 'required|string',
            'penyebab' => 'required|string',
            'gejala' => 'required|string',
            'pantangan' => 'required|string',
            'anjuran' => 'required|string',
        ]);

        // Cari data Penyakit
        $penyakit = Penyakit::findOrFail($id_penyakit);

        // Update field
        $penyakit->nama_penyakit = $request->input('nama_penyakit');
        $penyakit->deskripsi = $request->input('deskripsi');
        $penyakit->penyebab = $request->input('penyebab');
        $penyakit->gejala = $request->input('gejala');
        $penyakit->pantangan = $request->input('pantangan');
        $penyakit->anjuran = $request->input('anjuran');

        // Jika ada gambar baru, upload dan ganti gambar lama
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($penyakit->gambar && Storage::exists('public/img/penyakit/' . $penyakit->gambar)) {
                Storage::delete('public/img/penyakit/' . $penyakit->gambar);
            }

            // Upload gambar baru
            $imageName = time() . '.' . $request->file('gambar')->extension();
            $request->file('gambar')->storeAs('public/img/penyakit', $imageName);
            $penyakit->gambar = $imageName;
        }

        // Simpan perubahan
        if ($penyakit->save()) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('penyakit.index')
            ], 200);
        }

        // Jika gagal menyimpan perubahan
        return response()->json(['success' => false, 'message' => 'Gagal memperbarui data penyakit.'], 500);
    }


    // ===================== delete ================== //
    public function destroyPenyakit($id_penyakit)
    {
    try {
        $penyakit = Penyakit::findOrFail($id_penyakit);

        // Hapus gambar dari folder jika ada
        if (Storage::exists('public/img/penyakit/' . $penyakit->gambar)) {
            Storage::delete('public/img/penyakit/' . $penyakit->gambar);
        }

        $penyakit->delete();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus Data: ' . $e->getMessage()]);
        }
    }
    
}
