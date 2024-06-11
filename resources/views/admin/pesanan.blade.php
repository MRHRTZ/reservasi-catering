@extends('admin.master')

@section('content')
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Pengambilan</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->menu }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>{{ $p->pengambilan ?? '-' }}</td>
                        <td>{{ $p->kode_pembayaran ?? '-' }}</td>
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
                            @if ($p->status == 'PROCESS' || $p->status == 'ACCEPTED')
                                <a href="{{ route('admin.pesanan.proses', ['id_pesanan' => $p->id]) }}"
                                    class="btn btn-success">
                                    Proses
                                </a>
                            @else
                                <a href="{{ route('admin.pesanan.detail', ['id_pesanan' => $p->id]) }}"
                                    class="btn btn-secondary">Detail</a>
                            @endif
                        </td>
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
