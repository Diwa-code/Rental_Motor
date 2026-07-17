<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_transaksi;
use App\Models\tb_customer; // Sesuaikan dengan nama model Customer Anda
use App\Models\tb_motor;
use Carbon\Carbon; // Library untuk manipulasi waktu dan tanggal
use Illuminate\Support\Facades\Cache;

class transaksiController extends Controller
{
    /**
     * Mengambil semua data transaksi beserta relasinya.
     * with(['customer', 'motor']) = Eager Loading, hanya 3 query (transaksi + customer + motor).
     * Tanpa with(), setiap baris transaksi akan memanggil query terpisah (N+1 problem).
     */
    public function index()
    {
        $data_transaksi = tb_transaksi::with(['customer', 'motor'])->get();

        return view('pages.transaksi.show', compact('data_transaksi'));
    }

    /**
     * Data customer dan motor tersedia di-cache karena jarang berubah.
     */
    public function create()
    {
        // Cache data customer selama 5 menit (300 detik)
        $data_customer = Cache::remember('data_customer', 300, function () {
            return tb_customer::all();
        });

        // Cache data motor tersedia selama 2 menit (120 detik)
        // Durasi lebih pendek karena status motor bisa berubah setelah transaksi
        $data_motor = Cache::remember('data_motor_tersedia', 120, function () {
            return tb_motor::where('status', 'tersedia')->get();
        });

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

        // Hapus cache karena data motor tersedia sudah berubah
        Cache::forget('data_motor_tersedia');

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

    /**
     * Hapus transaksi dan kembalikan status motor.
     * Menggunakan relasi motor() dari model untuk menghindari query terpisah.
     */
    public function destroy(string $id)
    {
        // Eager load relasi motor agar hanya 1 query (bukan 2 terpisah)
        $transaksi = tb_transaksi::with('motor')->findOrFail($id);

        // Kembalikan status motor menjadi 'tersedia' via relasi
        if ($transaksi->motor) {
            $transaksi->motor->update(['status' => 'tersedia']);
        }

        // Hapus data transaksi
        $transaksi->delete();

        // Hapus cache karena status motor berubah
        Cache::forget('data_motor_tersedia');

        return redirect('/transaksi')->with('pesan', 'Transaksi berhasil dihapus dan Motor kembali tersedia');
    }

    /**
     * Cetak invoice transaksi.
     * Menggunakan Eager Loading untuk memuat data customer dan motor sekaligus.
     */
    public function invoice(string $id)
    {
        $transaksi = tb_transaksi::with(['customer', 'motor'])->findOrFail($id);
        return view('pages.transaksi.invoice', compact('transaksi'));
    }

    /**
     * Tandai transaksi sebagai selesai dan kembalikan motor.
     * Menggunakan relasi motor() untuk mengurangi query.
     */
    public function selesai(string $id)
    {
        // Eager load relasi motor agar hanya 1 query (bukan 2 terpisah)
        $transaksi = tb_transaksi::with('motor')->findOrFail($id);
        $transaksi->update(['status_transaksi' => 'selesai']);

        // Kembalikan status motor via relasi
        if ($transaksi->motor) {
            $transaksi->motor->update(['status' => 'tersedia']);
        }

        // Hapus cache karena status motor berubah
        Cache::forget('data_motor_tersedia');

        return redirect()->back()->with('pesan', 'Transaksi Selesai. Motor kembali tersedia.');
    }
}