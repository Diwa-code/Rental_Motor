@extends('layout.master')

@section('content')
  <div class="card mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
      <h2 class="card-title">Daftar Customer</h2>
      <a href="/customer/create" class="btn btn-success">Tambah Customer</a>
    </div>
  </div>
  <div class="card">
    <table class="table table-striped-columns">
      <thead>
        <tr class="text-center">
          <th scope="col" class="bg-primary text-white">ID Customer</th>
          <th scope="col" class="bg-primary text-white">Nama</th>
          <th scope="col" class="bg-primary text-white">Alamat</th>
          <th scope="col" class="bg-primary text-white">No Telepon</th>
          <th scope="col" class="bg-primary text-white">Foto KTP</th>
          <th scope="col" class="bg-primary text-white">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data_customer as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->nama }}</td>
          <td>{{ $item->alamat }}</td>
          <td>{{ $item->no_telp }}</td>
          <td>
            @if($item->foto_ktp)
              <img src="{{ asset('foto_ktp_customer/' . $item->foto_ktp) }}" alt="Foto KTP" style="width: 80px; height: auto; border-radius: 4px; cursor: pointer;" onclick="window.open(this.src)">
            @else
              -
            @endif
          </td>
          <td class="d-flex gap-2">
            <a href="{{ route('customer.edit', $item->id_customer) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('customer.destroy', $item->id_customer) }}" class="btn btn-danger">Hapus</a>
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