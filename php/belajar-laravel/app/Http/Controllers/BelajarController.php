<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// kl di javascript pakai import

class BelajarController extends Controller
{
    public function index() 
    {
        $title = "Belajar Laravel Asik";
    return view('belajar', compact('title'));
    }

public function tambah()
{
    $title = "Tambah-tambahan";
    return view('tambah', compact('title'));
}
public function actionTambah(Request $request)
{
    $title = "Tambah-tambahan";
    $angka1 = $request->angka1;
    $angka2 = $request->input('angka2');
    $hasil = $angka1 + $angka2;
    // return $jumlah;
    return view('tambah', compact('hasil', 'title', 'angka1', 'angka2'));

}


public function kurang()
{
    $title = "Pengurangan";
    return view('kurang', compact('title'));
}
public function actionKurang(Request $request)
{
    $title = "Pengurangan";
    $angka1 = $request->angka1;
    $angka2 = $request->input('angka2');
    $hasil = $angka1 - $angka2;
    // return $jumlah;
    return view('kurang', compact('hasil', 'title', 'angka1', 'angka2'));

}


public function kali()
{
    $title = "Perkalian";
    return view('kali', compact('title'));
}
public function actionKali(Request $request)
{
    $title = "Perkalian";
    $angka1 = $request->angka1;
    $angka2 = $request->input('angka2');
    $hasil = $angka1 * $angka2;
    // return $jumlah;
    return view('kali', compact('hasil', 'title', 'angka1', 'angka2'));
}

public function bagi()
{
    $title = "Pembagian";
    return view('bagi', compact('title'));
}
public function actionBagi(Request $request)
{
    $title = "Pembagian";
    $angka1 = $request->angka1;
    $angka2 = $request->input('angka2');
    $hasil = $angka1 / $angka2;
    // return $jumlah;
    return view('bagi', compact('hasil', 'title', 'angka1', 'angka2'));
}

}
