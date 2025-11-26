<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GuruPesanController extends Controller
{
    /**
     * Tampilkan dashboard guru dengan pesan-pesan yang sudah difilter.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Guru bisa lihat pesan yang ditugaskan khusus ke mereka (id_penerima cocok dengan id mereka)

        // Debug: Cek ID mana yang lagi dipake
        Log::info('GuruPesanController - User Details:', [
            'id_pengguna' => $user->id_pengguna,
            'name' => $user->nama,
            'role' => $user->role
        ]);

        $query = Pesan::with(['penerima', 'lampiran'])
            ->where('id_penerima', $user->id_pengguna); // Surat dengan id_penerima yang cocok dengan id pengguna guru

        // Debug: Catat query SQL-nya
        Log::info('GuruPesanController - SQL Query:', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        // Filter berdasarkan tipe
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status_pesan', $request->status);
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('pengirim', 'like', "%{$search}%")
                  ->orWhere('nomor_pesan', 'like', "%{$search}%");
            });
        }

        // Urutkan pesan berdasarkan tanggal kirim dan paginasi
        $letters = $query->orderBy('tanggal_kirim', 'desc')->paginate(15);

        return view('pesan.index', compact('letters'));
    }

    /**
     * Tampilkan detail pesan tertentu.
     */
    public function show($id, Request $request)
    {
        $user = Auth::user();

        // Cek apakah guru punya izin untuk lihat pesan ini
        $pesan = Pesan::with(['penerima', 'lampiran', 'pesanTerkait', 'balasan'])
            ->where('id_penerima', $user->id_pengguna)
            ->findOrFail($id);

        // Otomatis update status dari 'pending' ke 'diterima' ketika guru buka pesannya
        if ($pesan->status_pesan === 'pending') {
            $pesan->update(['status_pesan' => 'diterima']);

            // Refresh model buat dapetin status yang udah diupdate
            $pesan->refresh();
        }

        // Kalau ini request AJAX, kembalikan dalam format JSON
        if ($request->expectsJson()) {
            return response()->json($pesan);
        }

        return view('pesan.show', compact('pesan'));
    }

    /**
     * Update status pesan (izin terbatas untuk guru).
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Cek apakah guru punya izin untuk update pesan ini
        $pesan = Pesan::where('id_penerima', $user->id_pengguna)
            ->findOrFail($id);

        $validated = $request->validate([
            'status_pesan' => 'required|in:dalam_proses,perlu_perbaikan,disetujui,ditolak',
        ]);

        $pesan->update($validated);

        return redirect()->route('pesan.show', $pesan->id_pesan)
            ->with('success', 'Status pesan berhasil diperbarui.');
    }

    /**
     * Tampilkan statistik untuk dashboard guru.
     */
    public function dashboard()
    {
        $user = Auth::user();


        $baseQuery = Pesan::where('id_penerima', $user->id_pengguna);

        $statistics = [
            'total_masuk' => (clone $baseQuery)->where('tipe', 'masuk')->count(),
            'total_keluar' => (clone $baseQuery)->where('tipe', 'keluar')->count(),
            'diterima' => (clone $baseQuery)->where('status_pesan', 'diterima')->count(),
            'dalam_proses' => (clone $baseQuery)->where('status_pesan', 'dalam_proses')->count(),
            'disetujui' => (clone $baseQuery)->where('status_pesan', 'disetujui')->count(),
            'ditolak' => (clone $baseQuery)->where('status_pesan', 'ditolak')->count(),
        ];

        // Pesan-pesan terbaru yang ditugaskan khusus ke guru ini
        $recentMessages = Pesan::with(['penerima', 'lampiran'])
            ->where('id_penerima', $user->id_pengguna)
            ->orderBy('tanggal_kirim', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('statistics', 'recentMessages'));
    }
}