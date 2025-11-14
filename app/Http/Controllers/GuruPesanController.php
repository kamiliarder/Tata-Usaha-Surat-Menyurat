<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        // Note: Division-based filtering has been removed as the divisi field no longer exists

        // Debug: Check what ID is being used
        Log::info('GuruPesanController - User Details:', [
            'id_pengguna' => $user->id_pengguna,
            'name' => $user->nama,
            'role' => $user->role
        ]);

        $query = Pesan::with(['penerima', 'lampiran'])
            ->where('id_penerima', $user->id_pengguna); // Specifically assigned to them

        // Debug: Log the SQL query
        Log::info('GuruPesanController - SQL Query:', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

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

        $letters = $query->orderBy('tanggal_kirim', 'desc')->paginate(15);

        return view('pesan.index', compact('letters'));
    }

    /**
     * Show specific message details.
     */
    public function show($id, Request $request)
    {
        $user = Auth::user();

        // Check if teacher has permission to view this message
        // Note: Division-based filtering has been removed as the divisi field no longer exists
        $pesan = Pesan::with(['penerima', 'lampiran', 'pesanTerkait', 'balasan'])
            ->where('id_penerima', $user->id_pengguna) // Specifically assigned to them
            ->findOrFail($id);

        // Auto-update status from 'pending' to 'diterima' when teacher views the message
        if ($pesan->status_pesan === 'pending') {
            $pesan->update(['status_pesan' => 'diterima']);

            // Refresh the model to get the updated status
            $pesan->refresh();
        }

        // If it's an AJAX request, return JSON
        if ($request->expectsJson()) {
            return response()->json($pesan);
        }

        return view('pesan.show', compact('pesan'));
    }

    /**
     * Update message status (limited permissions for teachers).
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Check if teacher has permission to update this message
        // Note: Division-based filtering has been removed as the divisi field no longer exists
        $pesan = Pesan::where('id_penerima', $user->id_pengguna) // Specifically assigned to them
            ->findOrFail($id);

        $validated = $request->validate([
            'status_pesan' => 'required|in:dalam_proses,perlu_perbaikan,disetujui,ditolak',
        ]);

        $pesan->update($validated);

        return redirect()->route('pesan.show', $pesan->id_pesan)
            ->with('success', 'Status pesan berhasil diperbarui.');
    }

    /**
     * Show statistics for teacher dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Note: Division-based filtering has been removed as the divisi field no longer exists
        $baseQuery = Pesan::where('id_penerima', $user->id_pengguna);

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

        return view('dashboard', compact('statistics', 'recentMessages'));
    }
}
