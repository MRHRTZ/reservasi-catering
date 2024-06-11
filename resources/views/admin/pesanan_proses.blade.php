@extends('admin.master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pesanan #{{ request()->route('id_pesanan') }}</h1>
    </div>

    <div class="row mt-4">
        <div class="card col-lg-7 my-4">
            <div class="form-group">
                <label for="date">Tanggal Catering</label>
                <input type="text" name="date" id="date" value="{{ $pesanan->tanggal }}" class="form-control"
                    readonly>
            </div>
            <div class="form-group">
                <label for="delivery">Pengambilan</label>
                <input type="text" name="delivery" value="{{ $pesanan->pengambilan }}" class="form-control" readonly>
            </div>
            @if ($pesanan->pengambilan == 'delivery')
                <div class="form-group" id="shipping-address" style="display: none">
                    <label for="address">Alamat Pengiriman</label>
                    <textarea name="address" id="address" class="form-control" readonly>{{ $pesanan->alamat ?? '-' }}</textarea>
                </div>
            @endif
            <div class="form-group">
                <label for="payment">Metode Pembayaran</label>
                <input type="text" name="payment" value="{{ $pesanan->kode_pembayaran ?? '-' }}" class="form-control"
                    readonly>
            </div>
            <div class="form-group">
                <label for="notes">Catatan Pesanan</label>
                <textarea name="notes" id="notes" class="form-control" readonly>{{ $pesanan->catatan_pembeli ?? '-' }}</textarea>
            </div>
            <div class="form-group">
                <label for="file">Bukti Pembayaran: </label>
                @if ($pesanan->bukti_pembayaran == null)
                    <span class="text-danger">Belum ada bukti pembayaran</span>
                @endif
                <a target="_blank"
                    href="{{ asset('bukti_pembayaran/' . $pesanan->bukti_pembayaran) }}">{{ $pesanan->bukti_pembayaran }}</a>
            </div>
            <hr>
            <div class="form-group">
                <label for="file">Catatan Penjual: </label>
                <textarea name="seller_notes" class="form-control" placeholder="Masukan catatan tambahan..." required>{{ $pesanan->catatan_penjual }}</textarea>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Simpan Catatan</button>
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
                            <div class="col-3">
                                <img src="{{ asset('menu/' . $menu['gambar']) }}" alt="{{ $menu['nama'] }}"
                                    class="img-fluid">
                            </div>
                            <div class="col-4">
                                <h5>{{ $menu['nama'] }}</h5>
                                <p>Jumlah: x{{ $menu['jumlah'] }}</p>
                            </div>
                            <div class="col-4 text-right">
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
                    @if ($pesanan->status == 'PROCESS')
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-2">
                                <a href="{{ route('admin.pesanan.terima', ['id_pesanan' => $pesanan->id]) }}"
                                    class="btn btn-block btn-success">Terima</a>
                            </div>
                            <div class="col-12 col-sm-6">
                                <button type="button" data-toggle="modal" data-target="#tolakModal"
                                    class="btn btn-block btn-danger">Tolak</button>
                            </div>
                        </div>
                    @elseif ($pesanan->status == 'ACCEPTED')
                        <a href="{{ route('admin.pesanan.kirim', ['id_pesanan' => $pesanan->id]) }}"
                            class="btn btn-block btn-info">Kirim Pesanan</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.pesanan.tolak', ['id_pesanan' => $pesanan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Masukan alasan penolakan pesanan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea name="alasan" class="form-control" placeholder="Isi alasan penolakan pesanan..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger mt-2">Tolak Pesanan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
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
