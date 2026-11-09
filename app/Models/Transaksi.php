<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Transaksi extends Model
{
    protected $table    = 'transaksi';
    protected $fillable = [
        'kode_transaksi', 'barang_id', 'user_id',
        'jenis', 'jumlah', 'harga_satuan', 'total_harga',
        'keterangan', 'tanggal',
    ];
 
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}
 