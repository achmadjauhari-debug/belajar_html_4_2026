<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard.index')
            ->with('success', 'Selamat datang kembali di Dashboard Admin');
        }

        return back()->withErrors(['email' => 'Email atau Password salah.'])
        ->onlyInput('email');
    }

// PERBAIKAN: Masukkan parameter Request $request
public function logout(\Illuminate\Http\Request $request)
{
    // Hapus atau abaikan baris dd yang dikomentari agar kode bersih
    Auth::logout();

    // Sekarang variabel $request di bawah ini sudah dikenali oleh PHP
    $request->session()->invalidate();
    $request->session()->regenerateToken(); // Tambahan opsional: Amankan token CSRF baru setelah logout
    
    return redirect('admin/login');
}

}
