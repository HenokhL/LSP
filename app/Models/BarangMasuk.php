<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    public $timestamps = false;

    protected $fillable = [
        'id_barang',
        'jumlah',
        'tanggal_masuk'
    ];
}