<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tanaman_obat extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional jika nama tabel sudah sama dengan nama model dalam format snake_case)
    protected $table = 'tanaman_obat';  

    protected $primaryKey = 'id_tanaman'; // Primary key
    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_tanaman',
        'gambar',
        'deskripsi',
        'bagian_tumbuhan',
        'khasiat',
        'penggunaan',
        'efekSamping',
    ];

    // Menonaktifkan pengaturan otomatis timestamps jika tidak digunakan
    public $timestamps = false;
}
