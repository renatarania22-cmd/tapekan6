<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'LaporBanjir - BPBD Kabupaten Bandung')</title>

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets (NPM / Node.js: Bootstrap 5 & Custom Style) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body>

    <!-- NAVBAR RESMI BPBD -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-bpbd sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <span class="p-2 rounded-circle bg-white text-primary me-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="fa-solid fa-water-ladder text-primary"></i>
                </span>
                <div>
                    <span class="text-white">Lapor<span style="color: #64dfdf;">Banjir</span></span>
                    <small class="d-block text-white-50" style="font-size: 0.65rem; font-weight: 400; letter-spacing: 0.5px;">BPBD KABUPATEN BANDUNG</small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBPBD" aria-controls="navbarBPBD" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarBPBD">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fa-solid fa-house me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('banjir.create') ? 'active' : '' }}" href="{{ route('banjir.create') }}">
                            <i class="fa-solid fa-bullhorn me-1"></i> Lapor Banjir
                        </a>
                    </li>

                    {{-- Menu Khusus Petugas BPBD (Wajib Login) --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fa-solid fa-gauge-high me-1"></i> Dashboard Petugas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('banjir.index') ? 'active' : '' }}" href="{{ route('banjir.index') }}">
                                <i class="fa-solid fa-list-check me-1"></i> Kelola Laporan
                            </a>
                        </li>
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    {{-- Navigasi Dinamis Menggunakan Direktif @auth dan @else --}}
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="bg-info text-dark rounded-circle me-2 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 0.8rem; font-weight: 700;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                                <li class="px-3 py-2 text-muted" style="font-size: 0.78rem;">
                                    <strong>Role:</strong> Petugas BPBD<br>
                                    <span class="text-truncate d-block">{{ Auth::user()->email }}</span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fa-solid fa-id-badge text-primary me-2"></i> Profil Petugas
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fa-solid fa-chart-pie text-success me-2"></i> Statistik Operasional
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Keluar (Logout)
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a class="nav-link text-white {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="fa-solid fa-right-to-bracket me-1"></i> Login Petugas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
                                <i class="fa-solid fa-user-plus me-1"></i> Registrasi Petugas
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <main class="main-content">
        <div class="container">
            {{-- Flash Alert Notifikasi Sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle-check fs-4 me-3 text-success"></i>
                        <div>
                            <strong>Berhasil!</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Flash Alert Notifikasi Status --}}
            @if(session('status'))
                <div class="alert alert-info alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle-info fs-4 me-3 text-info"></i>
                        <div>
                            {{ session('status') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Flash Alert Penanganan Galat Validasi --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                    <div class="d-flex">
                        <i class="fa-solid fa-triangle-exclamation fs-4 me-3 text-danger mt-1"></i>
                        <div>
                            <strong>Terjadi Kesalahan Input:</strong>
                            <ul class="mb-0 mt-1 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- FOOTER BPBD -->
    <footer class="footer-bpbd py-4">
        <div class="container">
            <div class="row align-items-center gy-3">
                <div class="col-md-6 text-center text-md-start">
                    <h6 class="text-white mb-1 font-weight-bold">
                        <i class="fa-solid fa-shield-halved text-info me-1"></i> Pusat Pengendalian Operasi Penanggulangan Bencana (PUSDALOPS)
                    </h6>
                    <p class="text-white-50 mb-0" style="font-size: 0.8rem;">
                        Badan Penanggulangan Bencana Daerah (BPBD) Kabupaten Bandung — Layanan Siaga Bencana 24 Jam.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span class="badge bg-danger px-3 py-2 me-2">
                        <i class="fa-solid fa-phone-volume me-1"></i> Emergency Call: 112
                    </span>
                    <span class="badge bg-secondary px-3 py-2">
                        <i class="fa-brands fa-whatsapp me-1"></i> 0821-BPBD-BDG
                    </span>
                </div>
            </div>
            <hr class="my-3 border-secondary">
            <div class="text-center text-white-50" style="font-size: 0.75rem;">
                &copy; {{ date('Y') }} Sistem Informasi LaporBanjir Kab. Bandung. Dikerjakan untuk Praktikum PABW Modul 6.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
