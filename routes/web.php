<?php

use App\Http\Controllers\customerController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\motorController;
use App\Http\Controllers\transaksiController;
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
Route::resource('transaksi', transaksiController::class);
// Route untuk cetak invoice
Route::get('/transaksi/{id}/invoice', [App\Http\Controllers\transaksiController::class, 'invoice'])->name('transaksi.invoice');

// Route untuk mengubah status transaksi menjadi selesai
Route::patch('/transaksi/{id}/selesai', [App\Http\Controllers\transaksiController::class, 'selesai'])->name('transaksi.selesai');