<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function cek_login()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($user->role == 'pelanggan') {
                return redirect()->route('pelanggan.dashboard');
            }
        } else {
            return view('otentikasi.login');
        }
    }

    public function login_view()
    {
        return view('otentikasi.login');
    }
    
    public function register_view()
    {
        return view('otentikasi.register');
    }

    public function login_process(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        $data = [
            'email' => $email,
            'password' => $password
        ];

        if (Auth::attempt($data, $remember)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($user->role === 'pelanggan') {
                return redirect()->route('pelanggan.dashboard');
            }
        } else {
            return redirect()->route('login')->withErrors(['msg' => 'Email atau Password Salah']);
        }
    }

    public function register_process(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'alamat' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        $request->session()->flash('success', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan email dan password.');
        return redirect()->route('login');
    }

    public function logout_process(Request $request)
    {
        Auth::logout();
        $request->session()->flash('success', 'Berhasil keluar akun.');
        return redirect()->route('login');
    }
}
