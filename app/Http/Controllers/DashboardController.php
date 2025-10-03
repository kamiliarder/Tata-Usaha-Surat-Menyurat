<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Get real data from database
        $data = [
            'suratMasuk' => Pesan::where('tipe', 'masuk')->count(),
            'suratKeluar' => Pesan::where('tipe', 'keluar')->count(),
            'suratProses' => Pesan::where('status_pesan', 'pending')->count(),
        ];

        // Get recent letters for the card (latest 5)
        $recentLetters = Pesan::orderBy('tanggal_kirim', 'desc')
                             ->limit(5)
                             ->get();

        $data['recentLetters'] = $recentLetters;

        // Get chart data - messages by month for current year
        $currentYear = date('Y');
        $chartDataMasuk = [];
        $chartDataKeluar = [];

        for ($month = 1; $month <= 12; $month++) {
            $masukCount = Pesan::where('tipe', 'masuk')
                             ->whereYear('tanggal_kirim', $currentYear)
                             ->whereMonth('tanggal_kirim', $month)
                             ->count();

            $keluarCount = Pesan::where('tipe', 'keluar')
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
