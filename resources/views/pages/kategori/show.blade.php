@extends('layout.master')

@section('content')
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h2 class="card-title">Daftar Kategori</h2>
            <a href="/kategori/create" class="btn btn-success">Tambah Kategori</a>
        </div>
    </div>
<div class="card"> 
    <table class="table table-striped-columns">
  <thead>
    <tr>
      <th scope="col">ID Kategori</th>
      <th scope="col">Nama Kategori</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($data_kategori as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->nama_kategori }}</td>
      <td class="d-flex gap-2">
        <a href="{{ route('kategori.edit', $item->id_kategori) }}" class="btn btn-warning">Edit</a>
        <form action="/kategori/{{ $item->id_kategori }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')">Hapus</button>
        </form>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="5" class="text-center">Tidak ada data</td>
    </tr>
    @endforelse
  </tbody>
</table>
</div>
@endsection