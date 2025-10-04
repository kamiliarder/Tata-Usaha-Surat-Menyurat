<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\User;
use App\Models\Lampiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPesanController extends Controller
{
    /**
     * Display admin dashboard with all messages.
     */
    public function index(Request $request)
    {
        $query = Pesan::with(['penerima', 'lampiran']);

        // Filter by type
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status_pesan', $request->status);
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
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

        return view('admin.pesan.index', compact('letters'));
    }

    /**
     * Show form to create new outgoing letter.
     */
    public function create()
    {
        // Get all staff members for recipient selection
        $staffMembers = User::where('email', '!=', 'visitor@dummy.local')
            ->orderBy('nama')
            ->get();

        return view('admin.pesan.create', compact('staffMembers'));
    }

    /**
     * Store new outgoing letter.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'perihal' => 'nullable|string',
            'kategori' => 'required|in:akademik,kesiswaan,keuangan,sarpras,non_akademik,umum',
            'pengirim' => 'required|string|max:200',
            'penerima' => 'required|string|max:200',
            'instansi' => 'nullable|string|max:50',
            'kontak_penerima' => 'nullable|string|max:20',
            'alamat_penerima' => 'nullable|string',
            'lampiran.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,gif',
        ]);

        // Get dummy visitor account for outgoing messages
        $dummyAccount = User::where('email', 'visitor@dummy.local')->first();

        // Generate unique message number
        $nomorPesan = Pesan::generateNomorPesan();

        // Create outgoing letter
        $pesan = Pesan::create([
            'nomor_pesan' => $nomorPesan,
            'judul' => $validated['judul'],
            'perihal' => $validated['perihal'],
            'kategori' => $validated['kategori'],
            'tipe' => 'keluar',
            'tanggal_kirim' => now(),
            'pengirim' => $validated['pengirim'],
            'id_penerima' => $dummyAccount->id_pengguna, // Dummy account for external recipient
            'status_pesan' => 'diterima', // Outgoing letters start as "received"
            'instansi' => $validated['instansi'],
            'kontak_pengirim' => $validated['kontak_penerima'], // Store recipient contact
            'alamat_pengirim' => $validated['alamat_penerima'], // Store recipient address
        ]);

        // Handle file uploads
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $originalName = $file->getClientOriginalName();
                $fileName = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('lampiran', $fileName, 'public');

                Lampiran::create([
                    'id_pesan' => $pesan->id_pesan,
                    'nama_file' => $originalName,
                    'path_file' => $filePath,
                ]);
            }
        }

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Surat keluar berhasil dicatat dengan nomor: ' . $nomorPesan);
    }

    /**
     * Show specific message details.
     */
    public function show($id, Request $request)
    {
        $pesan = Pesan::with(['penerima', 'lampiran', 'pesanTerkait', 'balasan'])
            ->findOrFail($id);

        // If it's an AJAX request, return JSON
        if ($request->expectsJson()) {
            return response()->json($pesan);
        }

        $staffMembers = User::where('email', '!=', 'visitor@dummy.local')
            ->orderBy('nama')
            ->get();

        return view('admin.pesan.show', compact('pesan', 'staffMembers'));
    }

    /**
     * Update message status or assignment.
     */
    public function update(Request $request, $id)
    {
        $pesan = Pesan::findOrFail($id);

        $validated = $request->validate([
            'status_pesan' => 'required|in:pending,diterima,dalam_proses,perlu_perbaikan,disetujui,ditolak',
            'id_penerima' => 'nullable|exists:tb_pengguna,id_pengguna',
        ]);

        // Prevent assignment to dummy visitor account for incoming messages
        if ($pesan->tipe === 'masuk' && isset($validated['id_penerima'])) {
            $dummyAccountId = User::where('email', 'visitor@dummy.local')->first()->id_pengguna;
            if ($validated['id_penerima'] == $dummyAccountId) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Cannot assign visitor account to incoming messages.'], 400);
                }
                return back()->withErrors(['id_penerima' => 'Cannot assign visitor account to incoming messages.']);
            }
        }

        $pesan->update($validated);

        // If it's an AJAX request, return JSON
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
        }

        return redirect()->route('admin.pesan.show', $pesan->id_pesan)
            ->with('success', 'Pesan berhasil diperbarui.');
    }

    /**
     * Show form to create outgoing message (reply).
     */
    public function createReply($originalMessageId)
    {
        $originalPesan = Pesan::with('penerima')->findOrFail($originalMessageId);

        // Get dummy visitor account for outgoing messages
        $dummyAccount = User::where('email', 'visitor@dummy.local')->first();

        return view('admin.pesan.create-reply', compact('originalPesan', 'dummyAccount'));
    }

    /**
     * Store outgoing message (reply).
     */
    public function storeReply(Request $request, $originalMessageId)
    {
        $originalPesan = Pesan::findOrFail($originalMessageId);

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'perihal' => 'nullable|string',
            'pengirim' => 'required|string|max:200',
            'instansi' => 'nullable|string|max:50',
            'lampiran.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,gif',
        ]);

        // Get dummy visitor account
        $dummyAccount = User::where('email', 'visitor@dummy.local')->first();

        // Generate unique message number
        $nomorPesan = Pesan::generateNomorPesan();

        // Create reply message
        $replyPesan = Pesan::create([
            'nomor_pesan' => $nomorPesan,
            'judul' => $validated['judul'],
            'perihal' => $validated['perihal'],
            'kategori' => $originalPesan->kategori, // Same category as original
            'tipe' => 'keluar',
            'tanggal_kirim' => now(),
            'pengirim' => $validated['pengirim'],
            'id_penerima' => $dummyAccount->id_pengguna, // Dummy account for external recipient
            'status_pesan' => 'diterima',
            'instansi' => $validated['instansi'],
            'id_pesan_terkait' => $originalMessageId, // Link to original message
        ]);

        // Handle file uploads
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $originalName = $file->getClientOriginalName();
                $fileName = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('lampiran', $fileName, 'public');

                Lampiran::create([
                    'id_pesan' => $replyPesan->id_pesan,
                    'nama_file' => $originalName,
                    'path_file' => $filePath,
                ]);
            }
        }

        return redirect()->route('admin.pesan.show', $originalPesan->id_pesan)
            ->with('success', 'Balasan berhasil dicatat dengan nomor: ' . $nomorPesan);
    }

    /**
     * Delete a message.
     */
    public function destroy($id, Request $request)
    {
        $pesan = Pesan::with('lampiran')->findOrFail($id);

        // Only allow deletion if status is 'perlu_perbaikan' or 'ditolak'
        if (!in_array($pesan->status_pesan, ['perlu_perbaikan', 'ditolak'])) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Surat hanya dapat dihapus jika statusnya "Perlu Perbaikan" atau "Ditolak".'], 400);
            }
            return redirect()->route('admin.pesan.index')
                ->with('error', 'Surat hanya dapat dihapus jika statusnya "Perlu Perbaikan" atau "Ditolak".');
        }

        // Delete associated files from storage and database records
        foreach ($pesan->lampiran as $lampiran) {
            // Delete physical file from storage
            Storage::disk('public')->delete($lampiran->path_file);
            // Delete lampiran record from database
            $lampiran->delete();
        }

        // Now delete the message (no foreign key constraint violation)
        $pesan->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Surat berhasil dihapus.']);
        }

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Surat berhasil dihapus.');
    }
}
