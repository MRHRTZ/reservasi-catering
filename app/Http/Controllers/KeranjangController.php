<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    //
    public function view_keranjang()
    {
        $keranjang = Keranjang::get();
        $data = [
            'keranjang' => $keranjang,
        ];
        return view('pelanggan.keranjang', $data);
    }
}
