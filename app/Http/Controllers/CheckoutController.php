<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\MetodePembayaran;
use App\Models\Pesanan;
use App\Models\PesananBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /*
        USER
    */
    public function view_checkout(Request $request)
    {
        $id_pesanan = $request->route('id_pesanan');
        $pesanan = Pesanan::find($id_pesanan);
        $menus = PesananBatch::where('id_pesanan', $id_pesanan)
            ->leftJoin('keranjang', 'keranjang.id', '=', 'pesanan_batch.id_keranjang')
            ->leftJoin('menu', 'menu.id', '=', 'keranjang.id_menu')
            ->get(
                [
                    'menu.nama',
                    'menu.gambar',
                    'keranjang.jumlah',
                    'keranjang.harga'
                ]
            );
        $payment = MetodePembayaran::get();
        $totalHarga =  array_sum(array_column($menus->toArray(), 'harga'));
        $data = [
            'pesanan' => $pesanan,
            'menus' => $menus,
            'pembayaran' => $payment,
            'total_harga' => $totalHarga,
        ];
        return view('pelanggan.checkout', $data);
    }

    public function proses_bayar(Request $request)
    {
        $id_pesanan = $request->route('id_pesanan');
        $tanggal = $request->input('date');
        $pengambilan = $request->input('delivery');
        $alamat = $request->input('address');
        $kode_pembayaran = $request->input('payment');
        $catatan = $request->input('notes');
        
        $file = $request->file('file');
        $target_upload = 'bukti_pembayaran';
        $filename = Str::uuid() . "." . $file->getClientOriginalExtension();
        $file->move($target_upload, $filename);

        $data = [
            'tanggal' => $tanggal,
            'pengambilan' => $pengambilan,
            'alamat' => $alamat,
            'kode_pembayaran' => $kode_pembayaran,
            'bukti_pembayaran' => $filename,
            'catatan_pembeli' => $catatan,
            'status' => 'PROCESS',
        ];

        Pesanan::where('id', $id_pesanan)->update($data);
        return redirect()->route('pelanggan.pesanan');
    }
}
