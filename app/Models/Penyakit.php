<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;
    protected $table = 'penyakit';  // Nama tabel yang digunakan

    protected $primaryKey = 'id_penyakit';
    
    protected $fillable = [
        'nama_penyakit',
        'gambar',
        'deskripsi',
        'penyebab',
        'gejala',
        'pantangan',
        'anjuran',
    ];

    public $timestamps = false;
}
