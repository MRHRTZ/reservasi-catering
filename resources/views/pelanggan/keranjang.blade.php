@extends('pelanggan.master')

@section('content')
    {{-- <h1 class="heading"> Menu </h1> --}}
    <div class="container" style="margin-bottom: 100px">
        <div class="row">
            @if (count($keranjang) == 0)
                <div class="alert alert-secondary" role="alert">
                    <span class="text-secondary">
                        Keranjang anda masih kosong, silahkan pilih menu terlebih dahulu.
                    </span>
                </div>
            @endif
            @foreach ($keranjang as $k)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <p class="card-title col h5">{{ $k->nama }}</p>
                                <input class="form-check-input col text-right" style="margin-left: 7rem; position:absolute"
                                    type="checkbox" value="" id="myCheckbox">
                            </div>
                            <img src="{{ asset('menu/' . $k->gambar) }}" alt="makanan" class="img-fluid"
                                style="width: -webkit-fill-available;">
                            <p class="card-text my-2">{{ $k->deskripsi }}</p>
                            <div class="box-container">
                                <div class="box row mb-3">
                                    <div class="col">
                                        <button class="btn btn-primary decrement" data-id="{{ $k->id }}">-</button>
                                    </div>
                                    <div class="col text-center">
                                        <p class="card-text counter" data-id="{{ $k->id }}"
                                            data-stock="{{ $k->stok }}" data-price="{{ $k->harga_menu }}"
                                            style="font-size:1.3vw">{{ $k->jumlah }}</p>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-primary increment" data-id="{{ $k->id }}">+</button>
                                    </div>
                                </div>
                                <div class="box row">
                                    <p class="card-text col cart-price rupiah" data-id="{{ $k->id }}"
                                        style="font-size:1.3vw">{{ $k->harga }}
                                    </p>
                                    <form action="{{ route('pelanggan.keranjang.hapus', ['id' => $k->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button class="btn btn-danger col">Hapus</button>
                                    </form>
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

@section('footer')
    <!-- Footer -->
    <footer class="sticky-footer bg-white shadow-lg p-4 m-2 bg-body rounded"
        style="position: fixed; width: 100%; bottom: 0;">
        <div class="container my-auto">
            <div class="row">
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll">
                            Pilih Semua
                        </label>
                    </div>
                </div>
                <div class="col-4">

                    <p class="text-right h5">
                        <span>Total: </span>
                        <span id="total" class="rupiah">0</span>
                    </p>
                </div>
                <div class="col-2">
                    <form action="{{ route('pelanggan.keranjang.checkout') }}" method="POST">
                        @csrf
                        <div id="ids"></div>
                        <button id="button-bayar" class="btn btn-block btn-primary float-right" disabled>Checkout</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </footer>
    <!-- End of Footer -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Select all checkbox
            $('#selectAll').change(function() {
                var isChecked = $(this).is(':checked');
                $('.form-check-input').prop('checked', isChecked);
                calculateTotal();
                toggleBayarButton();
                selectedIds = [];
                if (isChecked) {
                    $('.form-check-input:checked:not(#selectAll)').each(function() {
                        var dataId = $(this).closest('.card-body').find('.counter').data('id');
                        selectedIds.push(dataId);
                    });
                }
                $('#ids').empty();
                selectedIds.filter(v => v)
                selectedIds.forEach(function(id) {
                    if (id) $('#ids').append(
                        `<input type="hidden" name="selectedIds[]" value="${id}">`);
                });
            });

            // Checkbox change event
            var selectedIds = []
            $('.form-check-input').change(function() {
                var allChecked = $('.form-check-input:checked:not(#selectAll)').length === $(
                    '.form-check-input:not(#selectAll)').length;
                $('#selectAll').prop('checked', allChecked);
                calculateTotal();
                toggleBayarButton();

                var dataId = $(this).closest('.card-body').find('.counter').data('id');
                if ($(this).is(':checked')) {
                    selectedIds.push(dataId);
                } else {
                    var index = selectedIds.indexOf(dataId);
                    if (index > -1) {
                        selectedIds.splice(index, 1);
                    }
                }

                $('#ids').empty();
                selectedIds.forEach(function(id) {
                    if (id) $('#ids').append(
                        `<input type="hidden" name="selectedIds[]" value="${id}">`);
                });
            });

            // Increment button click event
            $('.increment').click(function() {
                var dataId = $(this).data('id');
                var dataStock = $(`.counter[data-id="${dataId}"]`).data('stock');
                var dataPrice = $(`.counter[data-id="${dataId}"]`).data('price');
                var counter = $(`.counter[data-id="${dataId}"]`);
                var cartPrice = $(`.cart-price[data-id="${dataId}"]`);
                var currentValue = parseInt(counter.text());
                if (currentValue < dataStock) {
                    var newValue = currentValue + 1;
                    counter.text(newValue);
                    cartPrice.text(rupiah(newValue * dataPrice));
                    calculateTotal();
                    toggleBayarButton();
                    updateJumlahMenu(dataId, newValue);
                }
            });

            // Decrement button click event
            $('.decrement').click(function() {
                var dataId = $(this).data('id');
                var dataStock = $(`.counter[data-id="${dataId}"]`).data('stock');
                var dataPrice = $(`.counter[data-id="${dataId}"]`).data('price');
                var counter = $(`.counter[data-id="${dataId}"]`);
                var cartPrice = $(`.cart-price[data-id="${dataId}"]`);
                var currentValue = parseInt(counter.text());
                if (currentValue > 1) {
                    var newValue = currentValue - 1
                    counter.text(newValue);
                    cartPrice.text(rupiah(newValue * dataPrice));
                    calculateTotal();
                    toggleBayarButton();
                    updateJumlahMenu(dataId, newValue);
                }
            });

            // Calculate total function
            function calculateTotal() {
                var total = 0;
                $('.form-check-input:checked:not(#selectAll)').each(function() {
                    var dataId = $(this).closest('.card-body').find('.counter').data('id');
                    var dataPrice = $(this).closest('.card-body').find('.counter').data('price');
                    var counterValue = parseInt($(this).closest('.card-body').find('.counter').text());
                    total += counterValue * dataPrice;

                });
                $('#total').text(rupiah(total));
            }

            // Toggle Bayar button function
            function toggleBayarButton() {
                var total = parseInt($('#total').text().replace(/[^0-9.-]+/g, ""));
                if (total === 0) {
                    $('#button-bayar').prop('disabled', true);
                } else {
                    $('#button-bayar').prop('disabled', false);
                }
            }

            // AJAX post request to update keranjang
            function updateJumlahMenu(id, jumlah) {
                var url = "{{ route('pelanggan.keranjang.ubah', ['id' => '_id']) }}"
                url = url.replace('_id', id);
                $.ajax({
                    url,
                    method: "POST",
                    data: {
                        id,
                        jumlah,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endsection
