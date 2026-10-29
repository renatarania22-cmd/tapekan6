<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Daftarkan seluruh seeder proyek di sini sesuai ketentuan Modul 6.
     */
    public function run(): void
    {
        $this->call([
            PetugasSeeder::class,
            LaporanSeeder::class,
        ]);
    }
}
