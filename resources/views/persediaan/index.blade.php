@extends('layout.main')

@section('title', 'Input Persediaan')
@section('page-title', 'Manajemen Persediaan Barang')

@section('styles')
<style>
    .table-persediaan {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    .table-persediaan thead th {
        background-color: #f8fafc;
        color: #64748b;
        padding: 10px 12px;
        text-align: left;
        font-size: 0.85rem;
        font-weight: 600;
        border-bottom: 1px solid #e2e8f0;
    }
    .table-persediaan tbody td {
        padding: 12px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #334155;
    }
    .badge-status {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-tersedia { background-color: #dcfce7; color: #16a34a; }
    .badge-menipis { background-color: #fef9c3; color: #ca8a04; }
    .badge-habis { background-color: #fee2e2; color: #dc2626; }
</style>
@endsection

@section('content')

@if(session('success'))
    <div style="padding: 12px; background: #dcfce7; color: #16a34a; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; font-weight: 500;">
        ✅ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="padding: 12px; background: #fee2e2; color: #dc2626; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; font-weight: 500;">
        ❌ {{ session('error') }}
    </div>
@endif

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">

    {{-- Form Barang Masuk --}}
    <div class="card" style="border: 1px solid #e2e8f0; background: #fff; border-radius: 8px; overflow: hidden;">
        <div class="card-header" style="background: #1B9EA5; color: #fff; padding: 12px 15px; font-weight: 600;">
            <span><i class="fas fa-arrow-down"></i> Form Barang Masuk (Restock)</span>
        </div>
        <div class="card-body" style="padding: 1.5rem;">
            <form action="{{ route('persediaan.storeMasuk') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label style="font-size: 0.85rem; font-weight: 600; color: #4a5568; display:block; margin-bottom: 5px;">Pilih Barang</label>
                    <select name="id_barang" required style="width:100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; outline:none;">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($daftarBarang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} (Stok Saat Ini: {{ $b->stok ?? 0 }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="font-size: 0.85rem; font-weight: 600; color: #4a5568; display:block; margin-bottom: 5px;">Jumlah Masuk</label>
                    <input type="number" name="jumlah" min="1" required placeholder="Contoh: 50" style="width:100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; outline:none;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 600; color: #4a5568; display:block; margin-bottom: 5px;">Tanggal Masuk</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required style="width:100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; outline:none;">
                </div>

                <button type="submit" style="width: 100%; justify-content: center; padding: 12px; border-radius:6px; background-color: #1B9EA5; color: #fff; border: none; font-weight: 600; cursor: pointer;">
                    <i class="fas fa-plus-circle"></i> Simpan Barang Masuk
                </button>
            </form>
        </div>
    </div>

    {{-- Form Barang Keluar --}}
    <div class="card" style="border: 1px solid #e2e8f0; background: #fff; border-radius: 8px; overflow: hidden;">
        <div class="card-header" style="background: #ef4444; color: #fff; padding: 12px 15px; font-weight: 600;">
            <span><i class="fas fa-arrow-up"></i> Form Barang Keluar (Penjualan)</span>
        </div>
        <div class="card-body" style="padding: 1.5rem;">
            <form action="{{ route('persediaan.storeKeluar') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label style="font-size: 0.85rem; font-weight: 600; color: #4a5568; display:block; margin-bottom: 5px;">Pilih Barang</label>
                    <select name="id_barang" required style="width:100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; outline:none;">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($daftarBarang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} (Stok Saat Ini: {{ $b->stok ?? 0 }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="font-size: 0.85rem; font-weight: 600; color: #4a5568; display:block; margin-bottom: 5px;">Jumlah Keluar</label>
                    <input type="number" name="jumlah" min="1" required placeholder="Contoh: 10" style="width:100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; outline:none;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 600; color: #4a5568; display:block; margin-bottom: 5px;">Tanggal Keluar</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required style="width:100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; outline:none;">
                </div>

                <button type="submit" style="width: 100%; justify-content: center; padding: 12px; border-radius:6px; background-color:#ef4444; color: #fff; border: none; font-weight: 600; cursor: pointer;">
                    <i class="fas fa-minus-circle"></i> Catat Barang Keluar
                </button>
            </form>
        </div>
    </div>

</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">

    {{-- Tabel Status Stok --}}
    <div class="card" style="border: 1px solid #e2e8f0; background: #fff; border-radius: 8px; overflow: hidden;">
        <div class="card-header" style="background: #0f172a; color: #fff; padding: 12px 15px; font-weight: 600; display: flex; justify-content: space-between; align-items: center;">
            <span><i class="fas fa-warehouse"></i> Status & Kontrol Sisa Stok Gudang</span>
            <span style="font-size: 0.8rem; background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 20px;">
                Total: {{ $daftarBarang->count() }} Produk
            </span>
        </div>
        <div class="card-body" style="padding: 0; overflow-x: auto;">
            <table class="table-persediaan">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th style="text-align: center; width: 100px;">Jumlah Stok</th>
                        <th style="text-align: center; width: 140px;">Status Visual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftarBarang as $b)
                    @php
                        $st = strtolower($b->status ?? 'tersedia');
                        $stok = $b->stok ?? 0;
                    @endphp
                    <tr>
                        <td style="font-weight: 500;">{{ $b->nama_barang }}</td>
                        <td style="text-align: center; font-weight: bold; color: #0f172a;">{{ $stok }}</td>
                        <td style="text-align: center;">
                            @if($stok == 0)
                                <span class="badge-status badge-habis">Habis</span>
                            @elseif($stok <= 5)
                                <span class="badge-status badge-menipis">Stok Menipis</span>
                            @else
                                <span class="badge-status badge-tersedia">Tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 30px; color: #94a3b8;">
                            Belum ada master data barang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Info Status --}}
    <div class="card" style="border: 1px solid #e2e8f0; background: #fff; border-radius: 8px; padding: 1.5rem; height: fit-content;">
        <h5 style="margin-top: 0; margin-bottom: 1rem; color: #0f172a; font-weight: 600; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px;">
            💡 Informasi Status Stok
        </h5>
        <ul style="padding-left: 1.2rem; margin: 0; color: #475569; font-size: 0.88rem; line-height: 1.6;">
            <li style="margin-bottom: 8px;">
                <strong style="color: #16a34a;">Status Tersedia:</strong> Stok di atas <strong>5 unit</strong>.
            </li>
            <li style="margin-bottom: 8px;">
                <strong style="color: #ca8a04;">Status Stok Menipis:</strong> Stok tersisa <strong>1 sampai 5 unit</strong>.
            </li>
            <li>
                <strong style="color: #dc2626;">Status Habis:</strong> Stok menyentuh <strong>angka 0</strong>.
            </li>
        </ul>
    </div>

</div>

@endsection