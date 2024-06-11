@extends('pelanggan.master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Checkout - Pesanan #{{ request()->route('id_pesanan') }}</h1>
    </div>
    <form action="{{ route('pelanggan.checkout.bayar', ['id_pesanan' => request()->route('id_pesanan')]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
            <div class="card col-lg-7 my-4">
                <div class="form-group">
                    <label for="date">Tanggal Catering</label>
                    <input type="datetime-local" name="date" id="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="delivery">Pengambilan</label>
                    <select name="delivery" id="delivery" class="form-control" required>
                        <option selected disabled>Pilih Jenis Pengambilan</option>
                        <option value="delivery">Delivery</option>
                        <option value="pick_up">Pick Up</option>
                    </select>
                </div>
                <div class="form-group" id="shipping-address" style="display: none">
                    <label for="address">Alamat Pengiriman</label>
                    <textarea name="address" id="address" class="form-control">{{ Auth::user()->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <label for="payment">Metode Pembayaran</label>
                    <select name="payment" id="payment" class="form-control" required>
                        <option selected disabled>Pilih Bank/Wallet</option>
                        @foreach ($pembayaran as $item)
                            <option value="{{ $item->kode_pembayaran }}">{{ $item->metode }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="transfer" style="display: none">
                    <label for="transfer_destination">Transfer</label>
                    <div class="alert alert-info">
                        Harap transfer pembayaran ke rekening berikut:
                        <ul>
                            <li>Bank/Wallet: <span id="bank-method"></span></li>
                            <li>Nomor: <span id="bank-no"></span></li>
                            <li>Atas Nama: <span id="bank-name"></span></li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <label for="notes">Catatan Pesanan</label>
                    <textarea name="notes" id="notes" class="form-control" placeholder="Masukan catatan anda disini..."></textarea>
                </div>
                <div class="form-group">
                    <label for="file">Bukti Pembayaran</label>
                    <input type="file" name="file" id="file" class="form-control-file" required>
                </div>
            </div>
            <div class="col-lg-5 my-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Menu Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <!-- Place your menu order details here -->
                        @foreach ($menus as $menu)
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <img src="{{ asset('menu/' . $menu['gambar']) }}" alt="{{ $menu['nama'] }}"
                                        class="img-fluid">
                                </div>
                                <div class="col-md-4">
                                    <h5>{{ $menu['nama'] }}</h5>
                                    <p>Jumlah: x{{ $menu['jumlah'] }}</p>
                                </div>
                                <div class="col-md-4 text-right">
                                    <p>
                                        <span>Total:</span>
                                        <span class="rupiah">{{ $menu['harga'] }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <div class="row my-2">
                            <p class="col h6 card-title">Total Pembayaran</p>
                            <p class="col h5 text-success text-right font-weight-bold rupiah"> {{ $total_harga }}</p>
                        </div>
                        <button type="submit" class="btn btn-block btn-success">Pembayaran Selesai</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const delivery = $('#delivery');
            delivery.change(function() {
                let value = $(this).val();
                let address = $('#shipping-address');
                if (value === 'delivery') {
                    address.show();
                } else {
                    address.hide();
                }
            });

            const payment = @json($pembayaran);
            $('#payment').change(function() {
                let method = $(this).val();
                console.log(method);
                let bank = $('#bank-method');
                let no = $('#bank-no');
                let name = $('#bank-name');

                let paymentData = @json($pembayaran);

                let selectedPayment = paymentData.find(payment => payment.kode_pembayaran === method);

                if (selectedPayment) {
                    bank.text(selectedPayment.bank);
                    no.text(selectedPayment.nomor);
                    name.text(selectedPayment.nama);
                    $('#transfer').show();
                }
            });
        });
    </script>
@endsection
