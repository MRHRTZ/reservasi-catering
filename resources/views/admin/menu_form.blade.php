@extends('admin.master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        @if ($page == 'edit')
            <h1 class="h3 mb-0 text-gray-800">Form Edit Menu</h1>
        @else
            <h1 class="h3 mb-0 text-gray-800">Form Tambah Menu</h1>
        @endif
    </div>

    <a href="{{ route('admin.menu') }}" class="btn btn-primary">Kembali</a>
    <div class="mt-4">
        @if ($page == 'edit')
            <form action="{{ route('admin.menu.save', ['id' => $menu->id]) }}" method="POST" enctype="multipart/form-data">
            @else
                <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            @if ($page == 'edit')
                <input value="{{ $menu->nama }}" type="text" name="nama" id="name" class="form-control"
                    required>
            @else
                <input type="text" name="nama" id="name" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            @if ($page == 'edit')
                <input value="{{ $menu->deskripsi }}" type="text" name="deskripsi" id="deskripsi" class="form-control"
                    required>
            @else
                <input type="text" name="deskripsi" id="deskripsi" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            @if ($page == 'edit')
                <input value="{{ $menu->harga }}" type="number" name="harga" id="harga" class="form-control"
                    required>
            @else
                <input type="number" name="harga" id="harga" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            @if ($page == 'edit')
                <input value="{{ $menu->stok }}" type="number" name="stok" id="stok" class="form-control"
                    required>
            @else
                <input type="number" name="stok" id="stok" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="gambar">Gambar</label>
            @if ($page == 'edit')
                <input type="file" name="gambar" id="gambar" placeholder="Masukan gambar untuk mengganti"
                    class="form-control">
            @else
                <input type="file" name="gambar" id="gambar" placeholder="Masukan gambar"
                    class="form-control" required>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
