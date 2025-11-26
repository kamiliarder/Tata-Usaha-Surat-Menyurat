<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        
        // Buat base query yang akan difilter berdasarkan role
        // Kalau guru, filter berdasarkan id_penerima
        // Kalau admin, ambil semua data
        $baseQuery = Pesan::query();
        
        if ($user->role === 'guru') {
            // Guru cuma bisa lihat surat yang ditugaskan ke mereka
            $baseQuery->where('id_penerima', $user->id_pengguna);
        }
        // Kalau admin, nggak perlu filter tambahan (lihat semua surat)

        // Ambil data asli dari database dengan filter role
        $data = [
            'suratMasuk' => (clone $baseQuery)->where('tipe', 'masuk')->count(),
            'suratKeluar' => (clone $baseQuery)->where('tipe', 'keluar')->count(),
            'suratProses' => (clone $baseQuery)->where('status_pesan', 'pending')->count(),
        ];
        
        // Kalau guru, tambahin statistik yang lebih detail
        if ($user->role === 'guru') {
            $data['statistics'] = [
                'total_masuk' => (clone $baseQuery)->where('tipe', 'masuk')->count(),
                'total_keluar' => (clone $baseQuery)->where('tipe', 'keluar')->count(),
                'diterima' => (clone $baseQuery)->where('status_pesan', 'diterima')->count(),
                'dalam_proses' => (clone $baseQuery)->where('status_pesan', 'dalam_proses')->count(),
                'disetujui' => (clone $baseQuery)->where('status_pesan', 'disetujui')->count(),
                'ditolak' => (clone $baseQuery)->where('status_pesan', 'ditolak')->count(),
            ];
        }

        // Ambil surat-surat terbaru buat card (5 terakhir) dengan filter role
        $recentLetters = (clone $baseQuery)
                             ->orderBy('tanggal_kirim', 'desc')
                             ->limit(5)
                             ->get();

        $data['recentLetters'] = $recentLetters;

        // Ambil data chart - pesan per bulan untuk tahun ini dengan filter role
        $currentYear = date('Y');
        $chartDataMasuk = [];
        $chartDataKeluar = [];

        for ($month = 1; $month <= 12; $month++) {
            $masukCount = (clone $baseQuery)
                             ->where('tipe', 'masuk')
                             ->whereYear('tanggal_kirim', $currentYear)
                             ->whereMonth('tanggal_kirim', $month)
                             ->count();

            $keluarCount = (clone $baseQuery)
                              ->where('tipe', 'keluar')
                              ->whereYear('tanggal_kirim', $currentYear)
                              ->whereMonth('tanggal_kirim', $month)
                              ->count();

            $chartDataMasuk[] = $masukCount;
            $chartDataKeluar[] = $keluarCount;
        }

        $data['chartDataMasuk'] = $chartDataMasuk;
        $data['chartDataKeluar'] = $chartDataKeluar;

        return view('dashboard', $data);
    }
}
