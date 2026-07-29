@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header">Edit Badge Kategori</div>
        <div class="card-body">
            <form action="/kategori/{{ $data->id_kategori }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="kategori_badge" class="form-label">Nama Badge</label>
                    <input type="text" name="kategori_badge" id="kategori_badge" class="form-control"
                        value="{{ old('kategori_badge', $data->kategori_badge) }}">
                    <div class="form-text">Badge ini akan muncul sebagai pilihan di form tambah/edit motor.</div>
                    @error('kategori_badge')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/kategori" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection