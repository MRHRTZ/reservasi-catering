@extends('pelanggan.master')

@section('content')
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->menu }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>
                            @if ($p->status == 'PENDING')
                                <span class="badge badge-secondary">Belum Bayar</span>
                            @elseif ($p->status == 'PROCESS')
                                <span class="badge badge-primary">Diproses</span>
                            @elseif ($p->status == 'SHIPPING')
                                <span class="badge badge-warning">Dikirimkan</span>
                            @elseif ($p->status == 'DONE')
                                <span class="badge badge-success">Selesai</span>
                            @elseif ($p->status == 'REJECTED')
                                <span class="badge badge-danger">Ditolak</span>
                            @elseif ($p->status == 'ACCEPTED')
                                <span class="badge badge-info">Pesanan Dibuat</span>
                            @else
                                <span>{{ $p->status }}</span>
                            @endif
                        </td>
                        <td class="rupiah">{{ $p->total_harga }}</td>
                        <td>
                            @if ($p->status == 'PENDING')
                                <a href="{{ route('pelanggan.checkout', ['id_pesanan' => $p->id]) }}"
                                    class="btn btn-success">Bayar</a>
                                <a href="{{ route('pelanggan.pesanan.detail', ['id_pesanan' => $p->id]) }}"
                                    class="btn btn-secondary">Detail</a>
                            @elseif ($p->status == 'SHIPPING')
                                <a id="accept" data-id="{{ $p->id }}" href="#accept" class="btn btn-info">Diterima</a>
                            @else
                                <a href="{{ route('pelanggan.pesanan.detail', ['id_pesanan' => $p->id]) }}"
                                    class="btn btn-secondary">Detail</a>
                            @endif
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('pelanggan.pesanan.nilai') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pesanan">
                    <div class="modal-header">
                        <h5 class="modal-title">Silahkan beri rating</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section class="reviews-section">
                            <div class="your-review">
                                <input type="radio" name="rating-5" id="rating-5">
                                <label for="rating-5"></label>
                                <input type="radio" name="rating-4" id="rating-4">
                                <label for="rating-4"></label>
                                <input type="radio" name="rating-3" id="rating-3">
                                <label for="rating-3"></label>
                                <input type="radio" name="rating-2" id="rating-2">
                                <label for="rating-2"></label>
                                <input type="radio" name="rating-1" id="rating-1">
                                <label for="rating-1"></label>
                            </div>
                        </section>
                        <textarea class="form-control" name="catatan" placeholder="Masukan catatan penilaian..." ></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success mt-2">Nilai</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var table = new DataTable(".table");

        $('#accept').click(function() {
            $('#ratingModal').find('input[name="id_pesanan"]').val($(this).data('id'));
            $('#ratingModal').modal('show');
        });
    </script>
@endsection
