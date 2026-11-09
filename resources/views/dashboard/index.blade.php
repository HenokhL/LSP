@extends('layout.main')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon teal"><i class="fas fa-box"></i></div>
        <div class="stat-info">
            <div class="label">Total Barang</div>
            <div class="value">{{ $totalBarang }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon navy"><i class="fas fa-cubes"></i></div>
        <div class="stat-info">
            <div class="label">Total Stok</div>
            <div class="value">{{ number_format($totalStok) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-exclamation-circle"></i></div>
        <div class="stat-info">
            <div class="label">Barang Habis</div>
            <div class="value">{{ $totalHabis }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-tags"></i></div>
        <div class="stat-info">
            <div class="label">Total Kategori</div>
            <div class="value">{{ $totalKategori }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-money-bill-wave"></i></div>
        <div class="stat-info">
            <div class="label">Penjualan Bulan Ini</div>
            <div class="value">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
        </div>
    </div>

    <a href="{{ route('users.index') }}" style="text-decoration: none; color: inherit;">
        <div class="stat-card" style="cursor: pointer; border: 1px solid #e2e8f0;">
            <div class="stat-icon navy"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <div class="label">Total User</div>
                <div class="value">{{ $totalUser }}</div>
            </div>
        </div>
    </a>
</div>

<div class="stat-grid" style="margin-top:1rem;">
    <div class="stat-card">
        <div class="stat-icon teal"><i class="fas fa-arrow-down"></i></div>
        <div class="stat-info">
            <div class="label">Total Barang Masuk</div>
            <div class="value">{{ number_format($barangMasuk ?? 0) }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-arrow-up"></i></div>
        <div class="stat-info">
            <div class="label">Total Barang Keluar</div>
            <div class="value">{{ number_format($barangKeluar ?? 0) }}</div>
        </div>
    </div>
</div>

<div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1.5rem; margin-top:1rem;">
    <div class="card">
        <div class="card-header"><span><i class="fas fa-chart-bar"></i> Grafik Penjualan 6 Bulan</span></div>
        <div class="card-body"><canvas id="grafikPenjualan" height="200"></canvas></div>
    </div>

    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <span><i class="fas fa-clock"></i> Barang Terbaru</span>
            <a href="{{ route('barang.index') }}" class="btn btn-navy" style="font-size:0.75rem; padding:0.3rem 0.7rem; text-decoration: none; border-radius: 4px;">Lihat Semua</a>
        </div>
        <div class="card-body" style="padding:0;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 10px; text-align: left;">Nama Barang</th>
                        <th style="padding: 10px; text-align: left;">Kategori</th>
                        <th style="padding: 10px; text-align: left;">Stok</th>
                        <th style="padding: 10px; text-align: left;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangTerbaru as $b)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 10px;">{{ $b->nama_barang }}</td>
                        <td style="padding: 10px;">{{ $b->kategori->nama_kategori ?? '-' }}</td>
                        <td style="padding: 10px; font-weight: bold;">{{ $b->stok ?? 0 }}</td>
                        <td style="padding: 10px;">
                            @if(($b->stok ?? 0) >= 10)
                                <span class="badge badge-success">Tersedia</span>
                            @elseif(($b->stok ?? 0) > 0)
                                <span class="badge badge-warning">Stok Menipis</span>
                            @else
                                <span class="badge badge-danger">Habis</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding: 20px;">Tidak ada data barang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
    const labels = @json($grafik->pluck('bulan'));
    const data   = @json($grafik->pluck('total'));

    new Chart(document.getElementById('grafikPenjualan'), {
        type: 'bar',
        data: {
            labels: labels.length ? labels : ['Jan','Feb','Mar','Apr','Mei','Jun'],
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: data.length ? data : [0,0,0,0,0,0],
                backgroundColor: '#1B9EA5',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection