<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Nama tabel di database
    protected $table = 'barang';

    // Primary key tabel
    protected $primaryKey = 'id';

    // Mengaktifkan fitur timestamps
    public $timestamps = true;

    // Daftar kolom yang diizinkan untuk diisi
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'stok',
        'stok_tersedia',
        'harga',
        'status'
    ];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    /**
     * Accessor: Menampilkan status secara dinamis
     * Mengubah teks status berdasarkan jumlah stok
     */
    public function getStatusAttribute()
    {
        if ($this->stok <= 0) {
            return 'Habis';
        } elseif ($this->stok < 10) {
            return 'Stok Menipis';
        }
        return $this->attributes['status'] ?? 'Tersedia';
    }
}