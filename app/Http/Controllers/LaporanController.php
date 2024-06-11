<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function list_laporan()
    {
        $pesanan = Pesanan::leftJoin('pesanan_batch', 'pesanan_batch.id_pesanan', '=', 'pesanan.id')
            ->leftJoin('keranjang', 'keranjang.id', '=', 'pesanan_batch.id_keranjang')
            ->leftJoin('menu', 'menu.id', '=', 'keranjang.id_menu')
            ->leftJoin('users', 'users.id', '=', 'pesanan.id_pelanggan')
            ->groupBy('pesanan.id')
            ->orderBy('pesanan.created_at', 'desc')
            ->get([
                'pesanan.id',
                DB::raw('pesanan.created_at as tanggal'),
                'users.nama',
                DB::raw('GROUP_CONCAT(menu.nama SEPARATOR ", ") as menu'),
                'keranjang.jumlah',
                'pesanan.pengambilan',
                'pesanan.kode_pembayaran',
                'pesanan.status',
                'pesanan.total_harga',
            ]);
        $data = [
            'pesanan' => $pesanan,
        ];
        return view('admin.laporan', $data);
    }
}
