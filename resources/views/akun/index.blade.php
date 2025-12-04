<x-app-custom>
    <x-slot name="title">Manajemen Akun Guru</x-slot>

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
            margin-bottom: 0;
        }

        .search-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }

        .create-button {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background-color: #991b1b;
            color: white;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.2s;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
        }

        .create-button:hover {
            background-color: #b91c1c;
        }

        .create-button svg {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.5rem;
        }

        /* Search Input Styles */
        .search-form {
            margin-top: 1.5rem;
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .search-input-wrapper {
            flex: 1;
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: #991b1b;
            box-shadow: 0 0 0 3px rgba(153, 27, 27, 0.1);
        }

        .search-button {
            padding: 0.75rem 1.5rem;
            background-color: #991b1b;
            color: white;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            font-size: 0.875rem;
            white-space: nowrap;
        }

        .search-button:hover {
            background-color: #b91c1c;
        }

        .clear-button {
            padding: 0.75rem 1.5rem;
            background-color: #6b7280;
            color: white;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.2s;
            font-size: 0.875rem;
            display: inline-block;
            white-space: nowrap;
        }

        .clear-button:hover {
            background-color: #4b5563;
        }

        .search-result-info {
            margin-top: 1rem;
            color: #6b7280;
            font-size: 0.875rem;
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
            text-align: center;
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

        /* Profile Picture Styles */
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .profile-pic {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .profile-pic-placeholder {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

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

        /* Responsive */
        @media (max-width: 768px) {
            .table-container {
                overflow-x: auto;
            }

            .search-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .search-form {
                flex-direction: column;
                width: 100%;
            }

            .search-input-wrapper {
                width: 100%;
            }

            .search-button,
            .clear-button {
                width: 100%;
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

            <!-- Page Header -->
            <div class="search-box">
                <div class="search-header">
                    <h1 class="search-title">Manajemen Akun Guru</h1>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('akun.create') }}" class="create-button">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Akun Baru
                        </a>
                    @endif
                </div>

                <!-- Search Form -->
                <form method="GET" action="{{ route('akun.index') }}" class="search-form">
                    <div class="search-input-wrapper">
                        <svg class="search-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input
                            type="text"
                            name="search"
                            class="search-input"
                            placeholder="Cari berdasarkan username, nama, role, atau NIP..."
                            value="{{ $search ?? '' }}"
                        >
                    </div>
                    <button type="submit" class="search-button">Cari</button>
                    @if(isset($search) && $search)
                        <a href="{{ route('akun.index') }}" class="clear-button">Clear</a>
                    @endif
                </form>

                <!-- Search Result Info -->
                @if(isset($search) && $search)
                    <div class="search-result-info">
                        Menampilkan hasil pencarian untuk "<strong>{{ $search }}</strong>" - Ditemukan {{ $teachers->count() }} akun
                    </div>
                @endif
            </div>

            <!-- Main Table -->
            <div class="table-container">
                <table class="w-full">
                    <thead class="table-header">
                        <tr>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>NAMA LENGKAP</th>
                            <th>ROLE</th>
                            <th>NIP</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $teacher)
                        <tr class="table-row">
                            <td class="table-cell">
                                <div class="user-info">
                                    @if($teacher->profile_picture)
                                        <img src="{{ asset('storage/profile-pictures/' . $teacher->profile_picture) }}"
                                             alt="{{ $teacher->username }}"
                                             class="profile-pic"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="profile-pic-placeholder" style="display: none;">
                                            {{ strtoupper(substr($teacher->username, 0, 1)) }}
                                        </div>
                                    @else
                                        <div class="profile-pic-placeholder">
                                            {{ strtoupper(substr($teacher->username, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span>{{ $teacher->username }}</span>
                                </div>
                            </td>
                            <td class="table-cell">{{ $teacher->password_display }}</td>
                            <td class="table-cell">{{ $teacher->nama_lengkap }}</td>
                            <td class="table-cell">{{ ucfirst($teacher->role) }}</td>
                            <td class="table-cell">{{ $teacher->nip ?? '-' }}</td>
                            <td class="table-cell">
                                <!-- View Detail Button -->
                                <button onclick="openUserModal({{ $teacher->id_pengguna }})" class="action-btn btn-view" title="Lihat Detail">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>

                                @if(auth()->user()->role === 'admin')
                                    <!-- Edit Button -->
                                    <a href="{{ route('akun.edit', $teacher->id_pengguna) }}" class="action-btn btn-edit" title="Edit">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('akun.destroy', $teacher->id_pengguna) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete" title="Hapus">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="table-cell text-center text-gray-500 py-8">
                                Belum ada data guru
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- User Detail Modal -->
    <div id="userModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 py-4">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" onclick="closeUserModal()"></div>

            <!-- Modal panel -->
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-3xl shadow-xl sm:align-middle sm:max-w-4xl sm:w-full relative">
                <div class="flex bg-white">
                    <!-- Left Side - Profile Info -->
                    <div class="w-1/2 p-12">
                        <h2 class="mb-8 text-4xl font-bold text-gray-900">Profile</h2>

                        <div class="flex items-center space-x-6">
                            <!-- Profile Photo -->
                            <div class="flex-shrink-0">
                                <div class="w-32 h-32 overflow-hidden bg-gray-200 rounded-3xl" id="modalProfilePicture">
                                    <!-- Dynamic content will be inserted here -->
                                </div>
                            </div>

                            <!-- Name and Role -->
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900" id="modalName"></h3>
                                <p class="mt-1 text-lg text-gray-600" id="modalRole"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Details -->
                    <div class="w-1/2 p-12 bg-gray-50">
                        <div class="space-y-6">
                            <!-- Nama Lengkap & NIP -->
                            <div class="flex space-x-4">
                                <div class="flex-1">
                                    <label class="block mb-2 text-sm font-semibold text-gray-900">Nama Lengkap</label>
                                    <div class="px-4 py-3 bg-white rounded-lg">
                                        <p class="text-sm text-gray-700" id="modalNamaLengkap"></p>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label class="block mb-2 text-sm font-semibold text-gray-900">NIP</label>
                                    <div class="px-4 py-3 bg-white rounded-lg">
                                        <p class="text-sm text-gray-700" id="modalNip"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Username & Role -->
                            <div class="flex space-x-4">
                                <div class="flex-1">
                                    <label class="block mb-2 text-sm font-semibold text-gray-900">Username</label>
                                    <div class="px-4 py-3 bg-white rounded-lg">
                                        <p class="text-sm text-gray-700" id="modalUsername"></p>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label class="block mb-2 text-sm font-semibold text-gray-900">Role</label>
                                    <div class="px-4 py-3 bg-white rounded-lg">
                                        <p class="text-sm text-gray-700" id="modalRoleText"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Close Button -->
                <div class="absolute top-4 right-4">
                    <button type="button" onclick="closeUserModal()" class="p-2 text-gray-400 transition-colors rounded-full hover:text-gray-600 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Simpan data guru untuk modal
        const teachersData = @json($teachers->keyBy('id_pengguna'));

        function openUserModal(userId) {
            const teacher = teachersData[userId];
            if (!teacher) return;

            // Isi modal dengan data guru
            document.getElementById('modalName').textContent = teacher.nama_lengkap;
            document.getElementById('modalRole').textContent = teacher.role.charAt(0).toUpperCase() + teacher.role.slice(1);
            document.getElementById('modalNamaLengkap').textContent = teacher.nama_lengkap;
            document.getElementById('modalNip').textContent = teacher.nip || 'N/A';
            document.getElementById('modalUsername').textContent = teacher.username;
            document.getElementById('modalRoleText').textContent = teacher.role.charAt(0).toUpperCase() + teacher.role.slice(1);

            // Set foto profil
            const profilePicContainer = document.getElementById('modalProfilePicture');
            if (teacher.profile_picture) {
                profilePicContainer.innerHTML = `
                    <img src="/storage/profile-pictures/${teacher.profile_picture}"
                         alt="${teacher.username}"
                         class="object-cover w-full h-full"
                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\\'flex items-center justify-center w-full h-full bg-gray-300\\'><svg class=\\'w-16 h-16 text-gray-500\\' fill=\\'none\\' stroke=\\'currentColor\\' viewBox=\\'0 0 24 24\\'><path stroke-linecap=\\'round\\' stroke-linejoin=\\'round\\' stroke-width=\\'2\\' d=\\'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\\'></path></svg></div>';">
                `;
            } else {
                profilePicContainer.innerHTML = `
                    <div class="flex items-center justify-center w-full h-full bg-gray-300">
                        <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                `;
            }

            // Tampilkan modal
            document.getElementById('userModal').classList.remove('hidden');
        }

        function closeUserModal() {
            document.getElementById('userModal').classList.add('hidden');
        }

        // Tutup modal dengan tombol Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeUserModal();
            }
        });
    </script>
    @endpush
</x-app-custom>
