@extends('layouts.app')

@section('title', 'LaporBanjir - Sistem Informasi Siaga Bencana BPBD Kab. Bandung')

@section('content')
{{-- Hero Banner Section --}}
<div class="row align-items-center py-4 mb-5">
    <div class="col-lg-7">
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-semibold mb-3 d-inline-block">
            <i class="fa-solid fa-tower-broadcast text-primary me-1"></i> Sistem Tanggap Darurat Bencana Banjir
        </span>
        <h1 class="display-5 fw-bold text-dark mb-3">
            Pusat Informasi & Pelaporan Cepat <span style="color: #0077b6;">Banjir Kab. Bandung</span>
        </h1>
        <p class="lead text-muted mb-4" style="font-size: 1.1rem; line-height: 1.6;">
            Aplikasi resmi Badan Penanggulangan Bencana Daerah (BPBD) Kabupaten Bandung untuk mempermudah masyarakat melaporkan titik genangan air secara cepat, akurat, dan langsung ditindaklanjuti oleh petugas posko.
        </p>

        <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('banjir.create') }}" class="btn btn-warning btn-lg px-4 py-3 fw-bold shadow-sm" style="background-color: #f77f00; border-color: #f77f00; color: #fff;">
                <i class="fa-solid fa-bullhorn me-2"></i> Laporkan Banjir Sekarang
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 py-3 fw-bold shadow-sm">
                    <i class="fa-solid fa-gauge-high me-2"></i> Buka Dashboard Petugas
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-4 py-3 fw-semibold">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Masuk Akun Petugas
                </a>
            @endauth
        </div>
    </div>

    <div class="col-lg-5 mt-4 mt-lg-0">
        <div class="card card-custom p-4 border-0 shadow" style="background: linear-gradient(145deg, #ffffff 0%, #edf6f9 100%);">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-danger text-white rounded-circle p-3 me-3">
                    <i class="fa-solid fa-phone-volume fs-3"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-danger">Call Center 24 Jam BPBD</h5>
                    <small class="text-muted">Siap Melayani Warga Kabupaten Bandung</small>
                </div>
            </div>
            <div class="bg-white p-3 rounded-3 border mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="text-muted small">Nomor Darurat Nasional:</span>
                    <span class="badge bg-danger fs-6 px-3 py-1">112</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Pusdalops WhatsApp:</span>
                    <span class="fw-bold text-primary">0821-2233-4455</span>
                </div>
            </div>
            <div class="small text-muted">
                <i class="fa-solid fa-circle-info text-info me-1"></i>
                Setiap laporan masyarakat akan divalidasi langsung oleh tim reaksi cepat BPBD di kecamatan terkait (Dayeuhkolot, Baleendah, Bojongsoang, Rancaekek, dan sekitarnya).
            </div>
        </div>
    </div>
</div>

{{-- Alur Layanan dan Status Kategori --}}
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card card-custom h-100 p-4 border-top border-4 border-info shadow-sm">
            <div class="rounded-circle bg-info-subtle text-info d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                <i class="fa-solid fa-pen-to-square fs-4"></i>
            </div>
            <h5 class="fw-bold">1. Warga Lapor Tanpa Login</h5>
            <p class="text-muted small mb-0">
                Warga terdampak dapat langsung mengisi formulir bencana tanpa perlu membuat akun atau login. Cukup cantumkan nama, lokasi, dan ketinggian air.
            </p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom h-100 p-4 border-top border-4 border-primary shadow-sm">
            <div class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                <i class="fa-solid fa-shield-halved fs-4"></i>
            </div>
            <h5 class="fw-bold">2. Proteksi Data Petugas</h5>
            <p class="text-muted small mb-0">
                Sesuai ketentuan Modul 6, seluruh data laporan dan identitas pelapor dilindungi middleware <code>auth</code> sehingga hanya petugas berwenang yang dapat meninjaunya.
            </p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom h-100 p-4 border-top border-4 border-danger shadow-sm">
            <div class="rounded-circle bg-danger-subtle text-danger d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                <i class="fa-solid fa-truck-droplet fs-4"></i>
            </div>
            <h5 class="fw-bold">3. Penanganan Siaga Cepat</h5>
            <p class="text-muted small mb-0">
                Status genangan terbagi otomatis menjadi <strong>Waspada (&lt; 30 cm)</strong>, <strong>Siaga (30 - 70 cm)</strong>, dan <strong>Awas (&gt; 70 cm)</strong> untuk skala prioritas evakuasi.
            </p>
        </div>
    </div>
</div>
@endsection
