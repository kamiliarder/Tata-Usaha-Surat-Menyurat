<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get recent letters for public display (limit 5-6 letters)
        $recentLetters = Pesan::with(['lampiran'])
            ->select(['id_pesan', 'nomor_pesan', 'judul', 'kategori', 'tipe', 'tanggal_kirim', 'status_pesan'])
            ->orderBy('tanggal_kirim', 'desc')
            ->limit(6)
            ->get();

        return view('welcome', compact('recentLetters'));
    }
}
