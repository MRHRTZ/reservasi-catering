<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\PesananBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /*
        USER
    */
    public function view_keranjang()
    {
        $keranjang = Keranjang::select([
            'keranjang.id',
            'keranjang.jumlah',
            'keranjang.harga',
            'menu.nama',
            'menu.deskripsi',
            'menu.gambar',
            'menu.stok',
            'menu.harga as harga_menu',
        ])
            ->leftJoin('menu', 'menu.id', '=', 'keranjang.id_menu')
            ->where('keranjang.id_pelanggan', Auth::user()->id)
            ->where('keranjang.checkout', false)
            ->orderByRaw('IF(keranjang.updated_at IS NULL, keranjang.created_at, keranjang.updated_at) DESC')
            ->get();
        $data = [
            'keranjang' => $keranjang,
        ];
        return view('pelanggan.keranjang', $data);
    }

    public function proses_tambah_keranjang(Request $request)
    {
        $user = Auth::user();
        $id_menu = $request->route('id_menu');

        $harga = Menu::find($id_menu)->harga;
        $keranjang = Keranjang::where('id_menu', $id_menu)
            ->where('checkout', false)
            ->where('id_pelanggan', $user->id)
            ->first();

        if ($keranjang) {
            $keranjang->jumlah += 1;
            $keranjang->harga = $harga * $keranjang->jumlah;
            $keranjang->save();
            return redirect()->route('pelanggan.keranjang');
        } else {
            Keranjang::create([
                'id_menu' => $id_menu,
                'id_pelanggan' => $user->id,
                'jumlah' => 1,
                'harga' => $harga,
            ]);
            return redirect()->route('pelanggan.keranjang');
        }
    }

    public function proses_ubah_keranjang(Request $request)
    {
        $id = $request->route('id');
        $jumlah = $request->input('jumlah');
        $keranjang = Keranjang::find($id);
        $keranjang->jumlah = $jumlah;
        $keranjang->harga = $keranjang->jumlah * $keranjang->menu->harga;
        $keranjang->save();
    }

    public function proses_hapus_keranjang(Request $request)
    {
        $id = $request->route('id');
        Keranjang::where('id', $id)->delete();
        return redirect()->route('pelanggan.keranjang');
    }

    public function proses_checkout(Request $request)
    {
        $ids = $request->input('selectedIds');
        $keranjang = Keranjang::whereIn('id', $ids)->get();

        $pesananBatchIds = [];
        foreach ($keranjang as $item) {
            $menu = Menu::find($item->id_menu);
            $menu->stok -= $item->jumlah;
            $menu->save();
            $item->checkout = true;
            $item->save();

            $pesananBatch = PesananBatch::create([
                'id_keranjang' => $item->id
            ]);

            $pesananBatchIds[] = $pesananBatch->id;
        }

        $pesanan = Pesanan::create([
            'id_pelanggan' => Auth::user()->id,
            'total_harga' => array_sum(array_column($keranjang->toArray(), 'harga')),
            'status' => 'PENDING',
        ]);

        PesananBatch::whereIn('id', $pesananBatchIds)->update(['id_pesanan' => $pesanan->id]);

        return redirect()->route('pelanggan.checkout', ['id_pesanan' => $pesanan->id]);
    }
}
