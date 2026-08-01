<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_transaksi;
use App\Models\tb_motor;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentCallbackController extends Controller
{
    public function callback(Request $request)
    {
        // 1. Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

        try {
            // 2. Tangkap laporan dari Midtrans
            $notification = new Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memproses notifikasi'], 400);
        }

        $status = $notification->transaction_status;
        $orderId = $notification->order_id; // Contoh: TRX-6

        // 3. Ekstrak ID Transaksi (buang kata 'TRX-')
        $idTransaksi = str_replace('TRX-', '', $orderId);

        // 4. Cari data transaksi di database
        $transaksi = tb_transaksi::where('id_transaksi', $idTransaksi)->first();
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        // Cari data motor yang disewa
        $motor = tb_motor::where('id_motor', $transaksi->motor_id)->first();

        // 5. UBAH STATUS OTOMATIS BERDASARKAN LAPORAN
        if ($status == 'settlement' || $status == 'capture') {
            // Jika pembayaran berhasil
            $transaksi->status_transaksi = 'berjalan';
            
        } elseif ($status == 'expire' || $status == 'cancel' || $status == 'deny') {
            // Jika pembayaran gagal / kadaluarsa
            $transaksi->status_transaksi = 'dibatalkan';
            
            // Otomatis kembalikan status motor agar bisa disewa orang lain
            if ($motor) {
                $motor->status = 'tersedia';
                $motor->save();
            }
        }
        
        $transaksi->save();

        // Beri tahu Midtrans bahwa laporan sudah diterima dengan baik
        return response()->json(['message' => 'Callback success']);
    }
}