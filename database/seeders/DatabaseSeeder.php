<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Kamar;
use App\Models\Santri;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users (Admin, Ustadz/Pengurus, Santri)
        $admin = User::create([
            'name' => 'Administrator SIMPES',
            'email' => 'admin@simpes.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $ustadz1 = User::create([
            'name' => 'Ustadz Ahmad Fauqi',
            'email' => 'ustadz.ahmad@simpes.com',
            'password' => Hash::make('password'),
            'role' => 'pengurus',
        ]);

        $ustadz2 = User::create([
            'name' => 'Ustadz M. Basri',
            'email' => 'ustadz.basri@simpes.com',
            'password' => Hash::make('password'),
            'role' => 'pengurus',
        ]);

        $userSantri1 = User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'fauzi@simpes.com',
            'password' => Hash::make('password'),
            'role' => 'santri',
        ]);

        $userSantri2 = User::create([
            'name' => 'Siti Aisyah',
            'email' => 'aisyah@simpes.com',
            'password' => Hash::make('password'),
            'role' => 'santri',
        ]);

        // 2. Seed Kelas / Marhalah
        $kelasUla = Kelas::create([
            'nama_kelas' => 'Marhalah Ula 1',
            'tingkat' => 'Ula',
            'wali_kelas_id' => $ustadz1->id,
        ]);

        $kelasWustha = Kelas::create([
            'nama_kelas' => 'Marhalah Wustha 1',
            'tingkat' => 'Wustha',
            'wali_kelas_id' => $ustadz2->id,
        ]);

        // 3. Seed Kamar
        $kamarAbuBakar = Kamar::create([
            'nama_kamar' => 'Kamar Abu Bakar',
            'gedung' => 'Asrama Putra Blok A',
            'kapasitas' => 10,
        ]);

        $kamarAisyah = Kamar::create([
            'nama_kamar' => 'Kamar Aisyah 1',
            'gedung' => 'Asrama Putri Blok B',
            'kapasitas' => 8,
        ]);

        // 4. Seed Santri Profiles
        $santri1 = Santri::create([
            'user_id' => $userSantri1->id,
            'nis' => '20260001',
            'nama_lengkap' => 'Ahmad Fauzi',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2010-05-15',
            'alamat' => 'Jl. Merdeka No. 12, Depok',
            'nama_ortu_wali' => 'Budi Fauzi',
            'no_hp_wali' => '081234567890',
            'kelas_id' => $kelasUla->id,
            'kamar_id' => $kamarAbuBakar->id,
            'status' => 'aktif',
            'tanggal_masuk' => '2026-01-01',
        ]);

        $santri2 = Santri::create([
            'user_id' => $userSantri2->id,
            'nis' => '20260002',
            'nama_lengkap' => 'Siti Aisyah',
            'jenis_kelamin' => 'P',
            'tempat_lahir' => 'Bogor',
            'tanggal_lahir' => '2011-08-20',
            'alamat' => 'Perumahan Pakuan No. 5, Bogor',
            'nama_ortu_wali' => 'Rahmat Hidayat',
            'no_hp_wali' => '089876543210',
            'kelas_id' => $kelasUla->id,
            'kamar_id' => $kamarAisyah->id,
            'status' => 'aktif',
            'tanggal_masuk' => '2026-01-10',
        ]);

        $santri3 = Santri::create([
            'user_id' => null, // Wali/Santri tidak memiliki akun login
            'nis' => '20260003',
            'nama_lengkap' => 'Zainal Abidin',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2009-02-10',
            'alamat' => 'Jl. Dago No. 101, Bandung',
            'nama_ortu_wali' => 'Hasan Abidin',
            'no_hp_wali' => '085554433220',
            'kelas_id' => $kelasWustha->id,
            'kamar_id' => $kamarAbuBakar->id,
            'status' => 'aktif',
            'tanggal_masuk' => '2026-02-01',
        ]);

        // 5. Seed Pembayaran (SPP/Syahriah)
        // Santri 1: Lunas Jan-Apr, Belum Lunas Mei-Jun
        $months = [
            1 => 'lunas',
            2 => 'lunas',
            3 => 'lunas',
            4 => 'lunas',
            5 => 'belum_lunas',
            6 => 'belum_lunas'
        ];

        foreach ($months as $month => $status) {
            Pembayaran::create([
                'santri_id' => $santri1->id,
                'bulan' => $month,
                'tahun' => 2026,
                'jumlah_tagihan' => 250000.00,
                'jumlah_bayar' => $status === 'lunas' ? 250000.00 : 0.00,
                'tanggal_bayar' => $status === 'lunas' ? "2026-0{$month}-05 10:00:00" : null,
                'status' => $status,
                'keterangan' => $status === 'lunas' ? 'Dibayar via Transfer Bank' : null,
            ]);
        }

        // Santri 2: Lunas Jan-Mar, Belum Lunas Apr-Jun
        $months2 = [
            1 => 'lunas',
            2 => 'lunas',
            3 => 'lunas',
            4 => 'belum_lunas',
            5 => 'belum_lunas',
            6 => 'belum_lunas'
        ];

        foreach ($months2 as $month => $status) {
            Pembayaran::create([
                'santri_id' => $santri2->id,
                'bulan' => $month,
                'tahun' => 2026,
                'jumlah_tagihan' => 250000.00,
                'jumlah_bayar' => $status === 'lunas' ? 250000.00 : 0.00,
                'tanggal_bayar' => $status === 'lunas' ? "2026-0{$month}-10 14:30:00" : null,
                'status' => $status,
                'keterangan' => $status === 'lunas' ? 'Dibayar Tunai ke Pengurus' : null,
            ]);
        }
    }
}
