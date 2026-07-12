<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_transaksi;
use App\Models\tb_customer; // Sesuaikan dengan nama model Customer Anda
use App\Models\tb_motor;
use Carbon\Carbon; // Library untuk manipulasi waktu dan tanggal

class transaksiController extends Controller
{
    public function index()
    {
        // Mengambil semua data transaksi beserta relasinya
        // Fungsi with() akan memanggil fungsi relasi yang ada di Model Transaksi
        $data_transaksi = tb_transaksi::with(['customer', 'motor'])->get();

        return view('pages.transaksi.show', compact('data_transaksi'));
    }

    public function create()
    {
        // Ambil semua data customer
        $data_customer = tb_customer::all();

        // PENTING: Hanya ambil motor yang statusnya 'tersedia'
        $data_motor = tb_motor::where('status', 'tersedia')->get();

        return view('pages.transaksi.add', compact('data_customer', 'data_motor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'motor_id' => 'required',
            'tipe_durasi' => 'required|in:hari,bulan',
            'durasi' => 'required|numeric|min:1',
            'tgl_mulai' => 'required|date',
        ]);

        $motor = tb_motor::findOrFail($request->motor_id);

        $harga_harian = $motor->harga;
        $total_bayar = 0;
        $harga_sewa_tercatat = 0;

        if ($request->tipe_durasi == 'hari') {
            $harga_sewa_tercatat = $harga_harian;
            $total_bayar = $harga_harian * $request->durasi;
            $tgl_selesai = Carbon::parse($request->tgl_mulai)->addDays((int) $request->durasi);
            $durasi_simpan = $request->durasi;
        } else {
            // Promo 1 bulan setara 15 hari
            $total_sementara = ($harga_harian * 15) * $request->durasi;

            // Diskon kelipatan
            $diskon = 0;
            if ($request->durasi >= 18) {
                $diskon = 0.20;
            } elseif ($request->durasi >= 12) {
                $diskon = 0.15;
            } elseif ($request->durasi >= 6) {
                $diskon = 0.10;
            }

            $total_bayar = $total_sementara - ($total_sementara * $diskon);
            $harga_sewa_tercatat = $total_bayar / $request->durasi;

            $tgl_selesai = Carbon::parse($request->tgl_mulai)->addMonths((int) $request->durasi);
            $durasi_simpan = $request->durasi * 30; // Konversi ke hari
        }

        tb_transaksi::create([
            'customer_id' => $request->customer_id,
            'motor_id' => $request->motor_id,
            'harga_sewa' => $harga_sewa_tercatat,
            'durasi' => $durasi_simpan,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $tgl_selesai->format('Y-m-d'),
            'total_bayar' => $total_bayar,
            'status_transaksi' => 'berjalan',
        ]);

        $motor->update(['status' => 'disewa']);
        return redirect('/transaksi')->with('pesan', 'Transaksi berhasil disimpan!');
    }
    public function show(string $id)
    {
        // Biasanya transaksi tidak menggunakan show jika sudah lengkap di index
    }

    public function edit(string $id)
    {
        // Karena ini transaksi riwayat keuangan, biasanya sangat jarang di-edit
        // Namun jika diperlukan, pastikan logikanya berhati-hati dengan status motor
    }

    public function update(Request $request, string $id)
    {
        // Logika update (Opsional)
    }

    public function destroy(string $id)
    {
        $transaksi = tb_transaksi::findOrFail($id);

        // 1. Cari motor yang ada di dalam transaksi ini
        $motor = tb_motor::findOrFail($transaksi->motor_id);

        // 2. Kembalikan status motor menjadi 'tersedia'
        $motor->update(['status' => 'tersedia']);

        // 3. Hapus data transaksi
        $transaksi->delete();

        return redirect('/transaksi')->with('pesan', 'Transaksi berhasil dihapus dan Motor kembali tersedia');
    }

    public function invoice(string $id)
    {
        $transaksi = tb_transaksi::with(['customer', 'motor'])->findOrFail($id);
        return view('pages.transaksi.invoice', compact('transaksi'));
    }

    public function selesai(string $id)
    {
        $transaksi = tb_transaksi::findOrFail($id);
        $transaksi->update(['status_transaksi' => 'selesai']);

        $motor = tb_motor::findOrFail($transaksi->motor_id);
        $motor->update(['status' => 'tersedia']);

        return redirect()->back()->with('pesan', 'Transaksi Selesai. Motor kembali tersedia.');
    }
}