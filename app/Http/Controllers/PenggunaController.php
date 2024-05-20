<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /*
        ADMIN
    */
    public function list_pengguna()
    {
        $pengguna = User::get();
        $data = [
            'pengguna' => $pengguna,
        ];
        return view('admin.pengguna', $data);
    }

    public function buat_pengguna_view() {
        $data = [
            'page' => 'create',
        ];
        return view('admin.pengguna_form', $data);
    }
    
    public function buat_pengguna_proses(Request $request) {
        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
            'alamat' => $request->input('alamat')
        ];
        User::create($data);
        return redirect()->route('admin.pengguna');
    }

    public function edit_pengguna_view(Request $request) {
        $id = $request->route('id');
        $pengguna = User::where('id', $id)->first();
        $data = [
            'page' => 'edit',
            'pengguna' => $pengguna
        ];
        return view('admin.pengguna_form', $data);
    }
    
    public function edit_pengguna_proses(Request $request) {
        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'role' => $request->input('role'),
            'alamat' => $request->input('alamat')
        ];
        if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
        $id = $request->route('id');
        User::where('id', $id)->update($data);
        return redirect()->route('admin.pengguna');
    }

    public function hapus_pengguna(Request $request) {
        $id = $request->route('id');
        User::where('id', $id)->delete();
        return redirect()->route('admin.pengguna');
    }

    /*
        USER
    */
}
