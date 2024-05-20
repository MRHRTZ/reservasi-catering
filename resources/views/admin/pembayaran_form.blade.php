@extends('admin.master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        @if ($page == 'edit')
            <h1 class="h3 mb-0 text-gray-800">Form Edit Metode Pembayaran</h1>
        @else
            <h1 class="h3 mb-0 text-gray-800">Form Tambah Metode Pembayaran</h1>
        @endif
    </div>

    <a href="{{ route('admin.pembayaran') }}" class="btn btn-primary">Kembali</a>
    <div class="mt-4">
        @if ($page == 'edit')
            <form action="{{ route('admin.pembayaran.save', ['id' => $pembayaran->id]) }}" method="POST">
            @else
                <form action="{{ route('admin.pembayaran.store') }}" method="POST">
        @endif
        @csrf
        <div class="form-group">
            <label for="kode_pembayaran">Kode Pembayaran</label>
            @if ($page == 'edit')
                <input value="{{ $pembayaran->kode_pembayaran }}" type="text" name="kode_pembayaran" id="name" class="form-control"
                    required>
            @else
                <input type="text" name="kode_pembayaran" id="name" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            @if ($page == 'edit')
                <input value="{{ $pembayaran->nama }}" type="text" name="nama" id="name" class="form-control"
                    required>
            @else
                <input type="text" name="nama" id="name" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="metode">Metode</label>
            @if ($page == 'edit')
                <input value="{{ $pembayaran->metode }}" type="text" name="metode" id="metode" class="form-control"
                    required>
            @else
                <input type="text" name="metode" id="metode" class="form-control" required>
            @endif
        </div>
        <div class="form-group">
            <label for="nomor">Nomor</label>
            @if ($page == 'edit')
                <input value="{{ $pembayaran->nomor }}" type="text" name="nomor" id="nomor" class="form-control"
                    required>
            @else
                <input type="text" name="nomor" id="nomor" class="form-control" required>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
