@extends('admin.master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Metode Pembayaran</h1>
    </div>

    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary">Tambah Metode Pembayaran</a>
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Metode</th>
                    <th>Nomor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->kode_pembayaran }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->metode }}</td>
                        <td>{{ $p->nomor }}</td>
                        <td>
                            <a href="{{ route('admin.pembayaran.edit', $p->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('admin.pembayaran.delete', $p->id) }}" class="btn btn-danger">Hapus</a>
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
