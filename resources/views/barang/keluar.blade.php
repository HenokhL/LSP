@extends('layout.main')

@section('content')
<div class="card p-4" style="border-radius: 12px; border: none; shadow: 0px 4px 12px rgba(0,0,0,0.05)">
    <h4 class="fw-bold mb-3">📦 Input List Penjualan (Barang Keluar)</h4>

    {{-- 🔥 TAMBAHAN: Menampilkan alert jika input penjualan melebihi sisa stok --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 🔥 DISESUAIKAN: Action form mengarah ke route 'barang.simpanKeluar' sesuai di BarangController --}}
    <form action="{{ route('barang.simpanKeluar') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Pilih Produk</label>
            <select name="id_barang" class="form-select" required>
                <option value="">-- Pilih Barang yang Dijual --</option>
                @foreach($barang as $b)
                    <option value="{{ $b->id_barang }}">{{ $b->nama_barang }} (Sisa Stok: {{ $b->stok }})</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Tanggal Penjualan</label>
            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Jumlah Barang Keluar</label>
            <input type="number" name="jumlah" class="form-control" min="1" placeholder="Contoh: 5" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Keterangan / Catatan</label>
            <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Penjualan retail / Pesanan online">
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-dark w-100" style="background-color: #0f172a;">Simpan Penjualan</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection