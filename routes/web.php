<?php

use App\Http\Controllers\customerController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\motorController;
use App\Http\Controllers\transaksiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardAdminController;


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

Route::get('/', [DashboardAdminController::class, 'index']);

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('http://127.0.0.1:8001');
});
