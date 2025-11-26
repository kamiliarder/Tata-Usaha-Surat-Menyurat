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
     * Perlihatkan semua surat. 
     */
    public function index(Request $request)
    {
        $query = Pesan::with(['penerima', 'lampiran']);

        // Filter dari tipe
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // Filter dari status
        if ($request->filled('status')) {
            $query->where('status_pesan', $request->status);
        }

        // Filter dari kategori
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

        return view('pesan.index', compact('letters'));
    }

    /**
     * Tampilkan form untuk membuat surat keluar baru.
     */
    public function create()
    {
        return view('pesan.create');
    }

    /**
     * Store surat keluar baru.
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
            'id_pesan_terkait' => 'nullable|exists:tb_pesan,id_pesan',
            'lampiran.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,gif',
        ]);

        // Ambil akun visitor untuk surat keluar
        $dummyAccount = User::where('email', 'visitor@dummy.local')->first();

        // Buat nomor surat unik dengan logic retry untuk kondisi race (ketika 2 orang mencoba membuat surat sekaligus)
        $maxRetries = 5;
        $attempt = 0;
        $pesan = null;

        while ($attempt < $maxRetries && !$pesan) {
            try {
                $nomorPesan = Pesan::generateNomorPesan();

                // Buat surat keluar
                $pesan = Pesan::create([
                    'nomor_pesan' => $nomorPesan,
                    'judul' => $validated['judul'],
                    'perihal' => $validated['perihal'],
                    'kategori' => $validated['kategori'],
                    'tipe' => 'keluar',
                    'tanggal_kirim' => now(),
                    'pengirim' => $validated['pengirim'],
                    'id_penerima' => $dummyAccount->id_pengguna, // Akun dummy untuk penerima surat keluar
                    'status_pesan' => 'diterima', // Surat keluar dianggap diterima
                    'instansi' => $validated['instansi'],
                    'kontak_pengirim' => $validated['kontak_penerima'], // Store kontak penerima
                    'alamat_pengirim' => $validated['alamat_penerima'], // Store alamat penerima
                    'id_pesan_terkait' => $validated['id_pesan_terkait'] ?? null, // Link ke pesan yang terkait kalau ini surat balasan
                ]);
            } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
                $attempt++;
                if ($attempt >= $maxRetries) {
                    throw $e;
                }
                // Delay sebelum retry
                usleep(100000); // 100ms
            }
        }

        // File upload
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

        $successMessage = 'Surat keluar berhasil dicatat dengan nomor: ' . $pesan->nomor_pesan;
        if ($validated['id_pesan_terkait']) {
            $successMessage .= ' (sebagai balasan)';
        }

        return redirect()->route('pesan.index')
            ->with('success', $successMessage);
    }

    /**
     * Detail surat spesifik
     */
    public function show($id, Request $request)
    {
        $pesan = Pesan::with(['penerima', 'lampiran', 'pesanTerkait', 'balasan'])
            ->findOrFail($id);

        // Auto-update status dari pending ke diterima ketika ada yang view
        if ($pesan->status_pesan === 'pending') {
            $pesan->update(['status_pesan' => 'diterima']);

            // Refresh model tuk mendapatkan status yang diperbarui
            $pesan->refresh();
        }

        // Jika request adalah AJAX, kembalikan data dalam format JSON
        if ($request->expectsJson()) {
            return response()->json($pesan);
        }

        return view('pesan.show', compact('pesan'));
    }

    /**
     * Update status
     */
    public function update(Request $request, $id)
    {
        $pesan = Pesan::findOrFail($id);

        $validated = $request->validate([
            'status_pesan' => 'required|in:pending,diterima,dalam_proses,perlu_perbaikan,disetujui,ditolak',
        ]);

        $pesan->update($validated);

        // Kalau ini request AJAX, kembalikan dalam format JSON
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
        }

        return redirect()->route('pesan.show', $pesan->id_pesan)
            ->with('success', 'Pesan berhasil diperbarui.');
    }

    /**
     * Tampilkan form untuk bikin pesan keluar (balasan).
     */
    public function createReply($originalMessageId)
    {
        $originalPesan = Pesan::with('penerima')->findOrFail($originalMessageId);

        // Ambil akun visitor dummy untuk pesan keluar
        $dummyAccount = User::where('email', 'visitor@dummy.local')->first();

        return view('pesan.create-reply', compact('originalPesan', 'dummyAccount'));
    }

    /**
     * Simpan pesan keluar (balasan).
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

        // Ambil akun visitor dummy
        $dummyAccount = User::where('email', 'visitor@dummy.local')->first();

        // Bikin nomor surat unik dengan logic retry untuk kondisi race (ketika 2 orang mencoba bikin surat sekaligus)
        $maxRetries = 5;
        $attempt = 0;
        $replyPesan = null;

        while ($attempt < $maxRetries && !$replyPesan) {
            try {
                $nomorPesan = Pesan::generateNomorPesan();

                // Bikin pesan balasan
                $replyPesan = Pesan::create([
                    'nomor_pesan' => $nomorPesan,
                    'judul' => $validated['judul'],
                    'perihal' => $validated['perihal'],
                    'kategori' => $originalPesan->kategori, // Kategori sama dengan pesan aslinya
                    'tipe' => 'keluar',
                    'tanggal_kirim' => now(),
                    'pengirim' => $validated['pengirim'],
                    'id_penerima' => $dummyAccount->id_pengguna, // Akun dummy untuk penerima eksternal
                    'status_pesan' => 'diterima',
                    'instansi' => $validated['instansi'],
                    'id_pesan_terkait' => $originalMessageId, // Link ke pesan aslinya
                ]);
            } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
                $attempt++;
                if ($attempt >= $maxRetries) {
                    throw $e;
                }
                // Delay dikit sebelum retry
                usleep(100000); // 100ms
            }
        }

        // Proses upload file
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

        return redirect()->route('pesan.show', $originalPesan->id_pesan)
            ->with('success', 'Balasan berhasil dicatat dengan nomor: ' . $replyPesan->nomor_pesan);
    }

    /**
     * Hapus pesan.
     */
    public function destroy($id, Request $request)
    {
        $pesan = Pesan::with('lampiran')->findOrFail($id);

        // Hanya boleh dihapus kalau statusnya 'perlu_perbaikan' atau 'ditolak'
        if (!in_array($pesan->status_pesan, ['perlu_perbaikan', 'ditolak'])) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Surat hanya dapat dihapus jika statusnya "Perlu Perbaikan" atau "Ditolak".'], 400);
            }
            return redirect()->route('pesan.index')
                ->with('error', 'Surat hanya dapat dihapus jika statusnya "Perlu Perbaikan" atau "Ditolak".');
        }

        // Hapus file terkait dari storage dan record database-nya
        foreach ($pesan->lampiran as $lampiran) {
            // Hapus file fisiknya dari storage
            Storage::disk('public')->delete($lampiran->path_file);
            // Hapus record lampiran dari database
            $lampiran->delete();
        }

        // Sekarang hapus pesannya
        $pesan->delete();

        // Kalau ini request AJAX, kembalikan dalam format JSON
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Surat berhasil dihapus.']);
        }

        return redirect()->route('pesan.index')
            ->with('success', 'Surat berhasil dihapus.');
    }
}
