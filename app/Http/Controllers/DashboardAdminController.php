<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_motor;
use App\Models\tb_transaksi;
use App\Models\tb_customer;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // 1. Kumpulkan Statistik Utama
        $totalMotor = tb_motor::count();
        $motorTersedia = tb_motor::where('status', 'tersedia')->count();
        $motorDisewa = tb_motor::where('status', 'disewa')->count();
        
        $totalPelanggan = tb_customer::count();
        
        // Hitung total pendapatan dari transaksi yang sudah sukses/berjalan
        $totalPendapatan = tb_transaksi::whereIn('status_transaksi', ['berjalan', 'selesai'])->sum('total_bayar');

        // 2. Ambil 5 Transaksi Terakhir untuk tabel aktivitas
        // Asumsi relasi 'customer' dan 'motor' sudah ada di model tb_transaksi
        $transaksiTerbaru = tb_transaksi::orderBy('created_at', 'desc')
                                        ->take(5)
                                        ->get();

        return view('dashboard', compact(
            'totalMotor', 
            'motorTersedia', 
            'motorDisewa', 
            'totalPelanggan', 
            'totalPendapatan',
            'transaksiTerbaru'
        ));
    }
}