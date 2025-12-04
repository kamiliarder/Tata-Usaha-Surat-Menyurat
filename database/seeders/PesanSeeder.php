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
        $guruAkademik = User::where('email', 'akademik@sekolah.id')->first();
        $guruKesiswaan = User::where('email', 'kesiswaan@sekolah.id')->first();
        $guruKeuangan = User::where('email', 'keuangan@sekolah.id')->first();
        $guruSarpras = User::where('email', 'sarpras@sekolah.id')->first();
        $guruNonAkademik = User::where('email', 'nonakademik@sekolah.id')->first();
        $guruUmum = User::where('email', 'umum@sekolah.id')->first();

        if ($users->isEmpty()) {
            $this->command->error('No users found! Please run PenggunaSeeder first.');
            return;
        }

        // Create 15 diverse letters with various categories, types, and statuses
        $messages = [
            // === SURAT MASUK (Incoming Letters) ===

            // 1. Akademik - Pending
            [
                'nomor_pesan' => 'SM/001/XII/2025',
                'judul' => 'Permohonan Izin Kegiatan Ekstrakurikuler Robotika',
                'perihal' => 'Permohonan izin untuk mengadakan kegiatan ekstrakurikuler robotika dan kompetisi tingkat nasional',
                'kategori' => 'akademik',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(1),
                'pengirim' => 'Komite Sekolah',
                'id_penerima' => $guruAkademik?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'pending',
                'instansi' => 'Komite Sekolah',
                'kontak_pengirim' => '081234567890',
                'alamat_pengirim' => 'Jl. Pendidikan No. 123, Banjarbaru',
            ],

            // 2. Kesiswaan - Disetujui
            [
                'nomor_pesan' => 'SM/002/XII/2025',
                'judul' => 'Undangan Rapat Koordinasi Orang Tua Siswa',
                'perihal' => 'Undangan menghadiri rapat koordinasi orang tua siswa membahas kegiatan akhir semester',
                'kategori' => 'kesiswaan',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(2),
                'pengirim' => 'Paguyuban Orang Tua',
                'id_penerima' => $guruKesiswaan?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'disetujui',
                'instansi' => 'Paguyuban Orang Tua Siswa',
                'kontak_pengirim' => '081234567891',
                'alamat_pengirim' => 'Jl. Keluarga No. 456, Banjarbaru',
            ],

            // 3. Keuangan - Dalam Proses
            [
                'nomor_pesan' => 'SM/003/XII/2025',
                'judul' => 'Permohonan Bantuan Dana Operasional Sekolah',
                'perihal' => 'Permohonan bantuan dana untuk operasional sekolah semester genap tahun ajaran 2025/2026',
                'kategori' => 'keuangan',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(3),
                'pengirim' => 'Yayasan Pendidikan Telkom',
                'id_penerima' => $guruKeuangan?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'dalam_proses',
                'instansi' => 'Yayasan Pendidikan Telkom',
                'kontak_pengirim' => '081234567892',
                'alamat_pengirim' => 'Jl. Yayasan No. 789, Banjarbaru',
            ],

            // 4. Sarpras - Pending
            [
                'nomor_pesan' => 'SM/004/XII/2025',
                'judul' => 'Laporan Kerusakan Fasilitas Laboratorium',
                'perihal' => 'Laporan kerusakan fasilitas laboratorium komputer ruang 301 dan permintaan perbaikan segera',
                'kategori' => 'sarpras',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(4),
                'pengirim' => 'Koordinator Laboratorium',
                'id_penerima' => $guruSarpras?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'pending',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '081234567893',
                'alamat_pengirim' => 'Internal',
            ],

            // 5. Keuangan - Perlu Perbaikan
            [
                'nomor_pesan' => 'SM/005/XII/2025',
                'judul' => 'Pengajuan Program Beasiswa Prestasi',
                'perihal' => 'Pengajuan program beasiswa untuk siswa berprestasi akademik dan non-akademik',
                'kategori' => 'keuangan',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(5),
                'pengirim' => 'Wali Kelas XII-A',
                'id_penerima' => $guruKeuangan?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'perlu_perbaikan',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '081234567894',
                'alamat_pengirim' => 'Internal',
            ],

            // 6. Non Akademik - Diterima
            [
                'nomor_pesan' => 'SM/006/XII/2025',
                'judul' => 'Permohonan Izin Kegiatan Bakti Sosial',
                'perihal' => 'Permohonan izin untuk mengadakan kegiatan bakti sosial di panti asuhan',
                'kategori' => 'non_akademik',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(6),
                'pengirim' => 'OSIS Telkom Schools',
                'id_penerima' => $guruNonAkademik?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'diterima',
                'instansi' => 'OSIS Telkom Schools Banjarbaru',
                'kontak_pengirim' => '081234567895',
                'alamat_pengirim' => 'Internal',
            ],

            // 7. Umum - Ditolak
            [
                'nomor_pesan' => 'SM/007/XII/2025',
                'judul' => 'Permohonan Peminjaman Aula Sekolah',
                'perihal' => 'Permohonan peminjaman aula sekolah untuk acara pernikahan pada hari libur',
                'kategori' => 'umum',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(7),
                'pengirim' => 'Alumni Angkatan 2020',
                'id_penerima' => $guruUmum?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'ditolak',
                'instansi' => 'Alumni Telkom Schools',
                'kontak_pengirim' => '081234567896',
                'alamat_pengirim' => 'Jl. Alumni No. 321, Banjarmasin',
            ],

            // 8. Akademik - Disetujui
            [
                'nomor_pesan' => 'SM/008/XII/2025',
                'judul' => 'Undangan Seminar Nasional Pendidikan',
                'perihal' => 'Undangan untuk menghadiri seminar nasional pendidikan digital di era AI',
                'kategori' => 'akademik',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(8),
                'pengirim' => 'Universitas Lambung Mangkurat',
                'id_penerima' => $guruAkademik?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'disetujui',
                'instansi' => 'Universitas Lambung Mangkurat',
                'kontak_pengirim' => '0511-3305000',
                'alamat_pengirim' => 'Jl. Brigjen H. Hasan Basry, Banjarmasin',
            ],

            // 9. Kesiswaan - Dalam Proses
            [
                'nomor_pesan' => 'SM/009/XII/2025',
                'judul' => 'Laporan Pelanggaran Tata Tertib Siswa',
                'perihal' => 'Laporan pelanggaran tata tertib siswa kelas XI-B dan permintaan tindak lanjut',
                'kategori' => 'kesiswaan',
                'tipe' => 'masuk',
                'tanggal_kirim' => Carbon::now()->subDays(9),
                'pengirim' => 'Guru BK',
                'id_penerima' => $guruKesiswaan?->id_pengguna ?? $admin->id_pengguna,
                'status_pesan' => 'dalam_proses',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '081234567897',
                'alamat_pengirim' => 'Internal',
            ],

            // === SURAT KELUAR (Outgoing Letters) ===

            // 10. Akademik - Disetujui
            [
                'nomor_pesan' => 'SK/001/XII/2025',
                'judul' => 'Surat Balasan Permohonan Izin Ekstrakurikuler',
                'perihal' => 'Balasan persetujuan izin kegiatan ekstrakurikuler robotika',
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

            // 11. Umum - Diterima
            [
                'nomor_pesan' => 'SK/002/XII/2025',
                'judul' => 'Undangan Acara Wisuda Siswa Kelas XII',
                'perihal' => 'Undangan menghadiri acara wisuda siswa kelas 12 tahun ajaran 2024/2025',
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

            // 12. Keuangan - Pending
            [
                'nomor_pesan' => 'SK/003/XII/2025',
                'judul' => 'Pemberitahuan Pembayaran SPP Semester Genap',
                'perihal' => 'Pemberitahuan jadwal dan tata cara pembayaran SPP semester genap 2025/2026',
                'kategori' => 'keuangan',
                'tipe' => 'keluar',
                'tanggal_kirim' => Carbon::now()->subDays(2),
                'pengirim' => 'Telkom Schools Banjarbaru',
                'id_penerima' => $users->skip(1)->first()->id_pengguna,
                'status_pesan' => 'pending',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '0511-4123456',
                'alamat_pengirim' => 'Jl. Telkom Schools, Banjarbaru',
            ],

            // 13. Sarpras - Disetujui
            [
                'nomor_pesan' => 'SK/004/XII/2025',
                'judul' => 'Surat Permohonan Pengadaan Komputer Baru',
                'perihal' => 'Permohonan pengadaan 30 unit komputer untuk laboratorium komputer',
                'kategori' => 'sarpras',
                'tipe' => 'keluar',
                'tanggal_kirim' => Carbon::now()->subDays(3),
                'pengirim' => 'Telkom Schools Banjarbaru',
                'id_penerima' => $users->skip(2)->first()->id_pengguna,
                'status_pesan' => 'disetujui',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '0511-4123456',
                'alamat_pengirim' => 'Jl. Telkom Schools, Banjarbaru',
            ],

            // 14. Kesiswaan - Diterima
            [
                'nomor_pesan' => 'SK/005/XII/2025',
                'judul' => 'Surat Undangan Pelatihan Kepemimpinan OSIS',
                'perihal' => 'Undangan pelatihan kepemimpinan untuk pengurus OSIS periode 2025/2026',
                'kategori' => 'kesiswaan',
                'tipe' => 'keluar',
                'tanggal_kirim' => Carbon::now()->subDays(4),
                'pengirim' => 'Telkom Schools Banjarbaru',
                'id_penerima' => $users->skip(3)->first()->id_pengguna,
                'status_pesan' => 'diterima',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '0511-4123456',
                'alamat_pengirim' => 'Jl. Telkom Schools, Banjarbaru',
            ],

            // 15. Non Akademik - Disetujui
            [
                'nomor_pesan' => 'SK/006/XII/2025',
                'judul' => 'Surat Kerjasama Kegiatan Olahraga Antar Sekolah',
                'perihal' => 'Surat kerjasama untuk mengadakan turnamen olahraga antar sekolah se-Kalimantan Selatan',
                'kategori' => 'non_akademik',
                'tipe' => 'keluar',
                'tanggal_kirim' => Carbon::now()->subDays(5),
                'pengirim' => 'Telkom Schools Banjarbaru',
                'id_penerima' => $users->skip(4)->first()->id_pengguna,
                'status_pesan' => 'disetujui',
                'instansi' => 'Telkom Schools Banjarbaru',
                'kontak_pengirim' => '0511-4123456',
                'alamat_pengirim' => 'Jl. Telkom Schools, Banjarbaru',
            ],
        ];

        foreach ($messages as $message) {
            Pesan::create($message);
        }

        $this->command->info('✓ Successfully created 15 diverse letters!');
        $this->command->info('');
        $this->command->info('Summary:');
        $this->command->info('- ' . count(array_filter($messages, fn($m) => $m['tipe'] === 'masuk')) . ' Surat Masuk (Incoming)');
        $this->command->info('- ' . count(array_filter($messages, fn($m) => $m['tipe'] === 'keluar')) . ' Surat Keluar (Outgoing)');
        $this->command->info('');
        $this->command->info('Status breakdown:');
        $this->command->info('- Pending: ' . count(array_filter($messages, fn($m) => $m['status_pesan'] === 'pending')));
        $this->command->info('- Diterima: ' . count(array_filter($messages, fn($m) => $m['status_pesan'] === 'diterima')));
        $this->command->info('- Dalam Proses: ' . count(array_filter($messages, fn($m) => $m['status_pesan'] === 'dalam_proses')));
        $this->command->info('- Perlu Perbaikan: ' . count(array_filter($messages, fn($m) => $m['status_pesan'] === 'perlu_perbaikan')));
        $this->command->info('- Disetujui: ' . count(array_filter($messages, fn($m) => $m['status_pesan'] === 'disetujui')));
        $this->command->info('- Ditolak: ' . count(array_filter($messages, fn($m) => $m['status_pesan'] === 'ditolak')));
        $this->command->info('');
        $this->command->info('Category breakdown:');
        $this->command->info('- Akademik: ' . count(array_filter($messages, fn($m) => $m['kategori'] === 'akademik')));
        $this->command->info('- Kesiswaan: ' . count(array_filter($messages, fn($m) => $m['kategori'] === 'kesiswaan')));
        $this->command->info('- Keuangan: ' . count(array_filter($messages, fn($m) => $m['kategori'] === 'keuangan')));
        $this->command->info('- Sarpras: ' . count(array_filter($messages, fn($m) => $m['kategori'] === 'sarpras')));
        $this->command->info('- Non Akademik: ' . count(array_filter($messages, fn($m) => $m['kategori'] === 'non_akademik')));
        $this->command->info('- Umum: ' . count(array_filter($messages, fn($m) => $m['kategori'] === 'umum')));
    }
}
