<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    public $timestamps = false;

    protected $fillable = [
        'id_barang',
        'jumlah',
        'tanggal_keluar',
        'status_pengiriman'
    ];
}