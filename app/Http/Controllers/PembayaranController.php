<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /*
        ADMIN
    */
    public function list_pembayaran()
    {
        $pembayaran = MetodePembayaran::get();
        $data = [
            'pembayaran' => $pembayaran,
        ];
        return view('admin.pembayaran', $data);
    }

    public function buat_pembayaran_view() {
        $data = [
            'page' => 'create',
        ];
        return view('admin.pembayaran_form', $data);
    }
    
    public function buat_pembayaran_proses(Request $request) {
        $data = [
            'kode_pembayaran' => $request->input('kode_pembayaran'),
            'nama' => $request->input('nama'),
            'nomor' => $request->input('nomor'),
            'metode' => $request->input('metode'),
        ];
        MetodePembayaran::create($data);
        return redirect()->route('admin.pembayaran');
    }

    public function edit_pembayaran_view(Request $request) {
        $id = $request->route('id');
        $pembayaran = MetodePembayaran::where('id', $id)->first();
        $data = [
            'page' => 'edit',
            'pembayaran' => $pembayaran
        ];
        return view('admin.pembayaran_form', $data);
    }
    
    public function edit_pembayaran_proses(Request $request) {
        $data = [
            'kode_pembayaran' => $request->input('kode_pembayaran'),
            'nama' => $request->input('nama'),
            'nomor' => $request->input('nomor'),
            'metode' => $request->input('metode'),
        ];
        $id = $request->route('id');
        MetodePembayaran::where('id', $id)->update($data);
        return redirect()->route('admin.pembayaran');
    }

    public function hapus_pembayaran(Request $request) {
        $id = $request->route('id');
        MetodePembayaran::where('id', $id)->delete();
        return redirect()->route('admin.pembayaran');
    }
}
