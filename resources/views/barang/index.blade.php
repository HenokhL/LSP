@extends('layout.main')

@section('title', 'Data Barang')

@section('page-title', 'Data Barang')

@section('styles')
<style>
    .card{
        background:#fff;
        border-radius:10px;
        box-shadow:0 2px 8px rgba(0,0,0,.08);
        overflow:hidden;
    }

    .card-header{
        background:#1B9EA5;
        color:#fff;
        padding:15px 20px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        font-weight:600;
    }

    .card-body{
        padding:20px;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    table th{
        background:#f8fafc;
        color:#1a2e5a;
        padding:12px;
        text-align:left;
        border-bottom:1px solid #ddd;
    }

    table td{
        padding:12px;
        border-bottom:1px solid #eee;
    }

    table tr:hover{
        background:#f9fafb;
    }

    .badge{
        padding:5px 12px;
        border-radius:20px;
        font-size:12px;
        font-weight:600;
    }

    .badge-success{
        background:#dcfce7;
        color:#15803d;
    }

    .badge-danger{
        background:#fee2e2;
        color:#dc2626;
    }

    .badge-warning{
        background:#fef3c7;
        color:#b45309;
    }

    .btn{
        padding:8px 14px;
        border:none;
        border-radius:6px;
        text-decoration:none;
        cursor:pointer;
        font-size:13px;
        display:inline-flex;
        align-items:center;
        gap:5px;
    }

    .btn-teal{
        background:#1B9EA5;
        color:white;
    }

    .btn-navy{
        background:#1a2e5a;
        color:white;
    }

    .btn-red{
        background:#ef4444;
        color:white;
    }

    .aksi{
        display:flex;
        gap:5px;
    }
</style>
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        <span>
            <i class="fas fa-box" style="color: #ffffff;"></i>
            Data Barang
        </span>

        <a href="{{ route('barang.tambah') }}" class="btn btn-teal" style="color: #ffffff;">
            <i class="fas fa-plus" style="color: #ffffff;"></i> Tambah Barang
        </a>
    </div>

    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($barang as $item)
                <tr>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->stok }}</td>
                    <td style="font-weight: 500;">
                        Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                    </td>
                    <td>
                        @php
                            $status = strtolower($item->status ?? 'tersedia');
                        @endphp

                        @if($status == 'tersedia')
                            <span class="badge badge-success">Tersedia</span>
                        @elseif($status == 'habis')
                            <span class="badge badge-danger">Habis</span>
                        @else
                            <span class="badge badge-warning">{{ $item->status }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="aksi">
                            <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-navy" style="color: #ffffff;">
                                <i class="fas fa-edit" style="color: #ffffff;"></i>
                            </a>

                            <a href="{{ route('barang.hapus', $item->id) }}" class="btn btn-red" style="color: #ffffff;"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash" style="color: #ffffff;"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:20px;">
                        Belum ada data barang
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection