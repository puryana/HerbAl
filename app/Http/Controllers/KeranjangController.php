<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    // Menampilkan semua item dalam keranjang
    public function indexKeranjang()
    {
        $keranjangs = Keranjang::all();
        return response()->json($keranjangs);
    }

    // Menambahkan item ke dalam keranjang
    public function storeKeranjang(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id', //id_user
            'id_produk' => 'required|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = new Keranjang();
        $keranjang->id = $request->id;
        $keranjang->id_produk = $request->id_produk;
        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        return response()->json([
            'message' => 'Item berhasil ditambahkan ke keranjang',
            'data' => $keranjang
        ], 201);
    }

    // Menghapus item dari keranjang
    public function destroyKeranjang($id_keranjang)
    {
        $keranjang = Keranjang::findOrFail($id_keranjang);
        $keranjang->delete();

        return response()->json([
            'message' => 'Item berhasil dihapus dari keranjang'
        ]);
    }
}
