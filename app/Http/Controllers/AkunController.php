<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AkunController extends Controller
{
    /**
     * Tampilkan daftar semua guru/user.
     */
    public function index(Request $request)
    {
        // Ambil query pencarian dari request
        $search = $request->input('search');

        // Fetch semua user kecuali visitor dummy account
        // Mengambil field yang diinginkan
        $teachers = User::where('email', '!=', 'visitor@dummy.local')
            ->when($search, function($query, $search) {
                // Cari di beberapa field sekaligus
                $query->where(function($q) use ($search) {
                    $q->where('email', 'LIKE', "%{$search}%")
                      ->orWhere('nama', 'LIKE', "%{$search}%")
                      ->orWhere('role', 'LIKE', "%{$search}%")
                      ->orWhere('nip', 'LIKE', "%{$search}%");
                });
            })
            ->select([
                'id_pengguna', // Perlu buat aksi, tak akan ditampilkan
                'email as username', // Email jadi => username
                'nama',
                'role',
                'nip',
                'nomor_telp',
                'profile_picture'
            ])
            ->orderBy('nama', 'asc')
            ->get()
            ->map(function($user) {
                // Field yang ditampilin (kecuali passwordnya)
                $user->password_display = '••••••••';
                $user->nama_lengkap = $user->nama;
                return $user;
            });

        return view('akun.index', compact('teachers', 'search'));
    }

    /**
     * Tampilkan form buat bikin user baru.
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Simpan user yang baru dibuat.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:tb_pengguna,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required|in:admin,staff,guru',
            'nip' => 'nullable|string|max:50|unique:tb_pengguna,nip',
            'nomor_telp' => 'nullable|string|max:20',
            'profile_picture' => [
                'nullable',
                'file',
                'max:5120', // 5MB in kilobytes
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $extension = strtolower($value->getClientOriginalExtension());
                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

                        if (!in_array($extension, $allowedExtensions)) {
                            $fail('The profile picture must be a file of type: jpg, jpeg, png, gif, svg.');
                        }
                    }
                },
            ],
        ]);

        // Proses upload foto profil
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            // Debug logging
            Log::info('Profile picture upload attempt', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
            ]);

            try {
                $filename = $file->hashName(); // Get the hashed filename
                $file->storeAs('profile-pictures', $filename, 'public');
                $profilePicturePath = $filename; // Store only filename, not the path

                Log::info('Profile picture stored successfully', ['filename' => $filename]);
            } catch (\Exception $e) {
                Log::error('Profile picture upload failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                return redirect()->back()
                    ->withInput()
                    ->withErrors(['profile_picture' => 'Gagal mengunggah gambar profil, coba size yang lebih kecil: ' . $e->getMessage()]);
            }
        } else {
            Log::info('No profile picture file received');
        }

        // Bikin user baru
        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nip' => $validated['nip'] ?? null,
            'nomor_telp' => $validated['nomor_telp'] ?? null,
            'profile_picture' => $profilePicturePath,
        ]);

        return redirect()->route('akun.index')
            ->with('success', 'Akun berhasil dibuat untuk ' . $user->nama);
    }

    /**
     * Tampilkan detail user tertentu.
     *
     * @param User $akun - Instance model User (dari route model binding)
     * @return \Illuminate\View\View
     */
    public function show(User $akun)
    {
        return view('akun.show', compact('akun'));
    }

    /**
     * Tampilkan form buat edit user tertentu.
     *
     * @param User $akun - Instance model User (dari route model binding)
     * @return \Illuminate\View\View
     */
    public function edit(User $akun)
    {
        // $akun udah jadi instance User dari route model binding
        return view('akun.edit', compact('akun'));
    }

    /**
     * Update user tertentu.
     *
     * @param Request $request - Object HTTP request yang berisi data form
     * @param User $akun - Instance model User (otomatis diinject lewat route model binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $akun)
    {
        // Validasi input dari request
        // Catatan: $request dan $akun adalah parameter method yang diinject Laravel, bukan variabel undefined
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:tb_pengguna,email,' . $akun->id_pengguna . ',id_pengguna',
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role' => 'required|in:admin,staff,guru',
            'nip' => 'nullable|string|max:50|unique:tb_pengguna,nip,' . $akun->id_pengguna . ',id_pengguna',
            'nomor_telp' => 'nullable|string|max:20',
            'profile_picture' => [
                'nullable',
                'file',
                'max:5120', // 5MB in kilobytes
                function ($attribute, $value, $fail) use ($request) {
                    if ($value) {
                        $extension = strtolower($value->getClientOriginalExtension());
                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

                        if (!in_array($extension, $allowedExtensions)) {
                            $fail('Gambar profil harus berupa file dengan ekstensi: jpg, jpeg, png, gif, svg.');
                        }
                    }
                },
            ],
        ]);

        // Proses foto profil - simpan path foto yang ada dulu
        $profilePicturePath = $akun->profile_picture; // $akun comes from method parameter

        // Cek apakah user mau hapus foto profil yang ada
        if ($request->input('remove_profile_picture') == '1') { // $request comes from method parameter
            if ($akun->profile_picture) {
                Storage::disk('public')->delete('profile-pictures/' . $akun->profile_picture);
            }
            $profilePicturePath = null;
        }

        // Proses upload foto profil baru dari request
        if ($request->hasFile('profile_picture')) { // $request is the method parameter
            // Hapus foto lama kalau ada sebelum upload yang baru
            if ($akun->profile_picture) { // $akun is the method parameter
                Storage::disk('public')->delete('profile-pictures/' . $akun->profile_picture);
            }

            // Simpan foto profil baru dari request
            $file = $request->file('profile_picture'); // $request contains the uploaded file
            $filename = $file->hashName();
            $file->storeAs('profile-pictures', $filename, 'public');
            $profilePicturePath = $filename;
        }

        // Update data user - siapkan array dengan data yang udah divalidasi dan diproses
        $updateData = [
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'nip' => $validated['nip'] ?? null,
            'nomor_telp' => $validated['nomor_telp'] ?? null,
            'profile_picture' => $profilePicturePath,
        ];

        // Update password cuma kalau diisi
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // Jalankan update di instance model User ($akun dari parameter method)
        $akun->update($updateData);

        // Redirect balik ke daftar akun dengan pesan sukses
        return redirect()->route('akun.index')
            ->with('success', 'Akun berhasil diperbarui untuk ' . $akun->nama); // $akun is the User model instance
    }

    /**
     * Hapus user tertentu.
     *
     * @param int $id - ID user yang mau dihapus (dari parameter route)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) // $id comes from the route parameter
    {
        $user = User::findOrFail($id); // $id is the method parameter from the route

        // Cegah hapus akun sendiri
        if ($user->id_pengguna == Auth::id()) {
            return redirect()->route('akun.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Hapus foto profil kalau ada
        if ($user->profile_picture) {
            Storage::disk('public')->delete('profile-pictures/' . $user->profile_picture);
        }

        $userName = $user->nama;
        $user->delete();

        return redirect()->route('akun.index')
            ->with('success', 'Akun ' . $userName . ' berhasil dihapus.');
    }
}
