@extends('layouts.admin')

@section('title', 'Manajemen Akun Guru')

@push('styles')
<style>
    .page-header {
        background-color: #ffffff;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem 0;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .content-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background-color: #b91c1c;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-add:hover {
        background-color: #991b1b;
    }

    .table-container {
        background-color: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background-color: #64748b;
    }

    .data-table thead th {
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        padding: 1rem;
        text-align: left;
        border-right: 1px solid #94a3b8;
    }

    .data-table thead th:last-child {
        border-right: none;
    }

    .data-table tbody tr {
        border-bottom: 1px solid #e5e7eb;
    }

    .data-table tbody tr:last-child {
        border-bottom: none;
    }

    .data-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .data-table tbody td {
        padding: 1rem;
        color: #374151;
        font-size: 0.875rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .btn-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: transform 0.2s, opacity 0.2s;
    }

    .btn-icon:hover {
        transform: scale(1.1);
        opacity: 0.8;
    }

    .btn-view {
        background-color: #3b82f6;
    }

    .btn-edit {
        background-color: #10b981;
    }

    .btn-delete {
        background-color: #ef4444;
    }

    .icon-white {
        color: white;
        font-size: 0.875rem;
    }

    .footer {
        text-align: center;
        padding: 2rem 0;
        color: #9ca3af;
        font-size: 0.875rem;
        margin-top: 4rem;
    }

    @media (max-width: 1200px) {
        .table-container {
            overflow-x: auto;
        }

        .data-table {
            min-width: 1000px;
        }
    }
</style>
@endpush

@section('content')
<x-custom-navigation />

<div class="page-header">
    <div class="content-wrapper">
        <h1 class="page-title">Manajemen Akun Guru - Tata Usaha Telkom Schools Banjarbaru</h1>
    </div>
</div>

<div class="content-wrapper">
    <div class="section-header">
        <h2 class="section-title">Semua Akun Guru</h2>
        <button class="btn-add">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Akun Baru
        </button>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                    <th>NAMA LENGKAP</th>
                    <th>JABATAN</th>
                    <th>NIP</th>
                    <th>JENIS KELAMIN</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers ?? [] as $teacher)
                <tr>
                    <td>{{ $teacher->username }}</td>
                    <td>{{ $teacher->password_display }}</td>
                    <td>{{ $teacher->nama_lengkap }}</td>
                    <td>{{ $teacher->jabatan }}</td>
                    <td>{{ $teacher->nip }}</td>
                    <td>{{ $teacher->jenis_kelamin }}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon btn-view" title="Lihat Detail">
                                <svg class="icon-white" width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn-icon btn-edit" title="Edit">
                                <svg class="icon-white" width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </button>
                            <button class="btn-icon btn-delete" title="Hapus">
                                <svg class="icon-white" width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">
                        Belum ada data guru
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="footer">
    © 2025 Sistem Tata Usaha Surat Menyurat Sekolah. All rights reserved.
</div>
@endsection
