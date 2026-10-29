<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PetugasSeeder extends Seeder
{
    /**
     * Menghasilkan akun petugas dummy dan akun admin BPBD sesuai ketentuan Modul 6:
     * - Minimal 5 akun dummy petugas BPBD menggunakan Faker locale id_ID.
     * - 1 akun administrator BPBD dengan kredensial tetap untuk pengujian.
     * - Seluruh password wajib di-hash menggunakan Hash::make() / Bcrypt.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Akun Admin BPBD Tetap
        DB::table('users')->updateOrInsert(
            ['email' => 'pusdalops@bpbd-kabbandung.go.id'],
            [
                'name'              => 'Admin Pusdalops BPBD',
                'password'          => Hash::make('pusdalops123'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]
        );

        // 2. Akun Dummy Petugas Lapangan (5 Petugas dengan Faker Indonesia)
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'name'              => $faker->name(),
                'email'             => $faker->unique()->safeEmail(),
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at'        => now()->subDays(rand(1, 60)),
                'updated_at'        => now(),
            ]);
        }
    }
}
