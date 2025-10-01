<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruPesanController extends Controller
{
    /**
     * Display teacher dashboard with filtered messages.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Teachers can see messages where:
        // 1. They are specifically assigned (id_penerima matches their id)
        // 2. Message category matches their division (team transparency)
        $query = Pesan::with(['penerima', 'lampiran'])
            ->where(function($q) use ($user) {
                $q->where('id_penerima', $user->id_pengguna) // Specifically assigned to them
                  ->orWhere('kategori', $user->divisi); // Division-wide messages
            });

        // Filter by type
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status_pesan', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('pengirim', 'like', "%{$search}%")
                  ->orWhere('nomor_pesan', 'like', "%{$search}%");
            });
        }

        $pesanList = $query->orderBy('tanggal_kirim', 'desc')->paginate(15);

        return view('guru.pesan.index', compact('pesanList'));
    }

    /**
     * Show specific message details.
     */
    public function show($id)
    {
        $user = Auth::user();

        // Check if teacher has permission to view this message
        $pesan = Pesan::with(['penerima', 'lampiran', 'pesanTerkait', 'balasan'])
            ->where(function($q) use ($user) {
                $q->where('id_penerima', $user->id_pengguna) // Specifically assigned to them
                  ->orWhere('kategori', $user->divisi); // Division-wide messages
            })
            ->findOrFail($id);

        return view('guru.pesan.show', compact('pesan'));
    }

    /**
     * Update message status (limited permissions for teachers).
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Check if teacher has permission to update this message
        $pesan = Pesan::where(function($q) use ($user) {
                $q->where('id_penerima', $user->id_pengguna) // Specifically assigned to them
                  ->orWhere('kategori', $user->divisi); // Division-wide messages
            })
            ->findOrFail($id);

        $validated = $request->validate([
            'status_pesan' => 'required|in:dalam_proses,perlu_perbaikan,disetujui,ditolak',
        ]);

        $pesan->update($validated);

        return redirect()->route('guru.pesan.show', $pesan->id_pesan)
            ->with('success', 'Status pesan berhasil diperbarui.');
    }

    /**
     * Show statistics for teacher dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

        $baseQuery = Pesan::where(function($q) use ($user) {
            $q->where('id_penerima', $user->id_pengguna)
              ->orWhere('kategori', $user->divisi);
        });

        $statistics = [
            'total_masuk' => (clone $baseQuery)->where('tipe', 'masuk')->count(),
            'total_keluar' => (clone $baseQuery)->where('tipe', 'keluar')->count(),
            'diterima' => (clone $baseQuery)->where('status_pesan', 'diterima')->count(),
            'dalam_proses' => (clone $baseQuery)->where('status_pesan', 'dalam_proses')->count(),
            'disetujui' => (clone $baseQuery)->where('status_pesan', 'disetujui')->count(),
            'ditolak' => (clone $baseQuery)->where('status_pesan', 'ditolak')->count(),
        ];

        // Recent messages assigned specifically to this teacher
        $recentMessages = Pesan::with(['penerima', 'lampiran'])
            ->where('id_penerima', $user->id_pengguna)
            ->orderBy('tanggal_kirim', 'desc')
            ->limit(5)
            ->get();

        return view('guru.dashboard', compact('statistics', 'recentMessages'));
    }
}
