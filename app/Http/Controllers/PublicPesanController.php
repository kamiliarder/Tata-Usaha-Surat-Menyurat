<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\User;
use App\Models\Lampiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicPesanController extends Controller
{
    /**
     * Show the public form for submitting correspondence.
     */
    public function create()
    {
        // Get all staff members except dummy visitor account
        $staffMembers = User::where('email', '!=', 'visitor@dummy.local')
            ->orderBy('divisi')
            ->orderBy('nama')
            ->get()
            ->groupBy('divisi');

        return view('public.pesan.create', compact('staffMembers'));
    }

    /**
     * Get staff members filtered by division (AJAX endpoint).
     */
    public function getStaffByDivisi(Request $request)
    {
        $divisi = $request->input('divisi');

        $query = User::where('email', '!=', 'visitor@dummy.local');

        if ($divisi && $divisi !== 'umum') {
            // For specific divisions, show only users with that division
            $query->where('divisi', $divisi);
        }
        // For 'umum', show all users (no additional filter)

        $staffMembers = $query->orderBy('nama')->get(['id_pengguna', 'nama', 'divisi']);

        return response()->json($staffMembers);
    }

    /**
     * Store the submitted correspondence.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'perihal' => 'nullable|string',
            'kategori' => 'required|in:akademik,kesiswaan,keuangan,umum,non_akademik,sarpras',
            'id_penerima' => 'required|exists:tb_pengguna,id_pengguna',
            'pengirim' => 'required|string|max:200',
            'instansi' => 'nullable|string|max:50',
            'kontak_pengirim' => 'required|string|max:100',
            'alamat_pengirim' => 'nullable|string|max:255',
            'lampiran.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,gif', // Max 10MB
        ]);

        // Prevent selection of dummy visitor account
        $dummyAccountId = User::where('email', 'visitor@dummy.local')->first()->id_pengguna;
        if ($validated['id_penerima'] == $dummyAccountId) {
            return back()->withErrors(['id_penerima' => 'Invalid recipient selection. Please choose a valid staff member.']);
        }

        // Generate unique message number
        $nomorPesan = Pesan::generateNomorPesan();

        // Create the message
        $pesan = Pesan::create([
            'nomor_pesan' => $nomorPesan,
            'judul' => $validated['judul'],
            'perihal' => $validated['perihal'],
            'kategori' => $validated['kategori'],
            'tipe' => 'masuk',
            'tanggal_kirim' => now(),
            'pengirim' => $validated['pengirim'],
            'id_penerima' => $validated['id_penerima'],
            'status_pesan' => 'diterima',
            'instansi' => $validated['instansi'],
            'kontak_pengirim' => $validated['kontak_pengirim'],
            'alamat_pengirim' => $validated['alamat_pengirim'],
        ]);

        // Handle file uploads
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $originalName = $file->getClientOriginalName();
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('lampiran', $fileName, 'public');

                Lampiran::create([
                    'id_pesan' => $pesan->id_pesan,
                    'nama_file' => $originalName,
                    'path_file' => $filePath,
                ]);
            }
        }

        return redirect()->route('public.pesan.success')
            ->with('success', 'Pesan berhasil dikirim dengan nomor: ' . $nomorPesan);
    }

    /**
     * Show success page after submission.
     */
    public function success()
    {
        return view('public.pesan.success');
    }
}
