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

        $pesanList = $query->orderBy('tanggal_kirim', 'desc')->paginate(15);

        return view('admin.pesan.index', compact('pesanList'));
    }

    /**
     * Show specific message details.
     */
    public function show($id)
    {
        $pesan = Pesan::with(['penerima', 'lampiran', 'pesanTerkait', 'balasan'])
            ->findOrFail($id);

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
            'status_pesan' => 'required|in:diterima,dalam_proses,perlu_perbaikan,disetujui,ditolak',
            'id_penerima' => 'nullable|exists:tb_pengguna,id_pengguna',
        ]);

        // Prevent assignment to dummy visitor account for incoming messages
        if ($pesan->tipe === 'masuk' && $validated['id_penerima']) {
            $dummyAccountId = User::where('email', 'visitor@dummy.local')->first()->id_pengguna;
            if ($validated['id_penerima'] == $dummyAccountId) {
                return back()->withErrors(['id_penerima' => 'Cannot assign visitor account to incoming messages.']);
            }
        }

        $pesan->update($validated);

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
    public function destroy($id)
    {
        $pesan = Pesan::with('lampiran')->findOrFail($id);

        // Delete associated files
        foreach ($pesan->lampiran as $lampiran) {
            Storage::disk('public')->delete($lampiran->path_file);
        }

        // Delete message (attachments will be deleted by foreign key cascade)
        $pesan->delete();

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
