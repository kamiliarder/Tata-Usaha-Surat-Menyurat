@extends('public.layout')

@section('title', 'Buat Surat')

@push('styles')
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e8e8e8;
        }

        /* Page Title */
        .page-title {
            background-color: #f5f5f5;
            padding: 20px 40px;
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        /* Container */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background-color: white;
            border-radius: 8px;
            padding: 40px 50px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Title */
        .form-title {
            text-align: center;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 40px;
            color: #333;
        }

        /* Form Layout */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 15px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea,
        select {
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
            width: 100%;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #dc2626;
        }

        select:disabled {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .error-text {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .upload-hint {
            font-size: 11px;
            color: #666;
            margin-top: 5px;
        }

        .download-link {
            text-decoration: none;
            color: inherit;
        }

        .download-area {
            background-color: #f8f9fa;
            border-color: #28a745;
        }

        .download-area:hover {
            background-color: #e9ecef;
        }

        .download-hint {
            font-size: 11px;
            color: #28a745;
            margin-top: 5px;
        }

        /* Upload Section */
        .upload-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .upload-box {
            display: flex;
            flex-direction: column;
        }

        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 6px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.5s;
            background-color: #fafafa;
        }

        .upload-area:hover {
            border-color: #dc2626;
            background-color: #fff;
        }

        .upload-icon {
            font-size: 48px;
            margin-bottom: 10px;
            color: #333;
        }

        .upload-text {
            font-size: 15px;
            color: #333;
            font-weight: 500;
        }

        .download-icon {
            font-size: 48px;
            margin-bottom: 10px;
            color: #333;
        }

        .download-btn {
            background-color: #dc2626;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-top: 10px;
            display: inline-block;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: #dc2626;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #b91c1c;
        }

        .submit-btn:active {
            transform: translateY(1px);
        }
    </style>
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title">
                        <p class="text-gray-700 italic text-base ml-12">
                            "Streamlining Correspondence, Empowering Administration."
                        </p>
    </div>

    <!-- Main Container -->
    <div class="container">
        <h1 class="form-title">Buat Surat</h1>

        <form action="{{ route('public.pesan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Hidden field for status_pesan (defaults to pending) -->
            <input type="hidden" name="status_pesan" value="pending">
            <input type="hidden" name="tipe" value="masuk">

            <!-- Form Grid -->
            <div class="form-grid">
                <div class="form-group">
                    <label for="judul">Judul <span style="color: red;">*</span></label>
                    <input type="text" id="judul" name="judul" required value="{{ old('judul') }}">
                    @error('judul')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori <span style="color: red;">*</span></label>
                    <select id="kategori" name="kategori" required onchange="loadPenerima()">
                        <option value="">Pilih Kategori</option>
                        <option value="akademik" {{ old('kategori') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="kesiswaan" {{ old('kategori') == 'kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                        <option value="keuangan" {{ old('kategori') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                        <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                        <option value="non_akademik" {{ old('kategori') == 'non_akademik' ? 'selected' : '' }}>Non Akademik</option>
                        <option value="sarpras" {{ old('kategori') == 'sarpras' ? 'selected' : '' }}>Sarpras</option>
                    </select>
                    @error('kategori')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pengirim">Nama Pengirim <span style="color: red;">*</span></label>
                    <input type="text" id="pengirim" name="pengirim" required value="{{ old('pengirim') }}">
                    @error('pengirim')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="instansi">Instansi Asal</label>
                    <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}">
                    @error('instansi')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_penerima">Ditujukan Kepada <span style="color: red;">*</span></label>
                    <select id="id_penerima" name="id_penerima" required disabled>
                        <option value="">Pilih kategori terlebih dahulu</option>
                    </select>
                    @error('id_penerima')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kontak_pengirim">No Telp. Whatsapp <span style="color: red;">*</span></label>
                    <input type="text" id="kontak_pengirim" name="kontak_pengirim" required value="{{ old('kontak_pengirim') }}">
                    @error('kontak_pengirim')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="alamat_pengirim">Alamat Pengirim</label>
                    <textarea id="alamat_pengirim" name="alamat_pengirim">{{ old('alamat_pengirim') }}</textarea>
                    @error('alamat_pengirim')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="perihal">Perihal <span style="color: red;">*</span></label>
                    <textarea id="perihal" name="perihal" required>{{ old('perihal') }}</textarea>
                    @error('perihal')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Upload Section -->
            <div class="upload-section">
                <div class="upload-box">
                    <label>Upload Surat (Lampiran)</label>
                    <div class="upload-area" onclick="document.getElementById('lampiran').click()">
                        <input type="file" id="lampiran" name="lampiran[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" style="display: none;" onchange="updateFileName()">
                        <div class="upload-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <div class="upload-text" id="upload-text">Browse files</div>
                        <div class="upload-hint">PDF, DOC, DOCX, JPG, PNG (Max 10MB per file)</div>
                    </div>
                    @error('lampiran')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="upload-box">
                    <label>Unduh Template Surat</label>
                    <a href="{{ asset('files/KOP SURAT 2022.docx') }}" download class="download-link">
                        <div class="upload-area download-area">
                            <div class="download-icon">📄</div>
                            <span class="download-btn">Unduh Template</span>
                            <div class="download-hint">KOP SURAT 2022.docx</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Kirim Surat</button>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // Dynamic dropdown for penerima based on kategori
    async function loadPenerima() {
        const kategori = document.getElementById('kategori').value;
        const penerimaSelect = document.getElementById('id_penerima');

        console.log('Loading penerima for kategori:', kategori);

        // Reset and disable penerima dropdown
        penerimaSelect.innerHTML = '<option value="">Loading...</option>';
        penerimaSelect.disabled = true;

        if (!kategori) {
            penerimaSelect.innerHTML = '<option value="">Pilih kategori terlebih dahulu</option>';
            return;
        }

        try {
            // Make AJAX request to get teachers by division
            const url = `/api/pengguna/by-divisi/${kategori}`;
            console.log('Fetching from URL:', url);

            const response = await fetch(url);
            console.log('Response status:', response.status);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const teachers = await response.json();
            console.log('Teachers received:', teachers);

            // Clear and populate dropdown
            penerimaSelect.innerHTML = '<option value="">Pilih Penerima</option>';

            teachers.forEach(teacher => {
                const option = document.createElement('option');
                option.value = teacher.id_pengguna;
                option.textContent = `${teacher.nama} (${teacher.divisi})`;
                penerimaSelect.appendChild(option);
            });

            // Restore old value if exists
            const oldValue = '{{ old("id_penerima") }}';
            if (oldValue) {
                penerimaSelect.value = oldValue;
            }

            penerimaSelect.disabled = false;
            console.log('Dropdown populated successfully');
        } catch (error) {
            console.error('Error loading teachers:', error);
            penerimaSelect.innerHTML = '<option value="">Error loading data</option>';
        }
    }

    // Update file name display
    function updateFileName() {
        const fileInput = document.getElementById('lampiran');
        const uploadText = document.getElementById('upload-text');

        if (fileInput.files.length > 0) {
            const fileNames = Array.from(fileInput.files).map(file => file.name);
            uploadText.textContent = `${fileInput.files.length} file(s) selected: ${fileNames.join(', ')}`;
        } else {
            uploadText.textContent = 'Browse files';
        }
    }

    // Load penerima on page load if kategori is already selected (for old input)
    document.addEventListener('DOMContentLoaded', function() {
        const kategori = document.getElementById('kategori').value;
        if (kategori) {
            loadPenerima();
        }
    });
</script>
@endpush
