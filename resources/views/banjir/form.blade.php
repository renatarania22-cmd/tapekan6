@extends('layouts.app')

@section('title', 'Form Pelaporan Kejadian Banjir - BPBD Kab. Bandung')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        {{-- Banner Informasi --}}
        <div class="alert alert-info border-0 shadow-sm d-flex align-items-center mb-4 p-3 rounded-3" style="background-color: #e0f2fe; color: #0369a1;">
            <i class="fa-solid fa-circle-info fs-3 me-3 text-primary"></i>
            <div>
                <strong>Layanan Pelaporan Publik Tanpa Login</strong><br>
                <small>Warga masyarakat Kabupaten Bandung dapat langsung mengirim laporan kejadian banjir di lingkungannya tanpa harus membuat akun atau melakukan login.</small>
            </div>
        </div>

        <div class="card card-custom shadow-sm mb-4">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-house-flood-water fs-4 me-2"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Formulir Laporan Kejadian Genangan / Banjir</h5>
                        <small class="text-white-50">Lengkapi formulir di bawah ini dengan data yang sebenarnya</small>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('banjir.store') }}" method="POST">
                    @csrf

                    {{-- Nama Pelapor --}}
                    <div class="mb-3">
                        <label for="nama_pelapor" class="form-label fw-semibold">
                            <i class="fa-regular fa-user text-primary me-1"></i> Nama Lengkap Pelapor
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('nama_pelapor') is-invalid @enderror"
                               id="nama_pelapor"
                               name="nama_pelapor"
                               value="{{ old('nama_pelapor') }}"
                               placeholder="Masukkan nama lengkap Anda"
                               required autofocus>
                        @error('nama_pelapor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Lokasi Kejadian --}}
                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-semibold">
                            <i class="fa-solid fa-location-dot text-danger me-1"></i> Lokasi Kejadian / Wilayah Rawan
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('lokasi') is-invalid @enderror"
                               id="lokasi"
                               name="lokasi"
                               list="kecamatanList"
                               value="{{ old('lokasi') }}"
                               placeholder="Contoh: Dayeuhkolot - RW 02 Kp. Bojong Asih"
                               required>
                        <datalist id="kecamatanList">
                            @foreach($kecamatanBandung ?? ['Dayeuhkolot', 'Baleendah', 'Bojongsoang', 'Rancaekek', 'Majalaya', 'Ciparay', 'Katapang', 'Margahayu', 'Banjaran'] as $kec)
                                <option value="{{ $kec }}">
                            @endforeach
                        </datalist>
                        <div class="form-text text-muted small">
                            Pilih rekomendasi kecamatan dari daftar atau ketikkan alamat lengkap RT/RW Anda.
                        </div>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        {{-- Ketinggian Genangan Air --}}
                        <div class="col-md-6 mb-3">
                            <label for="tinggi_genangan" class="form-label fw-semibold">
                                <i class="fa-solid fa-ruler-vertical text-info me-1"></i> Ketinggian Genangan Air (cm)
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg">
                                <input type="number"
                                       class="form-control @error('tinggi_genangan') is-invalid @enderror"
                                       id="tinggi_genangan"
                                       name="tinggi_genangan"
                                       value="{{ old('tinggi_genangan') }}"
                                       min="1" max="500"
                                       placeholder="Contoh: 45"
                                       required>
                                <span class="input-group-text fw-bold">cm</span>
                                @error('tinggi_genangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text small mt-1">
                                Standar BPBD: &lt;30 cm (Waspada), 30-70 cm (Siaga), &gt;70 cm (Awas).
                            </div>
                        </div>

                        {{-- Tanggal Kejadian --}}
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_kejadian" class="form-label fw-semibold">
                                <i class="fa-regular fa-calendar-days text-primary me-1"></i> Tanggal Kejadian
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                   class="form-control form-control-lg @error('tanggal_kejadian') is-invalid @enderror"
                                   id="tanggal_kejadian"
                                   name="tanggal_kejadian"
                                   value="{{ old('tanggal_kejadian', date('Y-m-d')) }}"
                                   required>
                            @error('tanggal_kejadian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i> Batal / Kembali
                        </a>
                        <button type="submit" class="btn btn-warning btn-lg px-4 fw-bold shadow-sm" style="background-color: #f77f00; border-color: #f77f00; color: #fff;">
                            <i class="fa-solid fa-paper-plane me-2"></i> Kirim Laporan Bencana
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
