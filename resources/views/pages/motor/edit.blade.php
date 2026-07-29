@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header">Edit Data Motor</div>
        <div class="card-body">
            <form action="/motor/{{ $data->id_motor }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Kolom Kiri: Nama Motor, Tahun, Harga, CC Mesin --}}
                    <div class="col-sm-6">
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

                        <div class="mb-3">
                            <label for="cc_mesin" class="form-label">CC Mesin</label>
                            <input type="text" name="cc_mesin" class="form-control" placeholder="Contoh: 160cc" value="{{ old('cc_mesin', $data->cc_mesin) }}">
                            <div class="form-text">Kapasitas mesin motor, contoh: 150cc, 160cc, 250cc</div>
                            @error('cc_mesin')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan: Kategori Badge, Tag Tambahan, Status, Gambar --}}
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="kategori_badge" class="form-label">Kategori Badge</label>
                            <select class="form-select" name="kategori_badge" id="kategori_badge">
                                <option value="">-- Pilih Badge Kategori --</option>
                                @foreach($data_kategori as $kategori)
                                    <option value="{{ $kategori->kategori_badge }}"
                                        {{ old('kategori_badge', $data->kategori_badge) == $kategori->kategori_badge ? 'selected' : '' }}>
                                        {{ $kategori->kategori_badge }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Badge ini akan tampil di kartu motor. Kelola daftar badge di menu <a href="/kategori" target="_blank">Kategori</a>.</div>
                            @error('kategori_badge')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tag_tambahan" class="form-label">Tag Tambahan</label>
                            <input type="text" name="tag_tambahan" class="form-control" placeholder="Contoh: Adventure" value="{{ old('tag_tambahan', $data->tag_tambahan) }}">
                            <div class="form-text">Tag ekstra yang tampil sebagai chip di kartu motor, contoh: Adventure, Premium, Sport.</div>
                            @error('tag_tambahan')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

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
                    </div>
                </div>

                {{-- Deskripsi full width --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi / Spesifikasi</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi"
                        style="height: 100px; resize: none;">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-top: 15px;">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="/motor" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection