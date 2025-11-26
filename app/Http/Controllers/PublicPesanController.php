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
     * Tampilkan form publik buat kirim surat.
     */
    public function create()
    {
        // Ambil semua staff kecuali akun visitor dummy
        $staffMembers = User::where('email', '!=', 'visitor@dummy.local')
            ->orderBy('nama')
            ->get();

        return view('public.pesan.create', compact('staffMembers'));
    }

    /**
     * Simpan surat yang dikirim.
     */
    public function store(Request $request)
    {
        // Validasi request
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

        // Cegah pemilihan akun visitor dummy
        $dummyAccountId = User::where('email', 'visitor@dummy.local')->first()->id_pengguna;
        if ($validated['id_penerima'] == $dummyAccountId) {
            return back()->withErrors(['id_penerima' => 'Invalid recipient selection. Please choose a valid staff member.']);
        }

        // Bikin nomor pesan unik
        $nomorPesan = Pesan::generateNomorPesan();

        // Bikin pesannya
        $pesan = Pesan::create([
            'nomor_pesan' => $nomorPesan,
            'judul' => $validated['judul'],
            'perihal' => $validated['perihal'],
            'kategori' => $validated['kategori'],
            'tipe' => 'masuk',
            'tanggal_kirim' => now(),
            'pengirim' => $validated['pengirim'],
            'id_penerima' => $validated['id_penerima'],
            'status_pesan' => 'pending',
            'instansi' => $validated['instansi'],
            'kontak_pengirim' => $validated['kontak_pengirim'],
            'alamat_pengirim' => $validated['alamat_pengirim'],
        ]);

        // Proses upload file
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
     * Tampilkan halaman sukses setelah kirim surat.
     */
    public function success()
    {
        return view('public.pesan.success');
    }
}
