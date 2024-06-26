<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use App\Models\Pesanan;
use App\Models\PesananBatch;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /*
        ADMIN
    */
    public function list_pesanan()
    {
        $pesanan = Pesanan::leftJoin('pesanan_batch', 'pesanan_batch.id_pesanan', '=', 'pesanan.id')
            ->leftJoin('keranjang', 'keranjang.id', '=', 'pesanan_batch.id_keranjang')
            ->leftJoin('menu', 'menu.id', '=', 'keranjang.id_menu')
            ->leftJoin('users', 'users.id', '=', 'pesanan.id_pelanggan')
            ->groupBy('pesanan.id')
            ->get([
                'pesanan.id',
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
        return view('admin.pesanan', $data);
    }

    public function view_detail_pesanan_admin(Request $request)
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
        return view('admin.pesanan_detail', $data);
    }

    public function view_proses_pesanan(Request $request)
    {
        $id_pesanan = $request->route('id_pesanan');
        $pesanan = Pesanan::find($id_pesanan);
        $menus = PesananBatch::where('id_pesanan', $id_pesanan)
            ->leftJoin('keranjang', 'keranjang.id', '=', 'pesanan_batch.id_keranjang')
            ->leftJoin('menu', 'menu.id', '=', 'keranjang.id_menu')
            ->leftJoin('pesanan', 'pesanan.id', '=', 'pesanan_batch.id_pesanan')
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
        return view('admin.pesanan_proses', $data);
    }

    public function proses_terima_pesanan(Request $request)
    {
        $id_pesanan = $request->query('id_pesanan');
        $pesanan = Pesanan::find($id_pesanan);
        $pesanan->status = 'ACCEPTED';
        $pesanan->save();
        return redirect()->route('admin.pesanan');
    }

    public function proses_tolak_pesanan(Request $request)
    {
        $id_pesanan = $request->route('id_pesanan');
        $pesanan = Pesanan::find($id_pesanan);
        $pesanan->status = 'REJECTED';
        $pesanan->catatan_penjual = $request->input('alasan');
        $pesanan->save();
        return redirect()->route('admin.pesanan');
    }

    public function proses_kirim_pesanan(Request $request)
    {
        $id_pesanan = $request->query('id_pesanan');
        $pesanan = Pesanan::find($id_pesanan);
        $pesanan->status = 'SHIPPING';
        $pesanan->save();
        return redirect()->route('admin.pesanan');
    }

    /*
        USER
    */
    public function view_pesanan()
    {
        $user = Auth::user();
        $pesanan = Pesanan::where('pesanan.id_pelanggan', $user->id)
            ->leftJoin('pesanan_batch', 'pesanan_batch.id_pesanan', '=', 'pesanan.id')
            ->leftJoin('keranjang', 'keranjang.id', '=', 'pesanan_batch.id_keranjang')
            ->leftJoin('menu', 'menu.id', '=', 'keranjang.id_menu')
            ->groupBy('pesanan.id')
            ->get([
                'pesanan.id',
                'pesanan.status',
                'keranjang.jumlah',
                'pesanan.total_harga',
                DB::raw('GROUP_CONCAT(menu.nama SEPARATOR ", ") as menu'),
            ]);
        $data = [
            'pesanan' => $pesanan,
        ];
        return view('pelanggan.pesanan', $data);
    }

    public function view_detail_pesanan(Request $request)
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
        return view('pelanggan.pesanan_detail', $data);
    }

    public function proses_nilai_pesanan(Request $request)
    {
        $id_pesanan = $request->input('id_pesanan');
        $pesanan = Pesanan::find($id_pesanan);
        $pesanan->status = 'DONE';
        $pesanan->save();

        $rating = null;
        if ($request->input('rating-5') == 'on') {
            $rating = 5;
        } elseif ($request->input('rating-4') == 'on') {
            $rating = 4;
        } elseif ($request->input('rating-3') == 'on') {
            $rating = 3;
        } elseif ($request->input('rating-2') == 'on') {
            $rating = 2;
        } elseif ($request->input('rating-1') == 'on') {
            $rating = 1;
        }

        if ($rating) {
            $pesanan_batch = PesananBatch::where('id_pesanan', $id_pesanan)->get();
            foreach ($pesanan_batch as $item) {
                Rating::create([
                    'id_menu' => $item->keranjang->id_menu,
                    'id_pelanggan' => $pesanan->id_pelanggan,
                    'rating' => $rating,
                    'catatan' => $request->input('catatan'),
                ]);
            }
        }

        return redirect()->route('pelanggan.pesanan');
    }
}
