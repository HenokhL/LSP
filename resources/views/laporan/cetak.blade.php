<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Inventory - Prime Jacket Store</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #1a2e5a; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #1a2e5a; font-size: 18px; letter-spacing: 1px; }
        .header p { margin: 4px 0 0 0; color: #555; font-size: 12px; }
        .info { margin-bottom: 15px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #1B9EA5; color: white; text-transform: uppercase; font-size: 10px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .badge-masuk { color: #16a34a; font-weight: bold; }
        .badge-keluar { color: #dc2626; font-weight: bold; }
        .total-box { margin-top: 25px; text-align: right; font-size: 13px; font-weight: bold; color: #16a34a; border-top: 1px dashed #ccc; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>PRIME JACKET STORE</h2>
        <p>Laporan Riwayat Persediaan & Aktivitas Transaksi Gudang</p>
    </div>

    <div class="info">
        <strong>Tanggal Cetak:</strong> {{ date('d/m/Y H:i') }} WIB
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 30%;">Nama Barang</th>
                <th style="width: 15%;">Jenis</th>
                <th style="width: 10%;">Qty</th>
                <th style="width: 15%;">Total Nilai Jual</th>
                <th style="width: 15%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $t)
            <tr>
                <td>{{ date('d/m/Y', strtotime($t->tanggal)) }}</td>
                <td style="font-weight: bold;">{{ $t->nama_barang }}</td>
                <td>
                    @if(strtolower($t->jenis) == 'masuk')
                        <span class="badge-masuk">MASUK</span>
                    @else
                        <span class="badge-keluar">KELUAR</span>
                    @endif
                </td>
                <td>{{ $t->jumlah }} pcs</td>
                <td>
                    @if(strtolower($t->jenis) == 'keluar')
                        Rp {{ number_format($t->total_harga ?? 0, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $t->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; padding: 20px;">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-box">
        TOTAL TRANSAKSI: {{ $totalTransaksi }} |
        MASUK: {{ $totalMasuk }} pcs |
        KELUAR: {{ $totalKeluar }} pcs |
        TOTAL NILAI JUAL: Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
    </div>

</body>
</html>