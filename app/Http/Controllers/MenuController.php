<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

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

    /*
        USER
    */
}
