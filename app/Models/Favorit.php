<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    use HasFactory;

    protected $table = 'favorit'; // Nama tabel
    protected $primaryKey = 'id_favorit'; // Primary key tabel

    /**
     * Kolom yang bisa diisi secara massal.
     */
    protected $fillable = [
        'id',
        'id_ramuan',
        'id_produk',
        'id_tanaman',
        'id_penyakit',
        'id_tips',
    ];

    /**
     * Relasi dengan tabel User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    /**
     * Relasi dengan tabel Ramuan.
     */
    public function ramuan()
    {
        return $this->belongsTo(Ramuan::class, 'id_ramuan', 'id_ramuan');
    }

    /**
     * Relasi dengan tabel Produk.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    /**
     * Relasi dengan tabel Tanaman.
     */
    public function tanaman()
    {
        return $this->belongsTo(tanaman_obat::class, 'id_tanaman', 'id_tanaman');
    }

    /**
     * Relasi dengan tabel Penyakit.
     */
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'id_penyakit', 'id_penyakit');
    }

    /**
     * Relasi dengan tabel Tips.
     */
    public function tips()
    {
        return $this->belongsTo(Tips::class, 'id_tips', 'id_tips');
    }
}
