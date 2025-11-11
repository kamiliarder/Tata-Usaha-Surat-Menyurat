<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create dummy "Pengunjung" account for external recipients
        User::create([
            'nama' => 'Pengunjung',
            'email' => 'visitor@dummy.local',
            'password' => Hash::make('dummy_password_never_used'),
            'role' => 'guru',
            'nomor_telp' => '0000000000',
            'nip' => 0,
        ]);

        // 2. Create Admin account
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@sekolah.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nomor_telp' => '081234567890',
            'nip' => 1001,
        ]);

        // 3. Create sample teachers
        $teachers = [
            [
                'nama' => 'Guru Akademik',
                'email' => 'akademik@sekolah.id',
                'nip' => 2001,
            ],
            [
                'nama' => 'Guru Kesiswaan',
                'email' => 'kesiswaan@sekolah.id',
                'nip' => 2002,
            ],
            [
                'nama' => 'Guru Keuangan',
                'email' => 'keuangan@sekolah.id',
                'nip' => 2003,
            ],
            [
                'nama' => 'Guru Sarana Prasarana',
                'email' => 'sarpras@sekolah.id',
                'nip' => 2004,
            ],
            [
                'nama' => 'Guru Non Akademik',
                'email' => 'nonakademik@sekolah.id',
                'nip' => 2005,
            ],
            [
                'nama' => 'Guru Umum',
                'email' => 'umum@sekolah.id',
                'nip' => 2006,
            ],
        ];

        foreach ($teachers as $teacher) {
            User::create([
                'nama' => $teacher['nama'],
                'email' => $teacher['email'],
                'password' => Hash::make('guru123'),
                'role' => 'guru',
                'nomor_telp' => '0812345678' . substr($teacher['nip'], -2),
                'nip' => $teacher['nip'],
            ]);
        }
    }
}
