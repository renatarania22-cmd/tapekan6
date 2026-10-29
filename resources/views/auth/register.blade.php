@extends('layouts.app')

@section('title', 'Registrasi Petugas Baru - LaporBanjir BPBD')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-header bg-dark text-white text-center py-4" style="background: linear-gradient(135deg, #0a4275 0%, #1d3557 100%) !important;">
                <div class="d-inline-flex p-3 rounded-circle bg-white text-primary mb-2 shadow-sm">
                    <i class="fa-solid fa-user-plus fs-3"></i>
                </div>
                <h5 class="mb-1 font-weight-bold text-white">Registrasi Akun Petugas</h5>
                <p class="mb-0 text-white-50 small">Pendaftaran Personel Penanggulangan Bencana Banjir BPBD</p>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}" novalidate>
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            <i class="fa-regular fa-user me-1 text-primary"></i> Nama Lengkap Petugas
                        </label>
                        <input id="name" type="text"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}"
                               placeholder="Contoh: Budi Santoso, S.Kom"
                               required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Alamat Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="fa-regular fa-envelope me-1 text-primary"></i> Alamat Email Dinas
                        </label>
                        <input id="email" type="email"
                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               placeholder="petugas@bpbd-kabbandung.go.id"
                               required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Kata Sandi --}}
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            <i class="fa-solid fa-lock me-1 text-primary"></i> Kata Sandi (Password)
                        </label>
                        <input id="password" type="password"
                               class="form-control form-control-lg @error('password') is-invalid @enderror"
                               name="password"
                               placeholder="Minimal 6 karakter"
                               required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Konfirmasi Kata Sandi --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">
                            <i class="fa-solid fa-shield-check me-1 text-primary"></i> Konfirmasi Kata Sandi
                        </label>
                        <input id="password_confirmation" type="password"
                               class="form-control form-control-lg"
                               name="password_confirmation"
                               placeholder="Ulangi kata sandi di atas"
                               required autocomplete="new-password">
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold py-2 shadow-sm">
                            <i class="fa-solid fa-clipboard-check me-2"></i> Daftarkan Akun Saya
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3 pt-3 border-top">
                    <p class="text-muted small mb-0">
                        Sudah memiliki akun terdaftar?
                        <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">
                            Masuk ke Portal Petugas
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
