<?php

namespace Database\Seeders;

use App\Models\Pesan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PesanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users to assign as recipients
        $users = User::all();
        $admin = User::where('role', 'admin')->first();

        if ($users->isEmpty()) {
            $this->command->error('No users found! Please run PenggunaSeeder first.');
            return;
        }

        // Create dummy messages with different types and statuses
        $messages = [
            // Surat Masuk (Incoming Letters)
            [
                'nomor_pesan' => 'SM/001/X/2025',
                'judul' => 'Permohonan Izin Kegiatan Ekstrakurikuler',
                'perihal' => 'Permohonan izin untuk mengadakan kegiatan ekstrakurikuler di sekolah',
                'kategori' => 'akademik',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(1),
                'pengirim' => 'Komite Sekolah',
                'id_penerima' => $users->where('divisi', 'akademik')->first()?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'pending',
                'instansi' => 'Komite Sekolah',
                'kontak_pengirim' => '081234567890',
                'alamat_pengirim' => 'Jl. Pendidikan No. 123, Banjarbaru',
            ],
            [
                'nomor_pesan' => 'SM/002/X/2025',
                'judul' => 'Undangan Rapat Orang Tua Siswa',
                'perihal' => 'Undangan menghadiri rapat koordinasi orang tua siswa',
                'kategori' => 'kesiswaan',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(2),
                'pengirim' => 'Paguyuban Orang Tua',
                'id_penerima' => $users->where('divisi', 'kesiswaan')->first()?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'disetujui',
                'instansi' => 'Paguyuban Orang Tua Siswa',
                'kontak_pengirim' => '081234567891',
                'alamat_pengirim' => 'Jl. Keluarga No. 456, Banjarbaru',
            ],
            [
                'nomor_pesan' => 'SM/003/X/2025',
                'judul' => 'Permohonan Bantuan Dana Operasional',
                'perihal' => 'Permohonan bantuan dana untuk operasional sekolah',
                'kategori' => 'keuangan',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(3),
                'pengirim' => 'Yayasan Pendidikan',
                'id_penerima' => $users->where('divisi', 'keuangan')->first()?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'pending',
                'instansi' => 'Yayasan Pendidikan Telkom',
                'kontak_pengirim' => '081234567892',
                'alamat_pengirim' => 'Jl. Yayasan No. 789, Banjarbaru',
            ],

            // Surat Keluar (Outgoing Letters)
            [
                'nomor_pesan' => 'SK/001/X/2025',
                'judul' => 'Surat Balasan Permohonan Izin',
                'perihal' => 'Balasan persetujuan izin kegiatan ekstrakurikuler',
                'kategori' => 'akademik',
                'tipe' => 'keluar',
                'tanggal_kirim' => Carbon::now()->subHours(6),
                'pengirim' => 'Telkom Schools Banjarbaru',
                'id_penerima' => $users->first()->id_pengguna,
                'status_pesan' => 'disetujui',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '0511-4123456',
                'alamat_pengirim' => 'Jl. Telkom Schools, Banjarbaru',
            ],
            [
                'nomor_pesan' => 'SK/002/X/2025',
                'judul' => 'Undangan Acara Wisuda',
                'perihal' => 'Undangan menghadiri acara wisuda siswa kelas 12',
                'kategori' => 'umum',
                'tipe' => 'keluar',
                'tanggal_kirim' => Carbon::now()->subDays(1),
                'pengirim' => 'Telkom Schools Banjarbaru',
                'id_penerima' => $users->first()->id_pengguna,
                'status_pesan' => 'diterima',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '0511-4123456',
                'alamat_pengirim' => 'Jl. Telkom Schools, Banjarbaru',
            ],

            // More letters with pending status
            [
                'nomor_pesan' => 'SM/004/X/2025',
                'judul' => 'Laporan Kerusakan Fasilitas',
                'perihal' => 'Laporan kerusakan fasilitas laboratorium komputer',
                'kategori' => 'sarpras',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(4),
                'pengirim' => 'Koordinator Lab',
                'id_penerima' => $users->where('divisi', 'sarpras')->first()?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'pending',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '081234567893',
                'alamat_pengirim' => 'Internal',
            ],
            [
                'nomor_pesan' => 'SM/005/X/2025',
                'judul' => 'Pengajuan Program Beasiswa',
                'perihal' => 'Pengajuan program beasiswa untuk siswa berprestasi',
                'kategori' => 'keuangan',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(5),
                'pengirim' => 'Wali Kelas XII-A',
                'id_penerima' => $users->where('divisi', 'keuangan')->first()?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'pending',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '081234567894',
                'alamat_pengirim' => 'Internal',
            ],
        ];

        foreach ($messages as $message) {
            Pesan::create($message);
        }

        $this->command->info('Dummy messages created successfully!');
        $this->command->info('Created:');
        $this->command->info('- ' . count(array_filter($messages, fn($m) => $m['tipe'] === 'masuk')) . ' Surat Masuk');
        $this->command->info('- ' . count(array_filter($messages, fn($m) => $m['tipe'] === 'keluar')) . ' Surat Keluar');
        $this->command->info('- ' . count(array_filter($messages, fn($m) => $m['status_pesan'] === 'pending')) . ' Surat Pending');
    }
}
