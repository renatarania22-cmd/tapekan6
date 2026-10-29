<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Nama tabel di basis data adalah 'laporan' (sesuai Modul 4 & Modul 6)
    protected $table = 'laporan';

    protected $fillable = [
        'nama_pelapor',
        'lokasi',
        'tinggi_genangan',
        'tanggal_kejadian',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
        'tinggi_genangan' => 'integer',
    ];

    /**
     * Kategori Status Berdasarkan Ketinggian Genangan Air (Modul 4 & 6):
     * < 30 cm       : Waspada
     * 30 cm - 70 cm : Siaga
     * > 70 cm       : Awas
     */
    public function getStatusAttribute(): string
    {
        if ($this->tinggi_genangan < 30) {
            return 'Waspada';
        } elseif ($this->tinggi_genangan <= 70) {
            return 'Siaga';
        } else {
            return 'Awas';
        }
    }

    /**
     * Badge CSS class Bootstrap 5
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Waspada' => 'bg-info text-dark',
            'Siaga'   => 'bg-warning text-dark',
            'Awas'    => 'bg-danger text-white',
            default   => 'bg-secondary',
        };
    }
}
