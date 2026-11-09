@extends('layout.main')

@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang')

@section('content')

<div class="card">

    <div class="card-header">
        <span>Edit Data Barang</span>
    </div>

    <div class="card-body">

        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            {{-- ✅ fix: id_barang → id --}}

            @csrf

            <div style="margin-bottom:15px;">
                <label>Kode Barang</label>
                <input type="text"
                       name="kode_barang"
                       value="{{ $barang->kode_barang }}"
                       required
                       style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Nama Barang</label>
                <input type="text"
                       name="nama_barang"
                       value="{{ $barang->nama_barang }}"
                       required
                       style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Kategori</label>
                <select name="kategori_id" required style="width:100%;padding:10px;">
                    {{-- ✅ fix: id_kategori → kategori_id --}}
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}"
                            {{ $barang->kategori_id == $k->id ? 'selected' : '' }}>
                            {{-- ✅ fix: id_kategori → id, barang->id_kategori → kategori_id --}}
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:15px;">
                <label>Stok</label>
                <input type="number"
                       name="stok"
                       value="{{ $barang->stok }}"
                       required
                       style="width:100%;padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label style="font-weight: 600; color: #1B9EA5;">Harga Barang (Rp)</label>
                <input type="number"
                       name="harga"
                       value="{{ $barang->harga ?? 0 }}"
                       min="0"
                       placeholder="Contoh: 150000"
                       required
                       style="width:100%;padding:10px; border: 1px solid #1B9EA5; border-radius: 4px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Status</label>
                <select name="status" style="width:100%;padding:10px;">
                    {{-- ✅ fix: status_barang → status --}}
                    <option value="tersedia"
                        {{ strtolower($barang->status) == 'tersedia' ? 'selected' : '' }}>
                        Tersedia
                    </option>
                    <option value="habis"
                        {{ strtolower($barang->status) == 'habis' ? 'selected' : '' }}>
                        Habis
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-teal">Update</button>
            <a href="{{ route('barang.index') }}" class="btn btn-red">Batal</a>

        </form>

    </div>

</div>

@endsection