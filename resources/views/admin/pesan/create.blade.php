<x-app-custom>
    <x-slot name="title">Buat Surat Keluar</x-slot>

    @push('styles')
    <style>
        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .form-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-label.required::after {
            content: ' *';
            color: #dc2626;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        .file-upload {
            border: 2px dashed #d1d5db;
            border-radius: 6px;
            padding: 2rem;
            text-align: center;
            transition: border-color 0.2s;
        }

        .file-upload:hover {
            border-color: #dc2626;
        }

        .file-upload.dragover {
            border-color: #dc2626;
            background-color: #fef2f2;
        }

        .file-upload-icon {
            margin: 0 auto 1rem;
            width: 48px;
            height: 48px;
            color: #9ca3af;
        }

        .file-upload-text {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .file-upload-button {
            color: #dc2626;
            font-weight: 500;
            cursor: pointer;
        }

        .file-list {
            margin-top: 1rem;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }

        .file-name {
            font-size: 0.875rem;
            color: #374151;
        }

        .file-remove {
            color: #dc2626;
            cursor: pointer;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border: none;
            background: none;
        }

        .submit-section {
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: #dc2626;
            color: white;
        }

        .btn-primary:hover {
            background-color: #b91c1c;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .submit-section {
                flex-direction: column;
            }
        }
    </style>
    @endpush

    <div class="py-6">
        <div class="px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="form-container">
                <div class="form-header">
                    <h1 class="form-title">Buat Surat Keluar</h1>
                    <p class="form-subtitle">Formulir untuk mencatat surat keluar yang dikirim oleh sekolah</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="text-red-600 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.pesan.store') }}" method="POST" enctype="multipart/form-data" id="outgoingLetterForm">
                    @csrf

                    <!-- Letter Information -->
                    <div class="form-group">
                        <label for="judul" class="form-label required">Judul Surat</label>
                        <input type="text" id="judul" name="judul" class="form-input"
                               value="{{ old('judul') }}" placeholder="Masukkan judul surat" required>
                        @error('judul')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="kategori" class="form-label required">Kategori</label>
                            <select id="kategori" name="kategori" class="form-input form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="akademik" {{ old('kategori') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="kesiswaan" {{ old('kategori') == 'kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                                <option value="keuangan" {{ old('kategori') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="sarpras" {{ old('kategori') == 'sarpras' ? 'selected' : '' }}>Sarana Prasarana</option>
                                <option value="non_akademik" {{ old('kategori') == 'non_akademik' ? 'selected' : '' }}>Non Akademik</option>
                                <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                            @error('kategori')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pengirim" class="form-label required">Pengirim</label>
                            <input type="text" id="pengirim" name="pengirim" class="form-input"
                                   value="{{ old('pengirim') }}" placeholder="Nama pengirim" required>
                            @error('pengirim')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Recipient Information -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="penerima" class="form-label required">Penerima</label>
                            <input type="text" id="penerima" name="penerima" class="form-input"
                                   value="{{ old('penerima') }}" placeholder="Nama penerima" required>
                            @error('penerima')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="instansi" class="form-label">Instansi Penerima</label>
                            <input type="text" id="instansi" name="instansi" class="form-input"
                                   value="{{ old('instansi') }}" placeholder="Nama instansi">
                            @error('instansi')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="kontak_penerima" class="form-label">Kontak Penerima</label>
                            <input type="text" id="kontak_penerima" name="kontak_penerima" class="form-input"
                                   value="{{ old('kontak_penerima') }}" placeholder="Nomor telepon/email">
                            @error('kontak_penerima')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat_penerima" class="form-label">Alamat Penerima</label>
                            <input type="text" id="alamat_penerima" name="alamat_penerima" class="form-input"
                                   value="{{ old('alamat_penerima') }}" placeholder="Alamat lengkap">
                            @error('alamat_penerima')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Letter Content -->
                    <div class="form-group">
                        <label for="perihal" class="form-label">Perihal</label>
                        <textarea id="perihal" name="perihal" class="form-input form-textarea"
                                  placeholder="Jelaskan perihal surat...">{{ old('perihal') }}</textarea>
                        @error('perihal')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div class="form-group">
                        <label class="form-label">Lampiran</label>
                        <div class="file-upload" id="fileUpload">
                            <svg class="file-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <div class="file-upload-text">
                                <span class="file-upload-button">Klik untuk upload</span> atau drag & drop file
                                <br>
                                <small>PDF, DOC, DOCX, JPG, PNG (Max: 10MB)</small>
                            </div>
                            <input type="file" name="lampiran[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif"
                                   style="display: none;" id="fileInput">
                        </div>
                        <div class="file-list" id="fileList"></div>
                        @error('lampiran.*')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Section -->
                    <div class="submit-section">
                        <a href="{{ route('admin.pesan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Surat Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileUpload = document.getElementById('fileUpload');
            const fileInput = document.getElementById('fileInput');
            const fileList = document.getElementById('fileList');
            let selectedFiles = [];

            // Click to upload
            fileUpload.addEventListener('click', () => {
                fileInput.click();
            });

            // Drag and drop
            fileUpload.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileUpload.classList.add('dragover');
            });

            fileUpload.addEventListener('dragleave', () => {
                fileUpload.classList.remove('dragover');
            });

            fileUpload.addEventListener('drop', (e) => {
                e.preventDefault();
                fileUpload.classList.remove('dragover');
                handleFiles(e.dataTransfer.files);
            });

            // File input change
            fileInput.addEventListener('change', (e) => {
                handleFiles(e.target.files);
            });

            function handleFiles(files) {
                Array.from(files).forEach(file => {
                    if (validateFile(file)) {
                        selectedFiles.push(file);
                        addFileToList(file);
                    }
                });
                updateFileInput();
            }

            function validateFile(file) {
                const allowedTypes = ['application/pdf', 'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'image/jpeg', 'image/png', 'image/gif'];
                const maxSize = 10 * 1024 * 1024; // 10MB

                if (!allowedTypes.includes(file.type)) {
                    alert(`File ${file.name} tidak didukung. Gunakan PDF, DOC, DOCX, JPG, PNG, atau GIF.`);
                    return false;
                }

                if (file.size > maxSize) {
                    alert(`File ${file.name} terlalu besar. Maksimal 10MB.`);
                    return false;
                }

                return true;
            }

            function addFileToList(file) {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <span class="file-name">${file.name}</span>
                    <button type="button" class="file-remove" onclick="removeFile('${file.name}')">Hapus</button>
                `;
                fileList.appendChild(fileItem);
            }

            function updateFileInput() {
                const dt = new DataTransfer();
                selectedFiles.forEach(file => dt.items.add(file));
                fileInput.files = dt.files;
            }

            window.removeFile = function(fileName) {
                selectedFiles = selectedFiles.filter(file => file.name !== fileName);
                const fileItems = fileList.querySelectorAll('.file-item');
                fileItems.forEach(item => {
                    if (item.querySelector('.file-name').textContent === fileName) {
                        item.remove();
                    }
                });
                updateFileInput();
            };
        });
    </script>
    @endpush
</x-app-custom>
