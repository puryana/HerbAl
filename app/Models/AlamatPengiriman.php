<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPengiriman extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'alamat_pengiriman';

    // Primary key
    protected $primaryKey = 'id_pengiriman';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',           // ID user
        'id_pesanan',   // ID pesanan
        'address',      // Alamat pengiriman
        'city',         // Kota
        'province',     // Provinsi
        'postal_code',  // Kode pos
    ];

    // Relasi dengan tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    // Relasi dengan tabel Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
