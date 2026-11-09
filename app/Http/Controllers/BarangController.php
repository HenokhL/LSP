<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();
        return view('barang.index', compact('barang'));
    }

    public function tambah()
    {
        $kategori = Kategori::all();
        return view('barang.tambah', compact('kategori'));
    }

    public function simpan(Request $request)
    {
        $status = ($request->stok > 0) ? 'tersedia' : 'habis';

        Barang::create([
            'kode_barang'   => $request->kode_barang,
            'nama_barang'   => $request->nama_barang,
            'kategori_id'   => $request->kategori_id,
            'stok'          => $request->stok,
            'stok_tersedia' => $request->stok,
            'harga'         => $request->harga ?? 0,
            'status'        => $status,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $status = ($request->stok > 0) ? 'tersedia' : 'habis';

        $barang->update([
            'kode_barang'   => $request->kode_barang,
            'nama_barang'   => $request->nama_barang,
            'kategori_id'   => $request->kategori_id,
            'stok'          => $request->stok,
            'stok_tersedia' => $request->stok,
            'harga'         => $request->harga,
            'status'        => $status,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }

    public function hapus($id)
    {
        Barang::findOrFail($id)->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}