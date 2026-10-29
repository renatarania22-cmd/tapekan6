<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Beranda Publik / Portal LaporBanjir
     */
    public function index()
    {
        $totalLaporan = Laporan::count();
        $awasCount = Laporan::where('tinggi_genangan', '>', 70)->count();
        $laporanTerbaru = Laporan::latest()->take(3)->get();

        return view('welcome', compact('totalLaporan', 'awasCount', 'laporanTerbaru'));
    }

    /**
     * Dashboard Operasional Petugas (Protected Auth)
     */
    public function dashboard()
    {
        $totalLaporan = Laporan::count();
        $awasCount = Laporan::where('tinggi_genangan', '>', 70)->count();
        $siagaCount = Laporan::whereBetween('tinggi_genangan', [30, 70])->count();
        $waspadaCount = Laporan::where('tinggi_genangan', '<', 30)->count();
        $petugasCount = User::count();
        $laporanTerbaru = Laporan::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalLaporan',
            'awasCount',
            'siagaCount',
            'waspadaCount',
            'petugasCount',
            'laporanTerbaru'
        ));
    }

    /**
     * Halaman Profil Petugas yang sedang login (Protected Auth)
     */
    public function profile()
    {
        return view('profile');
    }
}
