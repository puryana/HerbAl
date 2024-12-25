<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'detail_pesanan';

    // Primary key
    protected $primaryKey = 'id_detail_pesanan';

    // Tipe primary key
    public $incrementing = true; 
    protected $keyType = 'int';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_pesanan',
        'id_produk',
        'jumlah',
        'harga_satuan',
        'subtotal',
        'diskon',
    ];

    /**
     * Relasi ke tabel `pesanan`
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    /**
     * Relasi ke tabel `produk`
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
