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
                                <a href="{{ route('akun.show', $teacher->id_pengguna) }}" class="action-btn btn-view" title="Lihat Detail">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>

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
</x-app-custom>
