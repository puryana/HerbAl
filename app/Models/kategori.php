<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori'; // Nama tabel
    protected $primaryKey = 'id_kategori'; // Primary key
    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan

    protected $fillable = ['nama_kategori', 'gambar']; // Kolom yang bisa diisi

    // public function ramuan()
    // {
    //     return $this->hasMany(ramuan::class, 'id_kategori', 'id_kategori');
    // }
}
