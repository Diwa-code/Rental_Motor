@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header">Tambah Data Kategori</div>
        <div class="card-body">
            <form action="/kategori" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}">
                            @error('nama_kategori')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                </div>

                <div style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection