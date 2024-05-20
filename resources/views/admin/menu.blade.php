@extends('admin.master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Menu Makanan</h1>
    </div>

    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Tambah Menu</a>
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menu as $m)
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td><img src="{{ asset('menu/' . $m->gambar) }}" alt="gambar" style="width: 100px"></td>
                        <td>{{ $m->nama }}</td>
                        <td>{{ $m->deskripsi }}</td>
                        <td class="rupiah">{{ $m->harga }}</td>
                        <td>{{ $m->stok }}</td>
                        <td>
                            <a href="{{ route('admin.menu.edit', $m->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('admin.menu.delete', $m->id) }}" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('script')
    <script>
        var table = new DataTable(".table");
    </script>
@endsection