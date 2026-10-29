@extends('layouts.app')

@section('title', 'Daftar Laporan Banjir Terverifikasi - BPBD Kab. Bandung')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col-md-7">
        <h3 class="fw-bold mb-1 text-dark">
            <i class="fa-solid fa-list-check text-primary me-2"></i> Pengelolaan Laporan Banjir
        </h3>
        <p class="text-muted mb-0">
            Daftar laporan masyarakat wilayah Kabupaten Bandung yang telah terverifikasi oleh sistem Pusdalops BPBD.
        </p>
    </div>
    <div class="col-md-5 text-md-end mt-3 mt-md-0">
        <a href="{{ route('banjir.create') }}" class="btn btn-warning fw-semibold shadow-sm" style="background-color: #f77f00; border-color: #f77f00; color: #fff;">
            <i class="fa-solid fa-plus me-1"></i> Tambah Laporan Manual
        </a>
    </div>
</div>

{{-- Bar Pencarian & Filter Status --}}
<div class="card card-custom shadow-sm mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('banjir.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fa-solid fa-magnifying-glass text-muted"></i>
                    </span>
                    <input type="text" name="q" class="form-control border-start-0"
                           placeholder="Cari nama pelapor atau lokasi..."
                           value="{{ request('q') }}">
                </div>
            </div>

            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">Semua Tingkat Status</option>
                    <option value="awas" {{ request('status') === 'awas' ? 'selected' : '' }}>Awas (&gt; 70 cm)</option>
                    <option value="siaga" {{ request('status') === 'siaga' ? 'selected' : '' }}>Siaga (30 - 70 cm)</option>
                    <option value="waspada" {{ request('status') === 'waspada' ? 'selected' : '' }}>Waspada (&lt; 30 cm)</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="fa-solid fa-filter me-1"></i> Filter
                </button>
                @if(request()->hasAny(['q', 'status']))
                    <a href="{{ route('banjir.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Tabel Data Laporan --}}
<div class="card card-custom shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width: 60px;">No</th>
                        <th>Tanggal</th>
                        <th>Nama Pelapor</th>
                        <th>Lokasi Kejadian</th>
                        <th>Ketinggian Genangan</th>
                        <th>Status Bahaya</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporanList as $index => $item)
                        <tr>
                            <td class="ps-3 text-muted fw-bold">
                                {{ ($laporanList->currentPage() - 1) * $laporanList->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <span class="text-muted small">
                                    <i class="fa-regular fa-calendar me-1"></i>
                                    {{ $item->tanggal_kejadian ? $item->tanggal_kejadian->format('d/m/Y') : '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $item->nama_pelapor }}</span>
                            </td>
                            <td>
                                <i class="fa-solid fa-location-dot text-danger me-1 small"></i>
                                <span class="fw-medium">{{ $item->lokasi }}</span>
                            </td>
                            <td>
                                <span class="fw-bold fs-6">{{ $item->tinggi_genangan }}</span>
                                <span class="text-muted small">cm</span>
                            </td>
                            <td>
                                <span class="badge {{ $item->status_badge }} badge-status">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('banjir.show', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                    <i class="fa-solid fa-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-box-open fs-1 text-secondary mb-3 d-block"></i>
                                <h6 class="fw-bold">Tidak ada data laporan yang cocok.</h6>
                                <p class="small mb-0">Silakan ubah filter pencarian atau input data baru melalui tombol di atas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($laporanList->hasPages())
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
            <span class="text-muted small">
                Menampilkan {{ $laporanList->firstItem() }} sampai {{ $laporanList->lastItem() }} dari {{ $laporanList->total() }} laporan
            </span>
            <div>
                {{ $laporanList->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection
