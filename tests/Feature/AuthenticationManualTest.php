<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Laporan;
use Database\Seeders\PetugasSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationManualTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 1. Uji halaman form lapor banjir publik dapat dibuka oleh warga tanpa login.
     */
    public function test_form_lapor_banjir_bisa_diakses_tanpa_login(): void
    {
        $response = $this->get('/banjir/form');

        $response->assertStatus(200);
        $response->assertSee('Formulir Laporan Kejadian Genangan');
    }

    /**
     * 2. Uji pengiriman formulir laporan banjir dari warga tersimpan tanpa login.
     */
    public function test_warga_dapat_mengirim_laporan_banjir_tanpa_login(): void
    {
        $payload = [
            'nama_pelapor'     => 'Ahmad Dahlan',
            'lokasi'           => 'Dayeuhkolot - RW 01',
            'tinggi_genangan'  => 65,
            'tanggal_kejadian' => '2026-10-29',
        ];

        $response = $this->post('/banjir/store', $payload);

        $response->assertStatus(200);
        $response->assertSee('Laporan Berhasil Terkirim');
        $this->assertDatabaseHas('laporan', [
            'nama_pelapor'    => 'Ahmad Dahlan',
            'tinggi_genangan' => 65,
        ]);
    }

    /**
     * 3. Uji proteksi middleware auth: Mengakses daftar laporan, dashboard, profil sebelum login
     *    wajib dialihkan (redirect) ke halaman login.
     */
    public function test_halaman_terproteksi_redirect_ke_login_jika_belum_autentikasi(): void
    {
        $this->get('/banjir')->assertRedirect('/login');
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/profile')->assertRedirect('/login');
    }

    /**
     * 4. Uji registrasi manual petugas: data tersimpan dan password ter-hash.
     */
    public function test_registrasi_manual_petugas_berhasil_dan_password_terhash(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'Rian Hidayat',
            'email'                 => 'rian.bpbd@bandung.go.id',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();

        $user = User::where('email', 'rian.bpbd@bandung.go.id')->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /**
     * 5. Uji proses login manual petugas dengan kredensial benar.
     */
    public function test_petugas_dapat_login_dengan_kredensial_valid(): void
    {
        $user = User::create([
            'name'     => 'Petugas Hendra',
            'email'    => 'hendra@bpbd.go.id',
            'password' => Hash::make('rahasia123'),
        ]);

        $response = $this->post('/login', [
            'email'    => 'hendra@bpbd.go.id',
            'password' => 'rahasia123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * 6. Uji proses login manual gagal jika password salah.
     */
    public function test_login_petugas_gagal_jika_password_salah(): void
    {
        User::create([
            'name'     => 'Petugas Hendra',
            'email'    => 'hendra@bpbd.go.id',
            'password' => Hash::make('rahasia123'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email'    => 'hendra@bpbd.go.id',
            'password' => 'passwordsalah',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * 7. Uji petugas yang telah login dapat mengakses halaman terproteksi.
     */
    public function test_petugas_terautentikasi_dapat_mengakses_halaman_terproteksi(): void
    {
        $user = User::create([
            'name'     => 'Petugas Sigap',
            'email'    => 'sigap@bpbd.go.id',
            'password' => Hash::make('password123'),
        ]);

        Laporan::create([
            'nama_pelapor'     => 'Warga Bojongsoang',
            'lokasi'           => 'Bojongsoang RW 05',
            'tinggi_genangan'  => 80,
            'tanggal_kejadian' => '2026-10-29',
        ]);

        $this->actingAs($user)->get('/dashboard')->assertStatus(200)->assertSee('Dashboard Operasional Banjir');
        $this->actingAs($user)->get('/profile')->assertStatus(200)->assertSee('Petugas Sigap');
        $this->actingAs($user)->get('/banjir')->assertStatus(200)->assertSee('Bojongsoang RW 05');
    }

    /**
     * 8. Uji proses logout petugas secara manual (method POST).
     */
    public function test_petugas_dapat_logout(): void
    {
        $user = User::create([
            'name'     => 'Petugas Siaga',
            'email'    => 'siaga@bpbd.go.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    /**
     * 9. Uji PetugasSeeder menghasilkan 1 admin BPBD dan minimal 5 dummy petugas ber-hash Bcrypt.
     */
    public function test_petugas_seeder_berjalan_sesuai_spesifikasi_modul(): void
    {
        $this->seed(PetugasSeeder::class);

        // Cek Admin BPBD
        $admin = User::where('email', 'pusdalops@bpbd-kabbandung.go.id')->first();
        $this->assertNotNull($admin);
        $this->assertTrue(Hash::check('pusdalops123', $admin->password));

        // Cek minimal 5 akun dummy petugas (total >= 6 dengan admin)
        $this->assertGreaterThanOrEqual(6, User::count());
    }
}
