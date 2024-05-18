@extends('pelanggan.master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        @if ($page == 'edit')
            <h1 class="h3 mb-0 text-gray-800">Form Edit Pengguna</h1>
        @else
            <h1 class="h3 mb-0 text-gray-800">Form Tambah Pengguna</h1>
        @endif
    </div>

    <a href="{{ route('admin.pengguna') }}" class="btn btn-primary">Kembali</a>
    <div class="mt-4">
        @if ($page == 'edit')
            <form action="{{ route('admin.pengguna.save', ['id' => $pengguna->id]) }}" method="POST">
            @else
                <form action="{{ route('admin.pengguna.store') }}" method="POST">
        @endif
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            @if ($page == 'edit')
                <input value="{{ $pengguna->nama }}" type="text" name="nama" id="name" class="form-control"
                    required>
            @else
                <input type="text" name="nama" id="name" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            @if ($page == 'edit')
                <input value="{{ $pengguna->email }}" type="email" name="email" id="email" class="form-control"
                    required>
            @else
                <input type="email" name="email" id="email" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="no_hp">No. HP</label>
            @if ($page == 'edit')
                <input value="{{ $pengguna->no_hp }}" type="text" name="no_hp" id="no_hp" class="form-control"
                    required>
            @else
                <input type="text" name="no_hp" id="no_hp" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            @if ($page == 'edit')
                <input type="password" name="password" id="password" placeholder="Masukan password untuk mengganti"
                    class="form-control">
            @else
                <input type="password" name="password" id="password" placeholder="Masukan password"
                    class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            @if ($page == 'edit')
                <textarea name="alamat" id="alamat" class="form-control" required>{{ $pengguna->alamat }}</textarea>
            @else
                <textarea name="alamat" id="alamat" class="form-control" required></textarea>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
