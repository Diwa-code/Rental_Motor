@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header">Tambah Data Customer</div>
        <div class="card-body">
            <form action="/customer/{{ $data->id_customer }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    {{-- Kolom Kiri: Nama, No Telepon, Foto KTP --}}
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Customer</label>
                            <input type="text" name="nama" class="form-control" value="{{ $data->nama }}">
                            @error('nama')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telepon</label>
                            <input type="number" name="no_telp" class="form-control" value="{{ $data->no_telp }}">
                            @error('no_telp')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12" style="margin-top: 15px;">
                    <div class="mb-3">
                        <label for="foto_ktp" class="form-label">Foto KTP</label>
                        @if($data->foto_ktp)
                            <div class="mb-2">
                                <img src="{{ asset('foto_ktp_customer/' . $data->foto_ktp) }}" alt="Gambar saat ini" class="img-thumbnail" style="max-height: 200px;">
                                <p class="form-text">Gambar saat ini. Pilih file baru di bawah untuk mengganti.</p>
                            </div>
                        @endif
                        <input type="file" name="foto_ktp" class="form-control" id="foto_ktp" accept="image/*">
                        @error('foto_ktp')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Format: jpeg, png, jpg, gif, webp. Maksimal 2MB.</div>
                    </div>
                </div>
                    </div>

                    {{-- Kolom Kanan: Alamat --}}
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Customer</label>
                            <textarea class="form-control" name="alamat" id="alamat" style="height: 210px; resize: none;"
                                placeholder="Masukkan alamat customer">{{ $data->alamat }}</textarea>
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