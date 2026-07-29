@extends('layout.master')

@section('content')
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class="card-title mb-1">Daftar Badge Kategori</h2>
                <p class="text-muted mb-0 small">Badge ini digunakan sebagai label kategori motor (contoh: Automatic, Off-Road, Sport).</p>
            </div>
            <a href="/kategori/create" class="btn btn-success">Tambah Badge</a>
        </div>
    </div>

    <div class="card">
        <table class="table table-striped-columns mb-0">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Badge</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data_kategori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="badge"
                            style="background-color: #1a6e4a; font-size: 0.8rem; padding: 5px 12px; border-radius: 20px;">
                            {{ $item->kategori_badge }}
                        </span>
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('kategori.edit', $item->id_kategori) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/kategori/{{ $item->id_kategori }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus badge {{ $item->kategori_badge }}?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-3">Belum ada badge kategori. Tambahkan sekarang.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection