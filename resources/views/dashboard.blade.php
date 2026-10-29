@extends('layouts.app')

@section('title', 'Dashboard Operasional Petugas - BPBD Kab. Bandung')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col-md-8">
        <h3 class="fw-bold mb-1 text-dark">
            <i class="fa-solid fa-gauge-high text-primary me-2"></i> Dashboard Operasional Banjir
        </h3>
        <p class="text-muted mb-0">
            Selamat bertugas, <strong>{{ Auth::user()->name }}</strong>. Anda login dengan akun resmi BPBD Kabupaten Bandung.
        </p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold">
            <i class="fa-solid fa-circle text-success me-1 fa-fade"></i> Sistem Siaga Online
        </span>
    </div>
</div>

{{-- Kartu Ringkasan Metrik / Statistik Bencana (Modul 6 Pengembangan) --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom h-100 border-start border-primary border-4 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Total Laporan</span>
                        <h3 class="fw-bold my-1 text-primary">{{ $totalLaporan ?? 0 }}</h3>
                        <small class="text-muted">Masuk ke sistem</small>
                    </div>
                    <div class="rounded-circle bg-primary-subtle text-primary p-3">
                        <i class="fa-solid fa-clipboard-list fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom h-100 border-start border-danger border-4 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Status Awas</span>
                        <h3 class="fw-bold my-1 text-danger">{{ $awasCount ?? 0 }}</h3>
                        <small class="text-danger fw-semibold">> 70 cm (Kritis)</small>
                    </div>
                    <div class="rounded-circle bg-danger-subtle text-danger p-3">
                        <i class="fa-solid fa-triangle-exclamation fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom h-100 border-start border-warning border-4 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Status Siaga</span>
                        <h3 class="fw-bold my-1 text-warning">{{ $siagaCount ?? 0 }}</h3>
                        <small class="text-warning fw-semibold">30 - 70 cm</small>
                    </div>
                    <div class="rounded-circle bg-warning-subtle text-warning p-3">
                        <i class="fa-solid fa-water fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom h-100 border-start border-info border-4 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Petugas Terdaftar</span>
                        <h3 class="fw-bold my-1 text-info">{{ $petugasCount ?? 0 }}</h3>
                        <small class="text-muted">Personel Terdata</small>
                    </div>
                    <div class="rounded-circle bg-info-subtle text-info p-3">
                        <i class="fa-solid fa-users fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Aksi Cepat Petugas --}}
    <div class="col-lg-4">
        <div class="card card-custom shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fa-solid fa-bolt text-warning me-2"></i> Menu Cepat Petugas
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('banjir.index') }}" class="btn btn-outline-primary py-2 text-start fw-semibold">
                        <i class="fa-solid fa-list-check me-2 text-primary"></i> Kelola & Tinjau Semua Laporan
                    </a>
                    <a href="{{ route('banjir.create') }}" class="btn btn-outline-secondary py-2 text-start fw-semibold" target="_blank">
                        <i class="fa-solid fa-plus-circle me-2 text-secondary"></i> Buka Form Input Laporan Warga
                    </a>
                    <a href="{{ route('profile') }}" class="btn btn-outline-info py-2 text-start fw-semibold">
                        <i class="fa-solid fa-id-card me-2 text-info"></i> Tinjau Profil Saya (Auth::user)
                    </a>
                </div>

                <div class="mt-4 p-3 rounded bg-light border">
                    <h6 class="fw-bold small text-dark mb-1">
                        <i class="fa-solid fa-shield-halved text-success me-1"></i> Proteksi Middleware Auth
                    </h6>
                    <p class="text-muted small mb-0">
                        Halaman ini dan halaman daftar laporan sepenuhnya dilindungi oleh middleware <code>auth</code> Laravel. Pengguna yang belum login otomatis dialihkan ke formulir login.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Laporan Terbaru --}}
    <div class="col-lg-8">
        <div class="card card-custom shadow-sm h-100">
            <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> Laporan Banjir Masuk Terbaru
                </h5>
                <a href="{{ route('banjir.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Pelapor</th>
                                <th>Lokasi</th>
                                <th>Tinggi Genangan</th>
                                <th>Status</th>
                                <th class="text-end pe-3">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporanTerbaru ?? [] as $item)
                                <tr>
                                    <td class="ps-3 fw-semibold">{{ $item->nama_pelapor }}</td>
                                    <td>
                                        <i class="fa-solid fa-location-dot text-danger me-1 small"></i>
                                        {{ $item->lokasi }}
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->tinggi_genangan }}</span> cm
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->status_badge }} badge-status">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-3 text-muted small">
                                        {{ $item->tanggal_kejadian->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fa-regular fa-folder-open fs-2 d-block mb-2"></i>
                                        Belum ada data laporan banjir yang tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
