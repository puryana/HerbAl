<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan'; // Nama tabel
    protected $primaryKey = 'id_ulasan'; // Primary key tabel

    /**
     * Kolom yang bisa diisi secara massal.
     */
    protected $fillable = [
        'id',
        'commentable_id',
        'commentable_type',
        'text',
        'gambar',
        'rating',
    ];

    /**
     * Relasi polymorphic: ulasan dapat digunakan oleh berbagai model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Relasi dengan tabel User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
