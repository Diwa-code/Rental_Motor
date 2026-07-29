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
                            <div class="p-4 h-100 d-flex align-items-center justify-content-center position-relative"
                                style="background-color: #f8f9fa; border-radius: 0.375rem 0 0 0.375rem; min-height: 300px;">

                                {{-- Badge Kategori di pojok kiri atas gambar --}}
                                @if($data_motor->kategori_badge)
                                    <span class="position-absolute top-0 start-0 m-3 badge"
                                        style="background-color: #1a6e4a; font-size: 0.75rem; padding: 6px 10px; border-radius: 20px; letter-spacing: 0.3px;">
                                        {{ $data_motor->kategori_badge }}
                                    </span>
                                @endif

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
                                {{-- Nama & Tahun --}}
                                <h3 class="fw-bold mb-1">{{ $data_motor->nama_motor }}</h3>
                                <span class="badge bg-secondary mb-3"> Tahun: {{ $data_motor->tahun }}</span>

                                {{-- Harga --}}
                                <div class="col-sm-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-cash-coin text-primary" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Harga Sewa / Hari</small>
                                            <span class="fw-semibold">Rp
                                                {{ number_format($data_motor->harga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                {{-- Detail Info: Status, CC Mesin, Tag Tambahan --}}
                                <div class="row mb-3">
                                    {{-- Status --}}
                                    <div class="col-sm-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-check-circle text-primary"
                                                    viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Status</small>
                                                @php
                                                    $statusClass = match($data_motor->status) {
                                                        'tersedia' => 'success',
                                                        'disewa'   => 'warning',
                                                        'servis'   => 'danger',
                                                        default    => 'secondary',
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $statusClass }}">
                                                    {{ ucfirst($data_motor->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- CC Mesin --}}
                                    <div class="col-sm-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-gear text-info" viewBox="0 0 16 16">
                                                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                                                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.474l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">CC Mesin</small>
                                                <span class="fw-semibold">{{ $data_motor->cc_mesin ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Chip: CC & Tag Tambahan (seperti di foto referensi) --}}
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    @if($data_motor->cc_mesin)
                                        <span class="badge rounded-pill border border-secondary text-secondary fw-normal px-3 py-2"
                                            style="font-size: 0.8rem; background: transparent;">
                                            {{ $data_motor->cc_mesin }}
                                        </span>
                                    @endif
                                    @if($data_motor->tag_tambahan)
                                        <span class="badge rounded-pill border border-secondary text-secondary fw-normal px-3 py-2"
                                            style="font-size: 0.8rem; background: transparent;">
                                            {{ $data_motor->tag_tambahan }}
                                        </span>
                                    @endif
                                    @if($data_motor->tahun)
                                        <span class="badge rounded-pill border border-secondary text-secondary fw-normal px-3 py-2"
                                            style="font-size: 0.8rem; background: transparent;">
                                            {{ $data_motor->tahun }}
                                        </span>
                                    @endif
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
                                    <p class="text-secondary mb-0" style="line-height: 1.7;">{{ $data_motor->deskripsi ?? '-' }}
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