<x-app-custom>
    <x-slot name="title">Tambah Akun Baru</x-slot>

    @push('styles')
    <style>
        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-header {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-label.required::after {
            content: " *";
            color: #ef4444;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: border-color 0.2s;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #991b1b;
            box-shadow: 0 0 0 3px rgba(153, 27, 27, 0.1);
        }

        .form-error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background-color: #991b1b;
            color: white;
        }

        .btn-primary:hover {
            background-color: #7f1d1d;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .file-input-wrapper {
            position: relative;
        }

        .file-preview {
            margin-top: 1rem;
            max-width: 200px;
        }

        .file-preview img {
            border-radius: 8px;
            border: 2px solid #e5e7eb;
        }
    </style>
    @endpush

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="form-container">
                <div class="form-header">
                    <h1 class="form-title">Tambah Akun Baru</h1>
                </div>

                <form action="{{ route('akun.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama" class="form-label required">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-input" value="{{ old('nama') }}" required>
                        @error('nama')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label required">Email</label>
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label required">Password</label>
                        <input type="password" id="password" name="password" class="form-input" required>
                        <small class="text-gray-500">Minimal 8 karakter</small>
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label required">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                    </div>

                    <!-- Role -->
                    <div class="form-group">
                        <label for="role" class="form-label required">Role</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                        </select>
                        @error('role')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div class="form-group">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-input" value="{{ old('nip') }}">
                        @error('nip')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Divisi -->
                    <div class="form-group">
                        <label for="divisi" class="form-label">Divisi</label>
                        <input type="text" id="divisi" name="divisi" class="form-input" value="{{ old('divisi') }}">
                        @error('divisi')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="form-group">
                        <label for="nomor_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" id="nomor_telp" name="nomor_telp" class="form-input" value="{{ old('nomor_telp') }}">
                        @error('nomor_telp')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Profile Picture -->
                    <div class="form-group">
                        <label for="profile_picture" class="form-label">Foto Profil</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="profile_picture" name="profile_picture" class="form-input" accept="image/*" onchange="previewImage(event)">
                            <small class="text-gray-500">Format: JPG, JPEG, PNG (Max: 2MB)</small>
                        </div>
                        <div id="image-preview" class="file-preview" style="display: none;">
                            <img id="preview-img" src="" alt="Preview" style="max-width: 200px;">
                        </div>
                        @error('profile_picture')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <a href="{{ route('akun.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
    @endpush
</x-app-custom>
