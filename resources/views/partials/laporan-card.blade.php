<div class="card card-custom p-3 mb-3 shadow-sm border-start border-4 {{ $laporan->tinggi_genangan > 70 ? 'border-danger' : ($laporan->tinggi_genangan >= 30 ? 'border-warning' : 'border-info') }}">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h5 class="fw-bold mb-1">
                <i class="fa-solid fa-location-dot text-danger me-1"></i>
                {{ $laporan->lokasi ?? $laporan['lokasi'] }}
            </h5>
            <p class="text-muted small mb-2">
                <i class="fa-regular fa-user me-1"></i> Pelapor: <strong>{{ $laporan->nama_pelapor ?? $laporan['nama_pelapor'] }}</strong> |
                <i class="fa-regular fa-calendar me-1"></i> {{ is_object($laporan->tanggal_kejadian ?? null) ? $laporan->tanggal_kejadian->format('d M Y') : ($laporan['tanggal_kejadian'] ?? '-') }}
            </p>
        </div>
        <div>
            @php
                $tinggi = $laporan->tinggi_genangan ?? $laporan['tinggi_genangan'] ?? 0;
            @endphp
            @if($tinggi < 30)
                <span class="badge bg-info text-dark badge-status">Waspada</span>
            @elseif($tinggi <= 70)
                <span class="badge bg-warning text-dark badge-status">Siaga</span>
            @else
                <span class="badge bg-danger text-white badge-status">Awas</span>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
        <span class="text-muted small">
            Ketinggian Air: <strong class="fs-6 text-dark">{{ $tinggi }} cm</strong>
        </span>
        <a href="{{ route('banjir.show', $laporan->id ?? 1) }}" class="btn btn-sm btn-outline-primary">
            Lihat Detail <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
    </div>
</div>
