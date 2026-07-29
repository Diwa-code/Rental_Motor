@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header">Tambah Badge Kategori</div>
        <div class="card-body">
            <form action="/kategori" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="kategori_badge" class="form-label">Nama Badge</label>
                    <input type="text" name="kategori_badge" id="kategori_badge" class="form-control"
                        placeholder="Contoh: Automatic, Off-Road, Sport" value="{{ old('kategori_badge') }}">
                    <div class="form-text">Badge ini akan muncul sebagai pilihan di form tambah/edit motor.</div>
                    @error('kategori_badge')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/kategori" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection