@extends('layout.main')

@section('title', 'Tambah Barang')
@section('page-title', 'Tambah Barang')

@section('content')

<div class="card">
    <div class="card-header">
        <span>Tambah Data Barang</span>
    </div>

    <div class="card-body">
        <form action="{{ route('barang.simpan') }}" method="POST">
            @csrf

            <div style="margin-bottom:15px;">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" required style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" required style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Kategori</label>
                <select name="kategori_id" required style="width:100%;padding:10px;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:15px;">
                <label>Stok</label>
                <input type="number" name="stok" min="0" required style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Harga</label>
                <input type="number" name="harga" required style="width:100%;padding:10px;">
            </div>

            <button type="submit" class="btn btn-teal">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-red">Batal</a>
        </form>
    </div>
</div>

@endsection