@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">Tambah Data Transaksi Baru</div>
        <div class="card-body">
            <form action="/transaksi" method="POST">
                @csrf
                <div class="row mt-3">
                    
                    {{-- Kolom Kiri: Customer & Tanggal Mulai --}}
                    <div class="col-sm-6">
                        <div class="mb-4">
                            <label for="customer_id" class="form-label fw-bold">Pilih Customer</label>
                            <select class="form-select" name="customer_id" id="customer_id">
                                <option value="">-- Silakan Pilih Customer --</option>
                                @foreach($data_customer as $customer)
                                    <option value="{{ $customer->id_customer }}" {{ old('customer_id') == $customer->id_customer ? 'selected' : '' }}>
                                        {{ $customer->nama }} - {{ $customer->no_telp }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tgl_mulai" class="form-label fw-bold">Tanggal Mulai Sewa</label>
                            <input type="date" name="tgl_mulai" class="form-control" value="{{ old('tgl_mulai') }}">
                            @error('tgl_mulai')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan: Motor & Durasi (Diperbarui dengan Tipe Sewa) --}}
                    <div class="col-sm-6">
                        <div class="mb-4">
                            <label for="motor_id" class="form-label fw-bold">Pilih Motor (Hanya yang Tersedia)</label>
                            <select class="form-select" name="motor_id" id="motor_id">
                                <option value="">-- Silakan Pilih Motor --</option>
                                @foreach($data_motor as $motor)
                                    <option value="{{ $motor->id_motor }}" {{ old('motor_id') == $motor->id_motor ? 'selected' : '' }}>
                                        {{ $motor->nama_motor }} | Rp {{ number_format($motor->harga, 0, ',', '.') }} / hari
                                    </option>
                                @endforeach
                            </select>
                            @error('motor_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">Motor yang berstatus "disewa" otomatis disembunyikan.</div>
                        </div>

                        <div class="row">
                            <!-- Dropdown Tipe Sewa (Baru) -->
                            <div class="col-md-6 mb-4">
                                <label for="tipe_durasi" class="form-label fw-bold">Tipe Sewa</label>
                                <select class="form-select" name="tipe_durasi" id="tipe_durasi">
                                    <option value="hari" {{ old('tipe_durasi') == 'hari' ? 'selected' : '' }}>Harian</option>
                                    <option value="bulan" {{ old('tipe_durasi') == 'bulan' ? 'selected' : '' }}>Bulanan (Diskon)</option>
                                </select>
                            </div>
                            
                            <!-- Input Angka Durasi -->
                            <div class="col-md-6 mb-4">
                                <label for="durasi" class="form-label fw-bold">Durasi (Angka)</label>
                                <input type="number" name="durasi" class="form-control" placeholder="Contoh: 2" value="{{ old('durasi') }}" min="1">
                                @error('durasi')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-3 mt-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan Transaksi</button>
                    <a href="/transaksi" class="btn btn-secondary ms-2 px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection