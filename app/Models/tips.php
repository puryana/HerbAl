<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tips extends Model
{
    use HasFactory;
    protected $table = 'tips';  // Nama tabel yang digunakan

    protected $primaryKey = 'id_tips';
    
    protected $fillable = [
        'nama_tips',
        'gambar',
        'deskripsi',
        'resep1',
        'resep2',
        'resep3',
    ];

    public $timestamps = false;
}
