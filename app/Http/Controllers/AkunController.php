<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AkunController extends Controller
{
    /**
     * Display a listing of all teachers/users.
     */
    public function index()
    {
        // Fetch semua user kecuali visitor dummy account
        // Mengambil field yang diinginkan
        $teachers = User::where('email', '!=', 'visitor@dummy.local')
            ->select([
                'id_pengguna', // Perlu buat aksi, tak akan ditampilkan
                'email as username', // Email jadi => username
                'nama',
                'role',
                'nip',
                'divisi',
                'nomor_telp',
                'profile_picture'
            ])
            ->orderBy('nama', 'asc')
            ->get()
            ->map(function($user) {
                // Field display friendly (lain passwordnya ini)
                $user->password_display = '••••••••';
                $user->nama_lengkap = $user->nama;
                return $user;
            });

        return view('akun.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:tb_pengguna,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required|in:admin,staff,guru',
            'nip' => 'nullable|string|max:50|unique:tb_pengguna,nip',
            'divisi' => 'nullable|string|max:100',
            'nomor_telp' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
        ]);

        // Handle profile picture upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        // Create user
        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nip' => $validated['nip'] ?? null,
            'divisi' => $validated['divisi'] ?? null,
            'nomor_telp' => $validated['nomor_telp'] ?? null,
            'profile_picture' => $profilePicturePath,
        ]);

        return redirect()->route('akun.index')
            ->with('success', 'Akun berhasil dibuat untuk ' . $user->nama);
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $teacher = User::findOrFail($id);
        return view('akun.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        return view('akun.edit', compact('teacher'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        // Will implement this later
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        // Will implement this later
    }
}
