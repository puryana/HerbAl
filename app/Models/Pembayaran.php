<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // Nama tabel
    protected $primaryKey = 'id_pembayaran'; // Primary key tabel

    /**
     * Kolom yang bisa diisi secara massal.
     */
    protected $fillable = [
        'id_pesanan',
        'payment_gateway',
        'transaction_id',
        'amount',
        'status',
        'payment_date',
    ];

    /**
     * Relasi dengan tabel Pesanan (Orders).
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
