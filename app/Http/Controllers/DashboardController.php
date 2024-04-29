<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $total_pengguna = User::count();
        $total_menu = Menu::count();
        $total_pesanan = Pesanan::count();
        $sebulan_lalu = now()->subMonth();
        $total_pendapatan = Pesanan::where('created_at', '>=', $sebulan_lalu)->sum('total_harga');
        $data = [
            'total_pengguna' => $total_pengguna,
            'total_menu' => $total_menu,
            'total_pesanan' => $total_pesanan,
            'total_pendapatan' => $total_pendapatan
        ];
        return view('admin.dashboard', $data);
    }
}
