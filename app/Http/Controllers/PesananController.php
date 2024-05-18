<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;

class PesananController extends Controller
{
    /*
        ADMIN
    */
    public function list_pesanan()
    {
        $pesanan = Pesanan::get();
        $data = [
            'pesanan' => $pesanan,
        ];
        return view('admin.pesanan', $data);
    }

    /*
        USER
    */
    public function view_pesanan()
    {
        $pesanan = Pesanan::get();
        $data = [
            'pesanan' => $pesanan,
        ];
        return view('pelanggan.pesanan', $data);
    }
}
