@extends('layouts.app')

@section('title', 'Login Petugas - LaporBanjir BPBD Kab. Bandung')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-header bg-primary text-white text-center py-4">
                <div class="d-inline-flex p-3 rounded-circle bg-white text-primary mb-2 shadow-sm">
                    <i class="fa-solid fa-user-shield fs-3"></i>
                </div>
                <h5 class="mb-1 font-weight-bold">Portal Petugas BPBD</h5>
                <p class="mb-0 text-white-50 small">Autentikasi Hak Akses Operasional Penanganan Banjir</p>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    {{-- Input Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="fa-regular fa-envelope me-1 text-primary"></i> Alamat Email
                        </label>
                        <input id="email" type="email"
                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               placeholder="nama@bpbd.go.id"
                               required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            <i class="fa-solid fa-lock me-1 text-primary"></i> Kata Sandi (Password)
                        </label>
                        <input id="password" type="password"
                               class="form-control form-control-lg @error('password') is-invalid @enderror"
                               name="password"
                               placeholder="••••••••"
                               required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Checkbox Remember Me --}}
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted small" for="remember">
                            Ingat saya di perangkat ini (Remember Me)
                        </label>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold py-2 shadow-sm">
                            <i class="fa-solid fa-right-to-bracket me-2"></i> Masuk Sekarang
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3 pt-3 border-top">
                    <p class="text-muted small mb-0">
                        Belum memiliki akun petugas lapangan?
                        <a href="{{ route('register') }}" class="text-primary fw-semibold text-decoration-none">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Petunjuk Pengujian untuk Dosen / Asisten Praktikum --}}
        <div class="card border-0 bg-light p-3 rounded-3 shadow-xs">
            <h6 class="fw-bold mb-2 text-secondary" style="font-size: 0.82rem;">
                <i class="fa-solid fa-key text-warning me-1"></i> Akun Demo Seeder Petugas (Modul 6):
            </h6>
            <div class="bg-white p-2 rounded border small text-muted font-monospace">
                <div><strong>Email:</strong> pusdalops@bpbd-kabbandung.go.id</div>
                <div><strong>Password:</strong> pusdalops123</div>
            </div>
        </div>
    </div>
</div>
@endsection
