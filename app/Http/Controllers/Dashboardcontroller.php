<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\BarangMasuk;   
use App\Models\BarangKeluar;  
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Ringkasan (Menggunakan nama kolom 'stok_tersedia')
        $totalBarang   = DB::table('barang')->count();
        $totalStok     = DB::table('barang')->sum('stok_tersedia') ?? 0;
        $totalHabis    = DB::table('barang')->where('stok_tersedia', 0)->count();

        // 2. Kategori (Asumsi tabel bernama 'kategori')
        $totalKategori = DB::table('kategori')->count(); 
        
        // 3. User
        $totalUser     = DB::table('users')->count();

        // 4. Barang Masuk & Keluar
        $barangMasuk   = BarangMasuk::sum('jumlah') ?? 0;
        $barangKeluar  = BarangKeluar::sum('jumlah') ?? 0;

        $currentMonth = Carbon::now()->month;
        $currentYear  = Carbon::now()->year;

        // 5. 🔥 Kueri Penjualan Bulanan (Join menggunakan 'barang_id' dan 'id')
        $totalPenjualan = DB::table('barang_keluar')
            ->join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
            ->whereMonth('barang_keluar.tanggal', $currentMonth)
            ->whereYear('barang_keluar.tanggal', $currentYear)
            ->select(DB::raw('SUM(barang_keluar.jumlah * barang.harga) as total_duit')) 
            ->value('total_duit') ?? 0;

        // 6. 🔥 Barang Terbaru
        $barangTerbaru = Barang::with('kategori')
            ->latest('id')
            ->limit(5)
            ->get();

        // 7. 🔥 Kueri Grafik
        $grafik = DB::table('barang_keluar')
            ->join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
            ->select(
                DB::raw("DATE_FORMAT(tanggal, '%b') as bulan"),
                DB::raw("SUM(barang_keluar.jumlah * barang.harga) as total")
            )
            ->groupBy(DB::raw("DATE_FORMAT(tanggal, '%b')"))
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('dashboard.index', compact(
            'totalBarang', 'totalStok', 'totalHabis', 'totalKategori', 
            'totalUser', 'totalPenjualan', 'barangTerbaru', 'grafik', 
            'barangMasuk', 'barangKeluar'
        ));
    }
}