<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class BanjirController extends Controller
{
    /**
     * Menampilkan daftar seluruh laporan banjir (Wajib Login Petugas).
     */
    public function index(Request $request)
    {
        $query = Laporan::latest();

        // Filter berdasarkan pencarian nama atau lokasi
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_pelapor', 'like', "%{$keyword}%")
                  ->orWhere('lokasi', 'like', "%{$keyword}%");
            });
        }

        // Filter berdasarkan kategori status genangan
        if ($request->filled('status')) {
            if ($request->status === 'awas') {
                $query->where('tinggi_genangan', '>', 70);
            } elseif ($request->status === 'siaga') {
                $query->whereBetween('tinggi_genangan', [30, 70]);
            } elseif ($request->status === 'waspada') {
                $query->where('tinggi_genangan', '<', 30);
            }
        }

        $laporanList = $query->paginate(8)->withQueryString();

        return view('banjir.index', compact('laporanList'));
    }

    /**
     * Menampilkan formulir pelaporan banjir untuk warga (Publik - Tanpa Login).
     */
    public function create()
    {
        $kecamatanBandung = [
            'Dayeuhkolot',
            'Baleendah',
            'Bojongsoang',
            'Rancaekek',
            'Majalaya',
            'Ciparay',
            'Katapang',
            'Margahayu',
            'Banjaran',
            'Cicalengka',
            'Pameungpeuk',
            'Ibun',
        ];

        return view('banjir.form', compact('kecamatanBandung'));
    }

    /**
     * Menyimpan data laporan dari warga ke basis data (Publik - Tanpa Login).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor'     => ['required', 'string', 'max:255'],
            'lokasi'           => ['required', 'string', 'max:255'],
            'tinggi_genangan'  => ['required', 'numeric', 'min:1', 'max:500'],
            'tanggal_kejadian' => ['required', 'date'],
        ], [
            'nama_pelapor.required'     => 'Nama pelapor wajib diisi.',
            'lokasi.required'           => 'Lokasi kejadian genangan/banjir wajib diisi.',
            'tinggi_genangan.required'  => 'Ketinggian air wajib diisi.',
            'tinggi_genangan.numeric'   => 'Ketinggian air harus berupa angka (cm).',
            'tinggi_genangan.min'       => 'Ketinggian air minimal 1 cm.',
            'tanggal_kejadian.required' => 'Tanggal kejadian wajib diisi.',
            'tanggal_kejadian.date'     => 'Format tanggal tidak valid.',
        ]);

        $dataLaporan = Laporan::create($validated);

        return view('banjir.konfirmasi', compact('dataLaporan'))
            ->with('success', 'Laporan berhasil dicatat oleh sistem Pusdalops BPBD Kabupaten Bandung.');
    }

    /**
     * Menampilkan detail satu laporan banjir (Wajib Login Petugas).
     */
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('banjir.show', compact('laporan'));
    }
}
