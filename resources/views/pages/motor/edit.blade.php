@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header">Edit Data Motor</div>
        <div class="card-body">
            <form action="/motor/{{ $data->id_motor }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                
                <div class="row">
                    {{-- Kolom Kiri: Kategori, Nama Motor, Tahun, Harga --}}
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori Motor</label>
                            <select class="form-select" name="kategori_id" id="kategori_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($data_kategori as $kategori)
                                    <option value="{{ $kategori->id_kategori }}" {{ old('kategori_id', $data->kategori_id) == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_motor" class="form-label">Nama Motor</label>
                            <input type="text" name="nama_motor" class="form-control" value="{{ old('nama_motor', $data->nama_motor) }}">
                            @error('nama_motor')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun Keluaran</label>
                            <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $data->tahun) }}">
                            @error('tahun')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Sewa (Rp)</label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga', $data->harga) }}">
                            @error('harga')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan: Status, Gambar, Deskripsi --}}
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Motor</label>
                            <select class="form-select" name="status" id="status">
                                <option value="tersedia" {{ old('status', $data->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="disewa" {{ old('status', $data->status) == 'disewa' ? 'selected' : '' }}>Disewa</option>
                                <option value="servis" {{ old('status', $data->status) == 'servis' ? 'selected' : '' }}>Servis / Maintenance</option>
                            </select>
                            @error('status')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar_motor" class="form-label">Gambar Motor</label>
                            @if($data->gambar_motor)
                                <div class="mb-2">
                                    <img src="{{ asset('gambar_motor/' . $data->gambar_motor) }}" alt="Gambar Motor" style="width: 100px; height: auto; border-radius: 5px;">
                                </div>
                            @endif
                            <input type="file" name="gambar_motor" class="form-control" id="gambar_motor" accept="image/*">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengganti gambar. Format: jpeg, png, jpg, webp. Maksimal 2MB.</div>
                            @error('gambar_motor')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi / Spesifikasi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi"
                                style="height: 100px; resize: none;">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="/motor" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection