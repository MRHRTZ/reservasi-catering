@extends('pelanggan.master')

@section('content')
    {{-- <h1 class="heading"> Menu </h1> --}}
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Paket A </h5>
                        <img src="{{ asset('img/ayam goreng.jpg') }}" alt="makanan" class="img-fluid">
                        <div class="conten m-2">
                            <div class="starst">
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text text-dark">Ayam goreng,nasi,sayur sop,lalapan,tempe tahu</p>
                        <div class="box-container">
                            <div class="box row">
                                <p class="card-text col" style="font-size:1.3vw ">Rp.25.0000</p>
                                <button class="btn btn-primary col">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Paket B </h5>
                        <img src="{{ asset('img/nasi bebek.png') }}" alt="makanan" class="img-fluid">
                        <div class="conten m-2">
                            <div class="starst">
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star" style="color: yellow"></i>
                            </div>
                        </div>
                        <p class="card-text">nasi bebek,lalapan,tempe tahu,buah,es teh</p>
                        <div class="box-container">
                            <div class="box row">
                                <p class="card-text col" style="font-size:1.3vw ">Rp.28.0000</p>
                                <button class="btn btn-primary col">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Paket C </h5>
                        <img src="{{ asset('img/nasgor.jpeg') }}" alt="makanan" class="img-fluid" style="width: -webkit-fill-available;
                        ">
                        <div class="conten m-2">
                            <div class="starst">
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star" style="color: yellow"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">Nasi Goreng seafood,telur,lalapan,es teh,buah</p>
                        <div class="box-container">
                            <div class="box row">
                                <p class="card-text col" style="font-size:1.3vw ">Rp.30.0000</p>
                                <button class="btn btn-primary col">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Repeat similar structure for burger -->
            </div>
            <div class="col-md-4">
                <!-- Repeat similar structure for pasta -->
            </div>
        </div>
    </div>
@endsection
