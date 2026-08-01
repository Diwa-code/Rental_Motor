@extends('layout.master')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Ringkasan Sistem</h2>
            <p class="text-muted small mb-0">Pantau performa penyewaan motormu secara real-time.</p>
        </div>
    </div>

    <!-- 4 Kotak Statistik Utama -->
    <div class="row g-4 mb-4">
        <!-- Kotak 1: Pendapatan -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="p-3 rounded-3 me-3" style="background-color: #e6fffa; color: #0d9488;">
                        <svg class="bi" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-muted text-uppercase small mb-1 fw-semibold">Total Pendapatan</p>
                        <h4 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kotak 2: Total Motor -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="p-3 rounded-3 me-3" style="background-color: #e0f2fe; color: #0284c7;">
                        <svg class="bi" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-muted text-uppercase small mb-1 fw-semibold">Total Motor</p>
                        <h4 class="fw-bold mb-0 text-dark">{{ $totalMotor }} Unit</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kotak 3: Motor Tersedia -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="p-3 rounded-3 me-3" style="background-color: #dcfce7; color: #16a34a;">
                        <svg class="bi" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-muted text-uppercase small mb-1 fw-semibold">Siap Disewa</p>
                        <h4 class="fw-bold mb-0 text-success">{{ $motorTersedia }} Unit</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kotak 4: Total Pelanggan -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="p-3 rounded-3 me-3" style="background-color: #ffedd5; color: #ea580c;">
                        <svg class="bi" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-muted text-uppercase small mb-1 fw-semibold">Pelanggan</p>
                        <h4 class="fw-bold mb-0 text-dark">{{ $totalPelanggan }} Orang</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi Terbaru -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">5 Transaksi Terakhir</h5>
            <a href="/transaksi" class="text-decoration-none fw-bold small" style="color: #0d9488;">Lihat Semua &rarr;</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light border-0">
                    <tr>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase border-0">Order ID</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase border-0">Durasi Sewa</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase border-0">Total Biaya</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase border-0">Status</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($transaksiTerbaru as $trx)
                        <tr>
                            <td class="px-4 py-3">
                                <span class="fw-bold text-dark">TRX-{{ $trx->id_transaksi }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="fw-medium text-dark">{{ $trx->tgl_mulai }}</div>
                                <div class="text-muted small">s/d {{ $trx->tgl_selesai }}</div>
                            </td>
                            <td class="px-4 py-3 fw-bold text-dark">
                                Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3">
                                @if($trx->status_transaksi == 'berjalan')
                                    <span class="badge rounded-pill bg-primary-subtle text-primary fw-bold px-3 py-2">Berjalan</span>
                                @elseif($trx->status_transaksi == 'menunggu_pembayaran')
                                    <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis fw-bold px-3 py-2">Menunggu</span>
                                @elseif($trx->status_transaksi == 'selesai')
                                    <span class="badge rounded-pill bg-success-subtle text-success fw-bold px-3 py-2">Selesai</span>
                                @else
                                    <span class="badge rounded-pill bg-danger-subtle text-danger fw-bold px-3 py-2">Batal</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-muted fw-medium">Belum ada transaksi sama sekali.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection