<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PersediaanController extends Controller
{
    public function index()
    {
        $daftarBarang = DB::table('barang')->orderBy('nama_barang', 'asc')->get();
        return view('persediaan.index', compact('daftarBarang'));
    }

    public function storeMasuk(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'jumlah'    => 'required|numeric|min:1',
            'tanggal'   => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            DB::table('barang_masuk')->insert([
                'barang_id'  => $request->id_barang,  // ← sesuai kolom tabel
                'jumlah'     => $request->jumlah,
                'tanggal'    => $request->tanggal,
            ]);

            DB::table('barang')
                ->where('id', $request->id_barang)  // ← id bukan id_barang
                ->increment('stok', $request->jumlah);

            $barang = DB::table('barang')->where('id', $request->id_barang)->first();
            if ($barang->stok > 5) {
                DB::table('barang')->where('id', $request->id_barang)->update(['status' => 'tersedia']);
            } elseif ($barang->stok > 0 && $barang->stok <= 5) {
                DB::table('barang')->where('id', $request->id_barang)->update(['status' => 'tersedia']);
                // status ENUM hanya 'tersedia','habis','discontinue' — tidak ada 'stok menipis'
            }
        });

        return redirect()->route('persediaan.index')->with('success', 'Data Barang Masuk berhasil ditambahkan!');
    }

    public function storeKeluar(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'jumlah'    => 'required|numeric|min:1',
            'tanggal'   => 'required|date',
        ]);

        $barang = DB::table('barang')->where('id', $request->id_barang)->first();
        if (!$barang || $barang->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi! Stok saat ini: ' . ($barang->stok ?? 0));
        }

        DB::transaction(function () use ($request, $barang) {
            DB::table('barang_keluar')->insert([
                'barang_id'  => $request->id_barang,  // ← sesuai kolom tabel
                'jumlah'     => $request->jumlah,
                'tanggal'    => $request->tanggal,
            ]);

            DB::table('barang')
                ->where('id', $request->id_barang)  // ← id bukan id_barang
                ->decrement('stok', $request->jumlah);

            $stokTerbaru = $barang->stok - $request->jumlah;
            if ($stokTerbaru == 0) {
                DB::table('barang')->where('id', $request->id_barang)->update(['status' => 'habis']);
            } else {
                DB::table('barang')->where('id', $request->id_barang)->update(['status' => 'tersedia']);
            }
        });

        return redirect()->route('persediaan.index')->with('success', 'Data Barang Keluar berhasil dicatat!');
    }
}