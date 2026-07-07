<?php

use App\Http\Controllers\customerController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\motorController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('beranda', [
        'nama' => 'Budi Santoso',
        'umur' => 20,
        'alamat' => 'Jakarta',
    ]);
});// cara untuk inisiasi data untuk dipanggil ke halaman 'page.beranda'

Route::resource('customer', customerController::class);
Route::resource('kategori', kategoriController::class);
Route::resource('motor', motorController::class);
