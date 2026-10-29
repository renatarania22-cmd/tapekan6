@extends('layouts.app')

@section('title', 'Konfirmasi Laporan Diterima - BPBD Kab. Bandung')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="card card-custom shadow-sm text-center p-4 mb-4">
            <div class="my-3">
                <span class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 72px; height: 72px; font-size: 2rem;">
                    <i class="fa-solid fa-check"></i>
                </span>
            </div>

            <h3 class="fw-bold text-dark mb-1">Laporan Berhasil Terkirim!</h3>
            <p class="text-muted small mb-4">
                Laporan kejadian banjir Anda telah dicatat oleh sistem Pusdalops BPBD Kabupaten Bandung dengan nomor tiket #{{ $dataLaporan->id ?? rand(100, 999) }}.
            </p>

            <div class="card bg-light border-0 text-start p-3 rounded-3 mb-4">
                <h6 class="fw-bold border-bottom pb-2 mb-3 text-primary">
                    <i class="fa-solid fa-receipt me-1"></i> Rincian Informasi Laporan:
                </h6>

                <div class="row g-2 small">
                    <div class="col-4 text-muted">Nama Pelapor:</div>
                    <div class="col-8 fw-semibold">{{ $dataLaporan->nama_pelapor ?? $dataLaporan['nama_pelapor'] }}</div>

                    <div class="col-4 text-muted">Lokasi Banjir:</div>
                    <div class="col-8 fw-semibold">
                        <i class="fa-solid fa-location-dot text-danger me-1"></i>
                        {{ $dataLaporan->lokasi ?? $dataLaporan['lokasi'] }}
                    </div>

                    <div class="col-4 text-muted">Ketinggian Genangan:</div>
                    <div class="col-8 fw-semibold">
                        {{ $dataLaporan->tinggi_genangan ?? $dataLaporan['tinggi_genangan'] }} cm
                    </div>

                    <div class="col-4 text-muted">Tanggal Kejadian:</div>
                    <div class="col-8 fw-semibold">
                        {{ is_object($dataLaporan->tanggal_kejadian ?? null) ? $dataLaporan->tanggal_kejadian->format('d F Y') : ($dataLaporan['tanggal_kejadian'] ?? date('d F Y')) }}
                    </div>

                    <div class="col-4 text-muted">Kategori Status:</div>
                    <div class="col-8">
                        @php
                            $tinggi = $dataLaporan->tinggi_genangan ?? $dataLaporan['tinggi_genangan'] ?? 0;
                        @endphp
                        @if($tinggi < 30)
                            <span class="badge bg-info text-dark">Waspada (&lt; 30 cm)</span>
                        @elseif($tinggi <= 70)
                            <span class="badge bg-warning text-dark">Siaga (30 - 70 cm)</span>
                        @else
                            <span class="badge bg-danger text-white">Awas (&gt; 70 cm)</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="alert alert-warning border-0 small text-start mb-4 py-2 px-3">
                <i class="fa-solid fa-triangle-exclamation text-warning me-1"></i>
                <strong>Protokol Siaga:</strong> Matikan arus listrik utama di tempat tinggal Anda, simpan dokumen berharga di tempat tinggi, dan hubungi <strong>112</strong> jika memerlukan perahu evakuasi darurat.
            </div>

            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                    <i class="fa-solid fa-house me-1"></i> Kembali ke Beranda
                </a>
                <a href="{{ route('banjir.create') }}" class="btn btn-primary px-4">
                    <i class="fa-solid fa-plus me-1"></i> Lapor Titik Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
