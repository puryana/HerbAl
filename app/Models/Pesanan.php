<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id', ///id user
        'total',
        'biaya_pengiriman',
        'status',
        'payment_method',
        'payment_status',
        'no_resi', // Nomor resi pengiriman
        'shipping_name', // Nama jasa pengiriman
        'transaction_id', // ID transaksi dari Midtrans
        'payment_details', // JSON detail pembayaran
        'shipped_at', // Waktu pengiriman
        'completed_at', // Waktu pesanan selesai
    ];

    // Relasi dengan tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Mutator untuk kolom `payment_details` agar otomatis decode JSON
    protected $casts = [
        'payment_details' => 'array', // Mengonversi JSON ke array saat diakses
        'shipped_at' => 'datetime', // Mengonversi ke format DateTime
        'completed_at' => 'datetime', // Mengonversi ke format DateTime
    ];

    // Scope untuk mempermudah filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk memfilter berdasarkan pengguna tertentu
    public function scopeByUser($query, $userId)
    {
        return $query->where('id', $userId); //id_user
    }
}
