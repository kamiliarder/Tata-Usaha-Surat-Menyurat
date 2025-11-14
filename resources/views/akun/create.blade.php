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

        /* Avatar Upload Styles */
        .avatar-upload-container {
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .avatar-upload-label {
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .avatar-preview-wrapper {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #e5e7eb;
            background: #4a5568;
        }

        .avatar-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #4a5568;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 2.5rem;
            border: 1px solid #e5e7eb;
        }

        .remove-avatar-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ef4444;
            color: white;
            border: 2px solid white;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .remove-avatar-btn:hover {
            background: #dc2626;
        }

        .remove-avatar-btn.show {
            display: flex;
        }

        .file-input-hidden {
            display: none;
        }

        .browse-button {
            background: #991b1b;
            color: #e2e8f0;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.2s;
            display: inline-block;
        }

        .browse-button:hover {
            background: #5a6678;
            border-color: #8896ab;
        }

        .file-requirements {
            color: #a0aec0;
            font-size: 0.75rem;
            text-align: center;
            margin-top: 0.5rem;
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

                    <div class="form-group">
                        <label class="form-label">Foto Profil</label>
                        <div class="avatar-upload-container">
                            <span class="avatar-upload-label">Upload avatar</span>

                            <div class="avatar-preview-wrapper">
                                <img id="avatar-preview" class="avatar-preview" style="display: none;" src="" alt="Avatar Preview">
                                <div id="avatar-placeholder" class="avatar-placeholder">
                                    <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                                <button type="button" id="remove-avatar" class="remove-avatar-btn" title="Hapus foto">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </button>
                            </div>

                            <input type="file"
                                   id="profile_picture"
                                   name="profile_picture"
                                   class="file-input-hidden"
                                   accept="image/*,.png,.jpg,.jpeg,.gif,.svg"
                                   onchange="handleAvatarUpload(event)">

                            <label for="profile_picture" class="browse-button">
                                Browse...
                            </label>

                            <div class="file-requirements">
                                SVG, PNG, JPG or GIF (MAX. 800×400px).
                            </div>
                        </div>
                        @error('profile_picture')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

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

                    <!-- Nomor Telepon -->
                    <div class="form-group">
                        <label for="nomor_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" id="nomor_telp" name="nomor_telp" class="form-input" value="{{ old('nomor_telp') }}">
                        @error('nomor_telp')
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
        function handleAvatarUpload(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');
            const removeBtn = document.getElementById('remove-avatar');

            if (file) {
                // Debug: Log file information
                console.log('File name:', file.name);
                console.log('File type:', file.type);
                console.log('File size:', file.size);

                // Validate file type - check extension as fallback for MIME type issues
                const fileName = file.name.toLowerCase();
                const validExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.svg'];
                const validTypes = ['image/svg+xml', 'image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/x-png', 'application/octet-stream'];

                const hasValidExtension = validExtensions.some(ext => fileName.endsWith(ext));
                const hasValidType = validTypes.includes(file.type);

                console.log('Has valid extension:', hasValidExtension);
                console.log('Has valid type:', hasValidType);

                if (!hasValidExtension && !hasValidType) {
                    alert('Format file tidak valid. Gunakan SVG, PNG, JPG atau GIF.\nFile type: ' + file.type);
                    event.target.value = '';
                    return;
                }                // Validate file size (5MB)
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    event.target.value = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                    removeBtn.classList.add('show');
                }
                reader.readAsDataURL(file);
            }
        }

        // Remove avatar functionality
        document.getElementById('remove-avatar').addEventListener('click', function() {
            const fileInput = document.getElementById('profile_picture');
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');
            const removeBtn = document.getElementById('remove-avatar');

            // Reset file input
            fileInput.value = '';

            // Reset preview
            preview.src = '';
            preview.style.display = 'none';
            placeholder.style.display = 'flex';
            removeBtn.classList.remove('show');
        });
    </script>
    @endpush
</x-app-custom>
