@extends('layout.master')

@section('content')
  <div class="card mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
      <h2 class="card-title">Daftar motor</h2>
      <a href="/motor/create" class="btn btn-success">Tambah Motor</a>
    </div>
  </div>
  @if (session('pesan'))
  <div class="alert alert-success">
    {{ session('pesan') }}
  </div>
  @endif
  <div class="card">
    <table class="table table-striped-columns">
      <thead>
        <tr class="text-center">
          <th scope="col" class="bg-primary text-white">ID Motor</th>
          <th scope="col" class="bg-primary text-white">Nama Kategori</th>
          <th scope="col" class="bg-primary text-white">Nama Motor</th>
          <th scope="col" class="bg-primary text-white">Tahun Motor</th>
          <th scope="col" class="bg-primary text-white">Harga Sewa</th>
          <th scope="col" class="bg-primary text-white">Status</th>
          <th scope="col" class="bg-primary text-white">aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data_motor as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->nama_kategori }}</td>
          <td>{{ $item->nama_motor }}</td>
          <td>{{ $item->tahun }}</td>
          <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
          <td>{{ $item-> status}}</td>
          <td class="d-flex gap-2">
            <a href="{{ route('motor.edit', $item->id_motor) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('motor.show', $item->id_motor) }}" class="btn btn-primary">Detail</a>
            <form action="/motor/{{ $item->id_motor }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection