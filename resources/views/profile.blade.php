@extends('layouts.app')

@section('title', 'Profil Petugas BPBD - LaporBanjir')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card card-custom shadow-sm">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fa-solid fa-id-card-clip me-2"></i> Profil Petugas BPBD
                </h5>
                <span class="badge bg-white text-primary fw-bold px-3 py-1 rounded-pill">
                    <i class="fa-solid fa-circle-check text-success me-1"></i> Terotentikasi
                </span>
            </div>

            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="avatar-circle mx-auto mb-3 bg-primary text-white d-flex align-items-center justify-content-center shadow" style="width: 80px; height: 80px; border-radius: 50%; font-size: 2rem; font-weight: 700;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <h4 class="fw-bold mb-0">{{ Auth::user()->name }}</h4>
                    <span class="badge bg-info text-dark mt-1 px-3 py-1 rounded-pill">
                        <i class="fa-solid fa-shield-halved me-1"></i> Personel Pusdalops BPBD Kab. Bandung
                    </span>
                </div>

                <div class="list-group list-group-flush border rounded-3 mb-4">
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted">
                            <i class="fa-regular fa-user me-2 text-primary"></i> Nama Lengkap
                        </span>
                        <span class="fw-semibold">{{ Auth::user()->name }}</span>
                    </div>

                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted">
                            <i class="fa-regular fa-envelope me-2 text-primary"></i> Alamat Email Dinas
                        </span>
                        <span class="fw-semibold">{{ Auth::user()->email }}</span>
                    </div>

                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted">
                            <i class="fa-regular fa-clock me-2 text-primary"></i> Akun Dibuat (diffForHumans)
                        </span>
                        <span class="badge bg-secondary-subtle text-secondary border px-3 py-2 fw-semibold">
                            {{ Auth::user()->created_at ? Auth::user()->created_at->diffForHumans() : 'Baru saja' }}
                        </span>
                    </div>

                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted">
                            <i class="fa-regular fa-calendar-check me-2 text-primary"></i> Tanggal Registrasi
                        </span>
                        <span class="fw-semibold">
                            {{ Auth::user()->created_at ? Auth::user()->created_at->format('d F Y - H:i:s') : '-' }}
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Logout Petugas
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
