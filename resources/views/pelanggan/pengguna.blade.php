@extends('pelanggan.master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengguna</h1>
    </div>

    <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">Tambah Pengguna</a>
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengguna as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->no_hp }}</td>
                        <td>
                            <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('admin.pengguna.delete', $user->id) }}" class="btn btn-danger">Hapus</a>
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
