@extends('pelanggan.master')

@section('content')
    {{-- <h1 class="heading"> Menu </h1> --}}
    <div class="container">
        <div class="row">
            @if (count($menu) == 0)
                <div class="alert alert-secondary" role="alert">
                    <span class="text-secondary">
                        Menu masih kosong, hubungi admin untuk menambah menu.
                    </span>
                </div>
            @endif
            @foreach ($menu as $m)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <span class="col-6 card-title h5">{{ $m->nama }}</span>
                                <span class="col-6 text-right">Stok: {{ $m->stok }}</span>

                            </div>
                            <img src="{{ asset('menu/' . $m->gambar) }}" alt="{{ $m->nama }}" class="img-fluid"
                                style="width: -webkit-fill-available;">
                            <div class="conten row my-2">
                                <div class="starst col">
                                    @php
                                        $roundedRating = round($m->rating);
                                    @endphp
                                    @for ($i = 0; $i < $roundedRating; $i++)
                                        <i class="fas fa-star" style="color: yellow"></i>
                                    @endfor
                                    @for ($i = 0; $i < 5 - $roundedRating; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <div class="endst col text-right">
                                    <span class="badge badge-success">{{ $m->rating ?? 0 }}</span>
                                </div>
                            </div>
                            <p class="card-text text-dark">{{ $m->deskripsi }}</p>
                            <div class="box-container">
                                <div class="box row">
                                    <p class="card-text col rupiah" style="font-size:1.3vw ">{{ $m->harga }}</p>
                                    @if ($m->stok > 0)
                                    <form action="{{ route('pelanggan.keranjang.tambah', ['id_menu' => $m->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary col">Tambah</button>
                                    </form>
                                    @else
                                    <button type="button" class="btn btn-secondary col">Habis</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-4">
                <!-- Repeat similar structure for burger -->
            </div>
            <div class="col-md-4">
                <!-- Repeat similar structure for pasta -->
            </div>
        </div>
    </div>
@endsection
