<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';  // Nama tabel yang digunakan

    protected $primaryKey = 'id_produk';
    
    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'harga',
        'gambar',
        'deskripsi',
        'manfaat',
        'efekSamping',
        'waktuKonsumsi',
    ];

    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori', 'id_kategori');
    }
}
