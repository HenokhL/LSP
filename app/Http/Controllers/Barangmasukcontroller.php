<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    // 1. Menampilkan halaman tambah barang
    public function tambah()
    {
        $kategori = Kategori::all();
        return view('barang.tambah', compact('kategori'));
    }

    // 2. Menyimpan barang baru (Sinkron dengan View tambah.blade.php)
    public function simpan(Request $request)
    {
        $request->validate([
            'kode_barang'   => 'required',
            'nama_barang'   => 'required',
            'kategori_id'   => 'required',
            'stok_tersedia' => 'required|numeric',
            'harga'         => 'required|numeric',
            'status'        => 'required',
        ]);

        // Kita mengisi 'stok' dengan nilai yang sama dengan 'stok_tersedia'
        // agar tidak terjadi error karena database mewajibkan keduanya
        Barang::create([
            'kode_barang'   => $request->kode_barang,
            'nama_barang'   => $request->nama_barang,
            'kategori_id'   => $request->kategori_id, 
            'stok_tersedia' => $request->stok_tersedia,
            'stok'          => $request->stok_tersedia, 
            'harga'         => $request->harga,
            'status'        => $request->status,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambah!');
    }

    // 3. Menyimpan transaksi barang keluar
    public function simpanBarangKeluar(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'tanggal'   => 'required|date',
            'jumlah'    => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        
        if ($barang->stok_tersedia < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        DB::transaction(function () use ($request, $barang) {
            BarangKeluar::create([
                'barang_id' => $request->barang_id,
                'tanggal'   => $request->tanggal,
                'jumlah'    => $request->jumlah,
            ]);
            
            // Kurangi stok
            $barang->decrement('stok_tersedia', $request->jumlah);
            $barang->decrement('stok', $request->jumlah);
        });

        return redirect()->route('barang.index')->with('success', 'Transaksi berhasil!');
    }
}