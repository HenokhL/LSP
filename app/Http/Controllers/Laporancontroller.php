<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    private function getQueryData($request)
    {
        $tglAwal  = $request->get('tanggal_awal');
        $tglAkhir = $request->get('tanggal_akhir');
        $jenis    = $request->get('jenis');

        $masuk = DB::table('barang_masuk')
            ->join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
            ->select(
                'barang_masuk.tanggal',
                'barang.nama_barang',
                DB::raw("'masuk' as jenis"),
                'barang_masuk.jumlah',
                'barang.harga',
                DB::raw("0 as total_harga"),
                DB::raw("'Stok Masuk' as keterangan")
            );

        $keluar = DB::table('barang_keluar')
            ->join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
            ->select(
                'barang_keluar.tanggal',
                'barang.nama_barang',
                DB::raw("'keluar' as jenis"),
                'barang_keluar.jumlah',
                'barang.harga',
                DB::raw("(barang_keluar.jumlah * barang.harga) as total_harga"),
                DB::raw("'Stok Keluar' as keterangan")
            );

        if ($tglAwal && $tglAkhir) {
            $masuk->whereBetween('barang_masuk.tanggal', [$tglAwal, $tglAkhir]);
            $keluar->whereBetween('barang_keluar.tanggal', [$tglAwal, $tglAkhir]);
        }

        if ($jenis == 'masuk') {
            return $masuk->orderBy('tanggal', 'desc')->get();
        } elseif ($jenis == 'keluar') {
            return $keluar->orderBy('tanggal', 'desc')->get();
        }

        $query = $masuk->unionAll($keluar);

        return DB::table(DB::raw("({$query->toSql()}) as combined_table"))
            ->mergeBindings($query)
            ->orderBy('tanggal', 'desc')
            ->get();
    }

    public function laporan(Request $request)
    {
        $transaksi = $this->getQueryData($request);

        $totalTransaksi  = $transaksi->count();
        $totalMasuk      = $transaksi->where('jenis', 'masuk')->sum('jumlah');
        $totalKeluar     = $transaksi->where('jenis', 'keluar')->sum('jumlah');
        $totalPendapatan = $transaksi->where('jenis', 'keluar')->sum('total_harga');

        return view('laporan.index', compact(
            'transaksi', 'totalTransaksi', 'totalMasuk', 'totalKeluar', 'totalPendapatan'
        ));
    }

    public function cetak(Request $request)
    {
        $transaksi = $this->getQueryData($request);

        $totalTransaksi  = $transaksi->count();
        $totalMasuk      = $transaksi->where('jenis', 'masuk')->sum('jumlah');
        $totalKeluar     = $transaksi->where('jenis', 'keluar')->sum('jumlah');
        $totalPendapatan = $transaksi->where('jenis', 'keluar')->sum('total_harga');

        $pdf = Pdf::loadView('laporan.cetak', compact(
            'transaksi', 'totalTransaksi', 'totalMasuk', 'totalKeluar', 'totalPendapatan'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('laporan-transaksi-' . date('d-m-Y') . '.pdf');
    }
}