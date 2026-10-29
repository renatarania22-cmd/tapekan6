<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;
use Faker\Factory as Faker;

class LaporanSeeder extends Seeder
{
    /**
     * Menghasilkan data dummy laporan genangan banjir di wilayah rawan Kab. Bandung
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kecamatanBandung = [
            'Dayeuhkolot - RW 01 Kp. Bojong Asih',
            'Baleendah - Kel. Andir Kp. Cieunteung',
            'Bojongsoang - Cijagra RW 09',
            'Rancaekek - Depan PT Kahatex Jl. Raya Bandung-Garut',
            'Majalaya - Kp. Pelangi RW 05',
            'Ciparay - Desa Sarimahi RW 02',
            'Katapang - Desa Cilampeni RT 03',
            'Margahayu - Kp. Bihbul Sayati',
            'Banjaran - Kp. Tarajusari',
            'Cicalengka - Babakan Peuteuy',
        ];

        // Seed 15 data laporan realistis
        for ($i = 0; $i < 15; $i++) {
            Laporan::create([
                'nama_pelapor'     => $faker->name(),
                'lokasi'           => $faker->randomElement($kecamatanBandung),
                'tinggi_genangan'  => $faker->numberBetween(15, 140),
                'tanggal_kejadian' => $faker->dateTimeBetween('-2 weeks', 'now')->format('Y-m-d'),
            ]);
        }
    }
}
