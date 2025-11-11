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
     * Display a listing of all teachers/users.
     */
    public function index(Request $request)
    {
        // Get search query from request
        $search = $request->input('search');

        // Fetch semua user kecuali visitor dummy account
        // Mengambil field yang diinginkan
        $teachers = User::where('email', '!=', 'visitor@dummy.local')
            ->when($search, function($query, $search) {
                // Search in multiple fields
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
                // Field display friendly (lain passwordnya ini)
                $user->password_display = '••••••••';
                $user->nama_lengkap = $user->nama;
                return $user;
            });

        return view('akun.index', compact('teachers', 'search'));
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

        // Handle profile picture upload
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

        // Create user
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
     * Display the specified user.
     *
     * @param User $akun - The user model instance (from route model binding)
     * @return \Illuminate\View\View
     */
    public function show(User $akun)
    {
        return view('akun.show', compact('akun'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $akun - The user model instance (from route model binding)
     * @return \Illuminate\View\View
     */
    public function edit(User $akun)
    {
        // $akun is already a User instance from route model binding
        return view('akun.edit', compact('akun'));
    }

    /**
     * Update the specified user.
     *
     * @param Request $request - The HTTP request object containing form data
     * @param User $akun - The user model instance (automatically injected via route model binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $akun)
    {
        // Validate input from the request
        // Note: $request and $akun are method parameters injected by Laravel, not undefined variables
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

        // Continue with update logic
        // Handle profile picture - preserve existing picture path initially
        $profilePicturePath = $akun->profile_picture; // $akun comes from method parameter

        // Check if user wants to remove existing profile picture
        if ($request->input('remove_profile_picture') == '1') { // $request comes from method parameter
            if ($akun->profile_picture) {
                Storage::disk('public')->delete('profile-pictures/' . $akun->profile_picture);
            }
            $profilePicturePath = null;
        }

        // Handle new profile picture upload from the request
        if ($request->hasFile('profile_picture')) { // $request is the method parameter
            // Delete old picture if exists before uploading new one
            if ($akun->profile_picture) { // $akun is the method parameter
                Storage::disk('public')->delete('profile-pictures/' . $akun->profile_picture);
            }

            // Store the new profile picture from the request
            $file = $request->file('profile_picture'); // $request contains the uploaded file
            $filename = $file->hashName();
            $file->storeAs('profile-pictures', $filename, 'public');
            $profilePicturePath = $filename;
        }

        // Update user data - prepare the array with validated and processed data
        $updateData = [
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'nip' => $validated['nip'] ?? null,
            'nomor_telp' => $validated['nomor_telp'] ?? null,
            'profile_picture' => $profilePicturePath,
        ];

        // Only update password if provided
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // Perform the update on the User model instance ($akun is from method parameter)
        $akun->update($updateData);

        // Redirect back to the account list with success message
        return redirect()->route('akun.index')
            ->with('success', 'Akun berhasil diperbarui untuk ' . $akun->nama); // $akun is the User model instance
    }

    /**
     * Remove the specified user.
     *
     * @param int $id - The ID of the user to delete (from route parameter)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) // $id comes from the route parameter
    {
        $user = User::findOrFail($id); // $id is the method parameter from the route

        // Prevent deleting yourself
        if ($user->id_pengguna == Auth::id()) {
            return redirect()->route('akun.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Delete profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete('profile-pictures/' . $user->profile_picture);
        }

        $userName = $user->nama;
        $user->delete();

        return redirect()->route('akun.index')
            ->with('success', 'Akun ' . $userName . ' berhasil dihapus.');
    }
}
