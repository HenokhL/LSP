@extends('layout.main')

@section('title', 'Data Kategori')
@section('page-title', 'Data Kategori')

@section('content')

<div class="card">

    <div class="card-header">
        <span>
            <i class="fas fa-tags"></i>
            Data Kategori
        </span>

        <button class="btn btn-teal"
                onclick="document.getElementById('formTambah').style.display='block'">
            <i class="fas fa-plus"></i>
            Tambah Kategori
        </button>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div style="padding:10px;background:#dcfce7;color:#166534;margin-bottom:15px;border-radius:6px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Tambah -->
        <div id="formTambah" style="display:none;margin-bottom:20px;">
            <form action="{{ route('kategori.simpan') }}" method="POST">
                @csrf
                <input type="text"
                       name="nama_kategori"
                       placeholder="Nama Kategori"
                       required
                       style="padding:10px;width:300px;">
                <button type="submit" class="btn btn-teal">Simpan</button>
            </form>
        </div>

        <table width="100%">
            <thead>
                <tr>
                    <th width="80">ID</th>
                    <th>Nama Kategori</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kategori as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>
                        <form action="{{ route('kategori.update', $item->id) }}"
                              method="POST"
                              style="display:inline">
                            @csrf
                            <input type="text"
                                   name="nama_kategori"
                                   value="{{ $item->nama_kategori }}"
                                   style="padding:6px;">
                            <button class="btn btn-navy">
                                <i class="fas fa-save"></i>
                            </button>
                        </form>

                        <a href="{{ route('kategori.hapus', $item->id) }}"
                           class="btn btn-red"
                           onclick="return confirm('Yakin ingin menghapus kategori?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" align="center">Belum ada data kategori</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection