@extends('pelanggan.master')

@section('content')
    {{-- <h1 class="heading"> Menu </h1> --}}
    <div class="container" style="margin-bottom: 100px">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <p class="card-title col">Paket A </p>
                            <input class="form-check-input col text-right" style="margin-left: 7rem; position:absolute"
                                type="checkbox" value="" id="myCheckbox">
                        </div>
                        <img src="{{ asset('img/ayam goreng.jpg') }}" alt="makanan" class="img-fluid">
                        <p class="card-text text-dark">Ayam goreng,nasi,sayur sop,lalapan,tempe tahu</p>
                        <div class="box-container">
                            <div class="box row">
                                <p class="card-text col" style="font-size:1.3vw ">Rp.25.0000</p>
                                <button class="btn btn-danger col">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <p class="card-title col">Paket B </p>
                            <input class="form-check-input col text-right" style="margin-left: 7rem; position:absolute"
                                type="checkbox" value="" id="myCheckbox">
                        </div>
                        <img src="{{ asset('img/nasi bebek.png') }}" alt="makanan" class="img-fluid">
                        <p class="card-text">nasi bebek,lalapan,tempe tahu,buah,es teh</p>
                        <div class="box-container">
                            <div class="box row">
                                <p class="card-text col" style="font-size:1.3vw ">Rp.28.0000</p>
                                <button class="btn btn-danger col">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <p class="card-title col">Paket C </p>
                            <input class="form-check-input col text-right" style="margin-left: 7rem; position:absolute"
                                type="checkbox" value="" id="myCheckbox">
                        </div>
                        <img src="{{ asset('img/nasgor.jpeg') }}" alt="makanan" class="img-fluid"
                            style="width: -webkit-fill-available;">
                        <p class="card-text">Nasi Goreng seafood,telur,lalapan,es teh,buah</p>
                        <div class="box-container">
                            <div class="box row">
                                <p class="card-text col" style="font-size:1.3vw ">Rp.30.0000</p>
                                <button class="btn btn-danger col">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Paket C </h5>
                        <img src="{{ asset('img/nasgor.jpeg') }}" alt="makanan" class="img-fluid"
                            style="width: -webkit-fill-available;
                        ">
                        <p class="card-text">Nasi Goreng seafood,telur,lalapan,es teh,buah</p>
                        <div class="box-container">
                            <div class="box row">
                                <p class="card-text col" style="font-size:1.3vw ">Rp.30.0000</p>
                                <button class="btn btn-danger col">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Paket C </h5>
                        <img src="{{ asset('img/nasgor.jpeg') }}" alt="makanan" class="img-fluid"
                            style="width: -webkit-fill-available;
                        ">
                        <p class="card-text">Nasi Goreng seafood,telur,lalapan,es teh,buah</p>
                        <div class="box-container">
                            <div class="box row">
                                <p class="card-text col" style="font-size:1.3vw ">Rp.30.0000</p>
                                <button class="btn btn-danger col">Hapus</button>
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

@section('footer')
    <!-- Footer -->
    <footer class="sticky-footer bg-white" style="position: fixed; width: 87%; bottom: 0;">
        {{-- <div class="container my-auto"> --}}
        <div class="row my-auto">
            <div class="col-6"></div>
            <p class="col-2"> Total: Rp.2.000.000</p>
            <button class=" col-2 btn btn-primary float-right">Bayar</button>
            <div class="col-1"></div>
        </div>
        {{-- </div> --}}
    </footer>
    <!-- End of Footer -->

@endsection
