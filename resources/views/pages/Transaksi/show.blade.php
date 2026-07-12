@extends('layout.master')

@section('content')
  <div class="card mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
      <h2 class="card-title">Daftar Transaksi</h2>
      <a href="/transaksi/create" class="btn btn-success">Tambah Transaksi</a>
    </div>
  </div>
  
  @if (session('pesan'))
  <div class="alert alert-success">
    {{ session('pesan') }}
  </div>
  @endif
  
  <div class="card">
    <div class="table-responsive">
        <table class="table table-striped-columns">
          <thead>
            <tr class="text-center">
              <th scope="col" class="bg-primary text-white">No</th>
              <th scope="col" class="bg-primary text-white">Customer</th>
              <th scope="col" class="bg-primary text-white">Motor</th>
              <th scope="col" class="bg-primary text-white">Harga Sewa</th>
              <th scope="col" class="bg-primary text-white">Durasi (Hari)</th>
              <th scope="col" class="bg-primary text-white">Mulai</th>
              <th scope="col" class="bg-primary text-white">Selesai</th>
              <th scope="col" class="bg-primary text-white">Total Bayar</th>
              <!-- Tambahan Kolom Status -->
              <th scope="col" class="bg-primary text-white">Status</th>
              <th scope="col" class="bg-primary text-white">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data_transaksi as $item)
            <tr class="text-center align-middle">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->customer->nama ?? '-' }}</td>
              <td>{{ $item->motor->nama_motor ?? '-' }}</td>
              <td>Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
              <td>{{ $item->durasi }}</td>
              <td>{{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d/m/Y') }}</td>
              <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
              
              <!-- Menampilkan Badge Status Transaksi -->
              <td>
                @if($item->status_transaksi == 'berjalan')
                    <span class="badge bg-warning text-dark">Berjalan</span>
                @else
                    <span class="badge bg-success">Selesai</span>
                @endif
              </td>
              
              <td class="d-flex justify-content-center gap-2">
                <!-- Tombol Cetak Invoice -->
                <a href="{{ route('transaksi.invoice', $item->id_transaksi) }}" target="_blank" class="btn btn-info text-white btn-sm">Cetak</a>
                
                <!-- Tombol Selesaikan (Hanya Muncul Jika Status Berjalan) -->
                @if($item->status_transaksi == 'berjalan')
                    <form action="{{ route('transaksi.selesai', $item->id_transaksi) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Tandai transaksi selesai? Motor akan otomatis kembali berstatus Tersedia.')">Selesaikan</button>
                    </form>
                @endif
                
                <!-- Tombol Hapus -->
                <form action="/transaksi/{{ $item->id_transaksi }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data transaksi ini?')">Hapus</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <!-- Colspan menjadi 10 karena ada penambahan 1 kolom status -->
              <td colspan="10" class="text-center">Tidak ada data transaksi</td>
            </tr>
            @endforelse
          </tbody>
        </table>
    </div>
  </div>
@endsection