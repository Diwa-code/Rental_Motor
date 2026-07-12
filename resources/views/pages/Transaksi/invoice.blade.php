<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Transaksi #{{ $transaksi->id_transaksi }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        .invoice-box { max-width: 800px; margin: 40px auto; padding: 30px; background: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        /* CSS ini akan menyembunyikan elemen saat dicetak (print) */
        @media print {
            .no-print { display: none !important; }
            body { background-color: #fff; }
            .invoice-box { box-shadow: none; margin: 0; padding: 0; }
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <!-- Header Invoice -->
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <h2 class="mb-0">Rental Motor Diwangga</h2>
            <p class="text-muted mb-0">Jl. Contoh Alamat No. 123, Bali</p>
        </div>
        <div class="text-end">
            <h1 class="text-primary mb-0">INVOICE</h1>
            <p class="mb-0"><strong>ID:</strong> #TRX-{{ str_pad($transaksi->id_transaksi, 4, '0', STR_PAD_LEFT) }}</p>
            <p class="mb-0"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d F Y') }}</p>
            <!-- Tambahan Stempel Status -->
            <div class="mt-2">
                @if($transaksi->status_transaksi == 'selesai')
                    <span class="badge bg-success" style="font-size: 1rem;">STATUS: SELESAI (LUNAS)</span>
                @else
                    <span class="badge bg-warning text-dark" style="font-size: 1rem;">STATUS: SEDANG DISEWA</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Data Customer & Waktu Sewa -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <h5 class="text-muted">Disewa Oleh:</h5>
            <strong>{{ $transaksi->customer->nama }}</strong><br>
            {{ $transaksi->customer->alamat }}<br>
            Telp: {{ $transaksi->customer->no_telp }}
        </div>
        <div class="col-sm-6 text-end">
            <h5 class="text-muted">Periode Sewa:</h5>
            Mulai: {{ \Carbon\Carbon::parse($transaksi->tgl_mulai)->format('d/m/Y') }}<br>
            Selesai: {{ \Carbon\Carbon::parse($transaksi->tgl_selesai)->format('d/m/Y') }}<br>
            <strong>Durasi: {{ $transaksi->durasi }} Hari</strong>
        </div>
    </div>

    <!-- Detail Motor & Harga -->
    <table class="table table-bordered mb-4">
        <thead class="table-light text-center">
            <tr>
                <th>Deskripsi Motor</th>
                <th>Harga Sewa (Tercatat)</th>
                <th>Durasi</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <tr>
                <td class="text-start">
                    <strong>{{ $transaksi->motor->nama_motor }}</strong><br>
                    <small class="text-muted">Tahun: {{ $transaksi->motor->tahun }}</small>
                </td>
                <td>Rp {{ number_format($transaksi->harga_sewa, 0, ',', '.') }}</td>
                <td>{{ $transaksi->durasi }} Hari</td>
                <!-- Hapus perkalian, panggil langsung total_bayar dari database -->
                <td>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">TOTAL BAYAR:</th>
                <th class="text-center bg-primary text-white">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <!-- Tombol Print -->
    <div class="text-center mt-5 no-print">
        <button onclick="window.print()" class="btn btn-primary btn-lg">🖨️ Cetak Invoice Sekarang</button>
        <button onclick="window.close()" class="btn btn-secondary btn-lg ms-2">Tutup</button>
    </div>
</div>

</body>
</html>