@extends('layout.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Detail Motor</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/motor" class="text-decoration-none">Motor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data_motor->nama_motor }}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data_motor->tahun }}</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="/motor/{{ $data_motor->id_motor }}/edit" class="btn btn-outline-warning btn-sm me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                        Edit
                    </a>
                    <a href="/motor" class="btn btn-outline-secondary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="row g-0">
                        {{-- Kolom Gambar --}}
                        <div class="col-md-5">
                            <div class="p-4 h-100 d-flex align-items-center justify-content-center"
                                style="background-color: #f8f9fa; border-radius: 0.375rem 0 0 0.375rem; min-height: 300px;">
                                @if($data_motor->gambar_motor)
                                    <img src="{{ asset('gambar_motor/' . $data_motor->gambar_motor) }}" class="img-fluid rounded"
                                        alt="{{ $data_motor->nama_motor }}"
                                        style="max-height: 350px; object-fit: contain; width: 100%;">
                                @else
                                    <div class="text-center text-muted px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                                            class="bi bi-image mb-3 opacity-25" viewBox="0 0 16 16">
                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                            <path
                                                d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                                        </svg>
                                        <p class="mb-2 fw-semibold">Belum ada gambar</p>
                                        <a href="/motor/{{ $data_motor->id_motor }}/edit"
                                            class="btn btn-sm btn-outline-primary">
                                            Tambahkan Gambar Sekarang
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Kolom Informasi --}}
                        <div class="col-md-7">
                            <div class="p-4">
                                {{-- Nama Produk --}}
                                <h3 class="fw-bold mb-1">{{ $data_motor->nama_motor }}</h3>
                                <span class="badge bg-secondary mb-3"> Tahun: {{ $data_motor->tahun }}</span>

                                <div class="col-sm-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-box-seam text-primary" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Harga Sewa / Bulan</small>
                                            <span class="fw-semibold">Rp
                                                {{ number_format($data_motor->harga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                {{-- Detail Info --}}
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-box-seam text-primary"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Status</small>
                                                <span class="fw-semibold">{{ $data_motor->status }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-warning bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-tags text-warning" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z" />
                                                    <path
                                                        d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                                    <path
                                                        d="M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Kategori</small>
                                                <span class="fw-semibold">{{ $data_motor->nama_kategori }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                {{-- Deskripsi --}}
                                <div>
                                    <h6 class="fw-bold text-muted mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-card-text me-1" viewBox="0 0 16 16">
                                            <path
                                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                            <path
                                                d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                        </svg>
                                        Deskripsi Motor
                                    </h6>
                                    <p class="text-secondary mb-0" style="line-height: 1.7;">{{ $data_motor->deskripsi }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection