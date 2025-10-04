<x-app-custom>
    <x-slot name="title">Manajemen Surat</x-slot>

    @push('styles')
    <style>
        /* Page Styles */
        .page-header {
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }

        /* Search Box Styles */
        .search-box {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .search-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .search-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }

        .search-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .search-group {
            display: flex;
            flex-direction: column;
        }

        .search-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            color: #374151;
        }

        .search-input {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        select.search-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23374151' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            cursor: pointer;
            padding-right: 2.5rem;
        }

        .create-button {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background-color: #dc2626;
            color: white;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.2s;
            font-size: 0.875rem;
        }

        .create-button:hover {
            background-color: #b91c1c;
        }

        .create-button svg {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.5rem;
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-header {
            background: #6b7280;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .table-header th {
            padding: 1rem;
            text-align: left;
            border-right: 1px solid #9ca3af;
        }

        .table-header th:last-child {
            border-right: none;
            text-align: center;
        }

        .table-row {
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }

        .table-row:hover {
            background-color: #f9fafb;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-cell {
            padding: 1rem;
            font-size: 0.875rem;
            color: #374151;
            border-right: 1px solid #e5e7eb;
        }

        .table-cell:last-child {
            border-right: none;
            text-align: center;
        }

        .table-cell.clickable {
            cursor: pointer;
        }

        .table-cell.clickable:hover {
            color: #dc2626;
            font-weight: 500;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-diterima { background-color: #d1fae5; color: #065f46; }
        .status-dalam_proses { background-color: #dbeafe; color: #1e40af; }
        .status-perlu_perbaikan { background-color: #fee2e2; color: #991b1b; }
        .status-disetujui { background-color: #d1fae5; color: #065f46; }
        .status-ditolak { background-color: #fee2e2; color: #991b1b; }

        /* Action Buttons */
        .action-btn {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.125rem;
            transition: all 0.2s;
        }

        .btn-view { background-color: #3b82f6; color: white; }
        .btn-view:hover { background-color: #2563eb; }

        .btn-edit { background-color: #10b981; color: white; }
        .btn-edit:hover { background-color: #059669; }

        .btn-delete { background-color: #ef4444; color: white; }
        .btn-delete:hover { background-color: #dc2626; }
        .btn-delete:disabled { background-color: #d1d5db; cursor: not-allowed; }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
        }

        .close-btn:hover {
            color: #374151;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        .form-select:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .btn-primary {
            background-color: #dc2626;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #b91c1c;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            margin-right: 0.5rem;
            transition: background-color 0.2s;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        /* Detail Modal Styles */
        .detail-modal .modal-content {
            max-width: 800px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .detail-item {
            padding: 1rem;
            background: #f9fafb;
            border-radius: 8px;
        }

        .detail-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            color: #6b7280;
            word-wrap: break-word;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .attachment-list {
            margin-top: 1rem;
        }

        .attachment-item {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 0.75rem;
            background: #f3f4f6;
            border-radius: 6px;
            margin-bottom: 0.5rem;
        }

        .attachment-name {
            flex-grow: 1;
            color: #374151;
        }

        .download-btn {
            background-color: #10b981;
            color: white;
            padding: 0.25rem 0.75rem;
            border: none;
            border-radius: 4px;
            font-size: 0.75rem;
            cursor: pointer;
            text-decoration: none;
        }

        .download-btn:hover {
            background-color: #059669;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table-container {
                overflow-x: auto;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                margin: 1rem;
                width: calc(100% - 2rem);
            }

            .search-grid {
                grid-template-columns: 1fr;
            }

            .search-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        @media (max-width: 1024px) and (min-width: 769px) {
            .search-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
    @endpush

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Search Box -->
            <div class="search-box">
                <div class="search-header">
                    <h1 class="search-title">Manajemen Surat</h1>
                    <a href="{{ route('admin.pesan.create') }}" class="create-button">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Surat Keluar
                    </a>
                </div>
                <form method="GET" action="{{ route('admin.pesan.index') }}" id="searchForm">
                    <div class="search-grid">
                        <div class="search-group">
                            <label for="search">Pencarian</label>
                            <input type="text" id="search" name="search" class="search-input"
                                   placeholder="Cari judul atau nomor surat"
                                   value="{{ request('search') }}">
                        </div>
                        <div class="search-group">
                            <label for="kategori">Kategori</label>
                            <select id="kategori" name="kategori" class="search-input">
                                <option value="">Semua Kategori</option>
                                <option value="akademik" {{ request('kategori') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="kesiswaan" {{ request('kategori') == 'kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                                <option value="keuangan" {{ request('kategori') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="umum" {{ request('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                                <option value="non_akademik" {{ request('kategori') == 'non_akademik' ? 'selected' : '' }}>Non Akademik</option>
                                <option value="sarpras" {{ request('kategori') == 'sarpras' ? 'selected' : '' }}>Sarpras</option>
                            </select>
                        </div>
                        <div class="search-group">
                            <label for="tipe">Tipe</label>
                            <select id="tipe" name="tipe" class="search-input">
                                <option value="">Semua Tipe</option>
                                <option value="masuk" {{ request('tipe') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                <option value="keluar" {{ request('tipe') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                            </select>
                        </div>
                        <div class="search-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="search-input">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="dalam_proses" {{ request('status') == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                                <option value="perlu_perbaikan" {{ request('status') == 'perlu_perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Main Table -->
            <div class="table-container">
                <table class="w-full">
                    <thead class="table-header">
                        <tr>
                            <th>NOMOR SURAT</th>
                            <th>JUDUL</th>
                            <th>KATEGORI</th>
                            <th>TIPE</th>
                            <th>TANGGAL</th>
                            <th>PENGIRIM</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($letters as $letter)
                        <tr class="table-row">
                            <td class="table-cell">{{ $letter->nomor_pesan }}</td>
                            <td class="table-cell clickable" onclick="showDetail({{ $letter->id_pesan }})">
                                {{ Str::limit($letter->judul, 40) }}
                            </td>
                            <td class="table-cell">
                                <span class="status-badge status-{{ $letter->kategori }}">
                                    {{ ucfirst($letter->kategori) }}
                                </span>
                            </td>
                            <td class="table-cell">
                                <span class="status-badge {{ $letter->tipe == 'masuk' ? 'status-diterima' : 'status-disetujui' }}">
                                    {{ ucfirst($letter->tipe) }}
                                </span>
                            </td>
                            <td class="table-cell">{{ $letter->tanggal_kirim->format('d/m/Y') }}</td>
                            <td class="table-cell">{{ Str::limit($letter->pengirim, 20) }}</td>
                            <td class="table-cell">
                                <span class="status-badge status-{{ $letter->status_pesan }}">
                                    {{ ucfirst(str_replace('_', ' ', $letter->status_pesan)) }}
                                </span>
                            </td>
                            <td class="table-cell">
                                <!-- View Detail Button -->
                                <button class="action-btn btn-view" onclick="showDetail({{ $letter->id_pesan }})" title="Lihat Detail">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>

                                <!-- Edit Status Button -->
                                <button class="action-btn btn-edit" onclick="showEditStatus({{ $letter->id_pesan }}, '{{ $letter->status_pesan }}')" title="Edit Status">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>

                                <!-- Delete Button (conditional) -->
                                @if(in_array($letter->status_pesan, ['perlu_perbaikan', 'ditolak']))
                                <button class="action-btn btn-delete" onclick="confirmDelete({{ $letter->id_pesan }})" title="Hapus Surat">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                                @else
                                <button class="action-btn btn-delete" disabled title="Tidak dapat dihapus">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="table-cell text-center text-gray-500 py-8">
                                Tidak ada surat ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($letters->hasPages())
            <div class="mt-6">
                {{ $letters->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Edit Status Modal -->
    <div id="editStatusModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Status Surat</h3>
                <button type="button" class="close-btn" onclick="closeModal('editStatusModal')">&times;</button>
            </div>
            <form id="editStatusForm">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label class="form-label">Status Surat</label>
                    <select id="statusSelect" name="status_pesan" class="form-select" required>
                        <option value="pending">Pending</option>
                        <option value="diterima">Diterima</option>
                        <option value="dalam_proses">Dalam Proses</option>
                        <option value="perlu_perbaikan">Perlu Perbaikan</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="btn-secondary" onclick="closeModal('editStatusModal')">Batal</button>
                    <button type="submit" class="btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="modal detail-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Detail Surat</h3>
                <button type="button" class="close-btn" onclick="closeModal('detailModal')">&times;</button>
            </div>
            <div id="detailContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Show edit status modal
        function showEditStatus(letterId, currentStatus) {
            document.getElementById('statusSelect').value = currentStatus;
            document.getElementById('editStatusForm').action = `/admin/pesan/${letterId}`;
            showModal('editStatusModal');
        }

        // Show detail modal
        function showDetail(letterId) {
            console.log('Fetching details for letter ID:', letterId);

            fetch(`/admin/pesan/${letterId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);

                    if (!response.ok) {
                        if (response.status === 401) {
                            throw new Error('Unauthorized - Please login');
                        }
                        if (response.status === 404) {
                            throw new Error('Letter not found');
                        }
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }

                    return response.json();
                })
                .then(data => {
                    console.log('Received data:', data);
                    document.getElementById('detailContent').innerHTML = generateDetailHTML(data);
                    showModal('detailModal');
                })
                .catch(error => {
                    console.error('Error details:', error);
                    alert('Gagal memuat detail surat: ' + error.message);
                });
        }

        // Generate detail HTML
        function generateDetailHTML(letter) {
            console.log('Generating HTML for letter:', letter);

            // Safely access properties with fallbacks
            const attachments = letter.lampiran || [];
            const attachmentHTML = attachments.length > 0
                ? attachments.map(att => `
                    <div class="attachment-item">
                        <span class="attachment-name">${att.nama_file || 'Unknown file'}</span>
                        <a href="/storage/${att.path_file}" class="download-btn" download>Download</a>
                    </div>
                `).join('')
                : '<p class="text-gray-500">Tidak ada lampiran</p>';

            const formatDate = (dateString) => {
                if (!dateString) return '-';
                try {
                    return new Date(dateString).toLocaleDateString('id-ID');
                } catch (e) {
                    return dateString;
                }
            };

            const safeValue = (value) => value || '-';

            return `
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Nomor Surat</div>
                        <div class="detail-value">${safeValue(letter.nomor_pesan)}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tanggal Kirim</div>
                        <div class="detail-value">${formatDate(letter.tanggal_kirim)}</div>
                    </div>
                    <div class="detail-item full-width">
                        <div class="detail-label">Judul</div>
                        <div class="detail-value">${safeValue(letter.judul)}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Kategori</div>
                        <div class="detail-value">${safeValue(letter.kategori)}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tipe</div>
                        <div class="detail-value">${safeValue(letter.tipe)}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Pengirim</div>
                        <div class="detail-value">${safeValue(letter.pengirim)}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Instansi</div>
                        <div class="detail-value">${safeValue(letter.instansi)}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Kontak Pengirim</div>
                        <div class="detail-value">${safeValue(letter.kontak_pengirim)}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span class="status-badge status-${letter.status_pesan || 'pending'}">
                                ${(letter.status_pesan || 'pending').replace('_', ' ')}
                            </span>
                        </div>
                    </div>
                    <div class="detail-item full-width">
                        <div class="detail-label">Alamat Pengirim</div>
                        <div class="detail-value">${safeValue(letter.alamat_pengirim)}</div>
                    </div>
                    <div class="detail-item full-width">
                        <div class="detail-label">Perihal</div>
                        <div class="detail-value">${safeValue(letter.perihal)}</div>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Lampiran</div>
                    <div class="attachment-list">
                        ${attachmentHTML}
                    </div>
                </div>
            `;
        }

        // Confirm delete
        function confirmDelete(letterId) {
            if (confirm('Apakah Anda yakin ingin menghapus surat ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/pesan/${letterId}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Modal functions
        function showModal(modalId) {
            document.getElementById(modalId).classList.add('show');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        // Handle edit status form submission
        document.getElementById('editStatusForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append('_method', 'PATCH'); // Add method spoofing for Laravel
            const url = this.action;

            console.log('Submitting status update to:', url);
            console.log('Form data:', Object.fromEntries(formData));

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('Status update response:', response.status);

                if (!response.ok) {
                    if (response.status === 401) {
                        throw new Error('Unauthorized - Please login');
                    }
                    if (response.status === 422) {
                        return response.json().then(data => {
                            throw new Error('Validation failed: ' + (data.message || 'Invalid data'));
                        });
                    }
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Status update result:', data);

                if (data.success) {
                    closeModal('editStatusModal');
                    alert('Status berhasil diperbarui');
                    location.reload();
                } else {
                    alert(data.message || 'Gagal mengupdate status');
                }
            })
            .catch(error => {
                console.error('Status update error:', error);
                alert('Terjadi kesalahan saat mengupdate status: ' + error.message);
            });
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target == modal) {
                    modal.classList.remove('show');
                }
            });
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const searchInput = document.getElementById('search');
            const kategoriSelect = document.getElementById('kategori');
            const tipeSelect = document.getElementById('tipe');
            const statusSelect = document.getElementById('status');

            // Auto-submit form when filters change
            kategoriSelect.addEventListener('change', function() {
                searchForm.submit();
            });

            tipeSelect.addEventListener('change', function() {
                searchForm.submit();
            });

            statusSelect.addEventListener('change', function() {
                searchForm.submit();
            });

            // Debounced search for text input
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    searchForm.submit();
                }, 500); // Wait 500ms after user stops typing
            });
        });
    </script>
    @endpush
</x-app-custom>
