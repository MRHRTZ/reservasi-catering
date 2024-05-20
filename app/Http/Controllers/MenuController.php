<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /*
        ADMIN
    */
    public function list_menu()
    {
        $menu = Menu::get();
        $data = [
            'menu' => $menu,
        ];
        return view('admin.menu', $data);
    }

    public function buat_menu_view()
    {
        $data = [
            'page' => 'create',
        ];
        return view('admin.menu_form', $data);
    }

    public function buat_menu_proses(Request $request)
    {
        $data = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
        ];

        $file = $request->file('gambar');
        $target_upload = 'menu';
        $filename = Str::uuid() . "." . $file->getClientOriginalExtension();
        $file->move($target_upload, $filename);
        $data['gambar'] = $filename;

        Menu::create($data);
        return redirect()->route('admin.menu');
    }

    public function edit_menu_view(Request $request)
    {
        $id = $request->route('id');
        $menu = Menu::where('id', $id)->first();
        $data = [
            'page' => 'edit',
            'menu' => $menu
        ];
        return view('admin.menu_form', $data);
    }

    public function edit_menu_proses(Request $request)
    {
        $data = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
        ];

        $id = $request->route('id');
        $menu = Menu::find($id);
        $menu->nama = $request->input('nama');
        $menu->deskripsi = $request->input('deskripsi');
        $menu->harga = $request->input('harga');
        $menu->stok = $request->input('stok');

        $file = $request->file('gambar');
        if ($file) {
            $target_upload = 'menu';
            $filename = Str::uuid() . "." . $file->getClientOriginalExtension();
            $file->move($target_upload, $filename);

            if ($menu->gambar) {
                File::delete($target_upload . '/' . $menu->gambar);
            }

            $menu->gambar = $filename;
        }
        $menu->save();
        return redirect()->route('admin.menu');
    }

    public function hapus_menu(Request $request)
    {
        $id = $request->route('id');
        $menu = Menu::find($id);
        if ($menu->gambar) {
            File::delete('menu/' . $menu->gambar);
        }
        $menu->delete();
        return redirect()->route('admin.menu');
    }

    /*
        USER
    */
    public function view_menu()
    {
        $menu = Menu::get(['*', DB::raw('(SELECT AVG(rating) FROM rating WHERE rating.id_menu = menu.id) as rating')]);
        $menu->transform(function ($item) {
            $item->rating = number_format($item->rating, 1);
            return $item;
        });
        $data = [
            'menu' => $menu,
        ];
        return view('pelanggan.menu', $data);
    }
}
