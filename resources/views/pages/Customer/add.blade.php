@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header">Tambah Data Customer</div>
        <div class="card-body">
            <form action="/customer" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Kolom Kiri: Nama, No Telepon, Foto KTP --}}
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Customer</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                            @error('nama')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telepon</label>
                            <input type="number" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
                            @error('no_telp')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto_ktp" class="form-label">Foto KTP</label>
                            <input type="file" name="foto_ktp" class="form-control">
                            @error('foto_ktp')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan: Alamat --}}
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Customer</label>
                            <textarea class="form-control" name="alamat" id="alamat"
                                style="height: 210px; resize: none;" placeholder="Masukkan alamat customer">{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection