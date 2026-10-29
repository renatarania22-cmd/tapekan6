@extends('layouts.app')

@section('title', 'Detail Laporan Banjir #' . $laporan->id . ' - BPBD Kab. Bandung')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fa-solid fa-file-invoice text-white me-2"></i> Detail Laporan Banjir #{{ $laporan->id }}
                </h5>
                <span class="badge {{ $laporan->status_badge }} badge-status">
                    Status: {{ $laporan->status }}
                </span>
            </div>

            <div class="card-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <label class="text-muted small d-block">Nama Lengkap Pelapor</label>
                        <span class="fw-bold fs-6 text-dark">{{ $laporan->nama_pelapor }}</span>
                    </div>

                    <div class="col-sm-6">
                        <label class="text-muted small d-block">Tanggal Kejadian Banjir</label>
                        <span class="fw-bold fs-6 text-dark">
                            {{ $laporan->tanggal_kejadian ? $laporan->tanggal_kejadian->format('d F Y') : '-' }}
                        </span>
                    </div>

                    <div class="col-sm-6">
                        <label class="text-muted small d-block">Lokasi / Titik Genangan</label>
                        <span class="fw-bold fs-6 text-danger">
                            <i class="fa-solid fa-location-dot me-1"></i> {{ $laporan->lokasi }}
                        </span>
                    </div>

                    <div class="col-sm-6">
                        <label class="text-muted small d-block">Ketinggian Air</label>
                        <span class="fw-bold fs-5 text-primary">
                            {{ $laporan->tinggi_genangan }} cm
                        </span>
                    </div>
                </div>

                <div class="p-3 rounded bg-light border mb-4">
                    <h6 class="fw-bold small text-dark mb-2">
                        <i class="fa-solid fa-circle-exclamation text-warning me-1"></i> Rekomendasi Tindakan Operasional:
                    </h6>
                    @if($laporan->tinggi_genangan < 30)
                        <p class="text-muted small mb-0">
                            <strong>Level Waspada (&lt; 30 cm):</strong> Pantau kondisi saluran drainase sekitar secara berkala. Arus lalu lintas kendaraan roda dua masih dapat melintas secara hati-hati.
                        </p>
                    @elseif($laporan->tinggi_genangan <= 70)
                        <p class="text-muted small mb-0">
                            <strong>Level Siaga (30 - 70 cm):</strong> Siagakan tim TRC (Tim Reaksi Cepat) BPBD kecamatan, koordinasikan penutupan ruas jalan bagi kendaraan kecil, dan pastikan pompa air dioperasikan.
                        </p>
                    @else
                        <p class="text-muted small mb-0">
                            <strong>Level Awas (&gt; 70 cm):</strong> Luncurkan perahu karet evakuasi warga kelompok rentan (lansia dan anak-anak), buka posko pengungsian darurat, dan koordinasikan pemutusan aliran PLN.
                        </p>
                    @endif
                </div>

                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <a href="{{ route('banjir.index') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Laporan
                    </a>
                    <span class="text-muted small">
                        Diterima sistem: {{ $laporan->created_at ? $laporan->created_at->diffForHumans() : '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
