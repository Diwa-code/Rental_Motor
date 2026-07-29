@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header">Tambah Data Motor</div>
        <div class="card-body">
            <form action="/motor" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Kolom Kiri: Nama Motor, Tahun, Harga, CC Mesin --}}
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="nama_motor" class="form-label">Nama Motor</label>
                            <input type="text" name="nama_motor" class="form-control" placeholder="Contoh: Honda Vario 160" value="{{ old('nama_motor') }}">
                            @error('nama_motor')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun Keluaran</label>
                            <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2024" value="{{ old('tahun') }}">
                            @error('tahun')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Sewa (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="Contoh: 150000" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cc_mesin" class="form-label">CC Mesin</label>
                            <input type="text" name="cc_mesin" class="form-control" placeholder="Contoh: 160cc" value="{{ old('cc_mesin') }}">
                            <div class="form-text">Kapasitas mesin motor, contoh: 150cc, 160cc, 250cc</div>
                            @error('cc_mesin')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan: Kategori Badge, Tag Tambahan, Status, Gambar, Deskripsi --}}
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori Badge</label>
                            <select class="form-select" name="kategori_id" id="kategori_id">
                                <option value="">-- Pilih Badge Kategori --</option>
                                @foreach($data_kategori as $kategori)
                                    <option value="{{ $kategori->id_kategori }}"
                                        {{ old('kategori_id') == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->kategori_badge }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Badge ini akan tampil di kartu motor. Kelola daftar badge di menu <a href="/kategori" target="_blank">Kategori</a>.</div>
                            @error('kategori_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tag_tambahan" class="form-label">Tag Tambahan</label>
                            <input type="text" name="tag_tambahan" class="form-control" placeholder="Contoh: Adventure" value="{{ old('tag_tambahan') }}">
                            <div class="form-text">Tag ekstra yang tampil sebagai chip di kartu motor, contoh: Adventure, Premium, Sport.</div>
                            @error('tag_tambahan')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status Motor</label>
                            <select class="form-select" name="status" id="status">
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="disewa" {{ old('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                                <option value="servis" {{ old('status') == 'servis' ? 'selected' : '' }}>Servis / Maintenance</option>
                            </select>
                            @error('status')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar_motor" class="form-label">Gambar Motor</label>
                            <input type="file" name="gambar_motor" class="form-control" id="gambar_motor" accept="image/*">
                            <div class="form-text">Format: jpeg, png, jpg, webp. Maksimal 2MB.</div>
                            @error('gambar_motor')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Deskripsi full width --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi / Spesifikasi</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi"
                        style="height: 100px; resize: none;" placeholder="Masukkan deskripsi atau spesifikasi motor...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-top: 15px;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/motor" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection