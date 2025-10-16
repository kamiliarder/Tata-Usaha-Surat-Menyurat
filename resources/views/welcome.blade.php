@extends('public.layout')

@section('title', 'Selamat Datang')

@push('styles')
<style>
    .hero-gradient {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    }

    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: capitalize;
    }

    .status-pending { background-color: #fef3c7; color: #92400e; }
    .status-diterima { background-color: #dbeafe; color: #1e40af; }
    .status-dalam_proses { background-color: #e0e7ff; color: #3730a3; }
    .status-perlu_perbaikan { background-color: #fee2e2; color: #dc2626; }
    .status-disetujui { background-color: #d1fae5; color: #065f46; }
    .status-ditolak { background-color: #fce7f3; color: #be185d; }

    .letter-item {
        transition: all 0.2s ease;
    }

    .letter-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .hero-illustration {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Cdefs%3E%3ClinearGradient id='grad1' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%23dc2626;stop-opacity:0.1' /%3E%3Cstop offset='100%25' style='stop-color:%23b91c1c;stop-opacity:0.2' /%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='400' height='300' fill='url(%23grad1)'/%3E%3Ccircle cx='320' cy='80' r='60' fill='%23dc2626' opacity='0.1'/%3E%3Ccircle cx='80' cy='220' r='40' fill='%23b91c1c' opacity='0.1'/%3E%3C/svg%3E");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    /* Step connector lines */
    @media (min-width: 768px) {
        .step-connector::after {
            content: '';
            position: absolute;
            top: 32px; /* Half of step circle height (64px/2) */
            right: -50%;
            width: 100%;
            height: 2px;
            border-top: 2px dashed #fca5a5; /* red-300 */
            z-index: 1;
        }

        .step-connector:last-child::after {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <!-- Hero Section -->
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            <!-- Left Content -->
            <div class="space-y-8">
                <!-- Header -->
                <div>
                    <div class="flex items-center mb-4 space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Telkom Schools Logo" class="w-12 h-12">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 md:text-4xl">
                                Tata Usaha
                            </h1>
                            <p class="text-xl font-semibold text-red-600">
                                Telkom Schools Banjarbaru
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-4">
                    <p class="text-lg leading-relaxed text-gray-600">
                        Selamat datang di sistem administrasi surat Telkom Schoolss Banjarbaru.
                        Tata Usaha bertanggung jawab dalam mengelola seluruh korespondensi dan
                        administrasi sekolah dengan efisien dan terorganisir.
                    </p>
                    <p class="mb-8 text-gray-600">
                        Sistem ini memudahkan proses pengiriman, penerimaan, dan tracking surat
                        untuk memastikan komunikasi yang lancar antara sekolah dan pihak eksternal.
                    </p>
                    <blockquote class="px-4 py-3 my-6 bg-gray-100 border-l-4 border-red-600 rounded shadow-sm">
                        <p class="text-base italic text-gray-700">
                            "Streamlining Correspondence, Empowering Administration."
                        </p>
                    </blockquote>
                </div>

                <!-- Action Button -->
                <div class="pt-4">
                    <a href="{{ route('public.pesan.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-red-800 text-white font-semibold rounded-lg hover:bg-red-900 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Kirim Surat Sekarang
                    </a>
                </div>
            </div>

            <!-- Right Content - Recent Letters -->
            <div class="p-6 bg-white shadow-xl rounded-2xl">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Surat Terbaru</h2>
                    <span class="text-sm text-gray-500">{{ $recentLetters->count() }} surat</span>
                </div>

                <div class="space-y-4 overflow-y-auto max-h-96">
                    @forelse($recentLetters as $letter)
                        <div class="p-4 border border-gray-200 rounded-lg letter-item">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex-1">
                                    <h3 class="text-sm font-medium leading-tight text-gray-900">
                                        {{ Str::limit($letter->judul, 40) }}
                                    </h3>
                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $letter->nomor_pesan }}
                                    </p>
                                </div>
                                <span class="status-badge status-{{ $letter->status_pesan }} text-xs ml-3 shrink-0">
                                    @switch($letter->status_pesan)
                                        @case('pending')
                                            Pending
                                            @break
                                        @case('diterima')
                                            Diterima
                                            @break
                                        @case('dalam_proses')
                                            Dalam Proses
                                            @break
                                        @case('perlu_perbaikan')
                                            Perlu Perbaikan
                                            @break
                                        @case('disetujui')
                                            Disetujui
                                            @break
                                        @case('ditolak')
                                            Ditolak
                                            @break
                                        @default
                                            {{ ucfirst(str_replace('_', ' ', $letter->status_pesan)) }}
                                    @endswitch
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    @if($letter->tipe == 'masuk')
                                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full"></span>
                                        <span class="text-xs font-medium text-green-600">Masuk</span>
                                    @else
                                        <span class="inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                                        <span class="text-xs font-medium text-red-600">Keluar</span>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-400">
                                    {{ $letter->tanggal_kirim->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-sm text-gray-500">Belum ada surat terbaru</p>
                        </div>
                    @endforelse
                </div>

                @if($recentLetters->count() > 0)
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('login') }}" class="block text-center text-red-800 hover:text-red-900 font-medium text-sm">
                            Login Staff untuk Lihat Semua Surat →
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="py-16 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-gray-900">Cara Kerja</h2>
                <p class="max-w-2xl mx-auto mb-8 text-lg text-gray-600">
                    Sistem surat digital yang memudahkan komunikasi antara sekolah dan pihak eksternal
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="text-center relative step-connector">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-800 text-white rounded-full mb-6 relative z-10">
                        <span class="text-xl font-bold">1</span>
                    </div>

                <!-- Step 2 -->
                <div class="text-center relative step-connector">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-800 text-white rounded-full mb-6 relative z-10">
                        <span class="text-xl font-bold">2</span>
                    </div>

                <!-- Step 3 -->
                <div class="text-center relative step-connector">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-800 text-white rounded-full mb-6 relative z-10">
                        <span class="text-xl font-bold">3</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
