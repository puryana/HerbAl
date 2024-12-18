<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ramuan extends Model
{
    use HasFactory;
    protected $table = 'ramuan';  // Nama tabel yang digunakan

    protected $primaryKey = 'id_ramuan';
    
    protected $fillable = [
        'id_kategori',
        'nama_ramuan',
        'gambar',
        'deskripsi',
        'manfaat',
        'efekSamping',
        'waktuKonsumsi',
        'saranPenggunaan',
        'bahan',
        'langkahPembuatan',
    ];

    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori', 'id_kategori');
    }
}
