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
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="space-y-8">
                <!-- Header -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Telkom Schools Logo" class="w-12 h-12">
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                                Tata Usaha
                            </h1>
                            <p class="text-xl text-red-600 font-semibold">
                                Telkom Schools Banjarbaru
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-4">
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Selamat datang di sistem administrasi surat Telkom Schoolss Banjarbaru.
                        Tata Usaha bertanggung jawab dalam mengelola seluruh korespondensi dan
                        administrasi sekolah dengan efisien dan terorganisir.
                    </p>
                    <p class="text-gray-600 mb-8">
                        Sistem ini memudahkan proses pengiriman, penerimaan, dan tracking surat
                        untuk memastikan komunikasi yang lancar antara sekolah dan pihak eksternal.
                    </p>
                    <blockquote class="bg-gray-100 border-l-4 border-red-600 px-4 py-3 my-6 rounded shadow-sm">
                        <p class="text-gray-700 italic text-base">
                            "Streamlining Correspondence, Empowering Administration."
                        </p>
                    </blockquote>
                </div>

                <!-- Action Button -->
                <div class="pt-4">
                    <a href="{{ route('public.pesan.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors shadow-lg hover:shadow-xl transform hover:scale-105 transition-transform">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Kirim Surat Sekarang
                    </a>
                </div>
            </div>

            <!-- Right Content - Recent Letters -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Surat Terbaru</h2>
                    <span class="text-sm text-gray-500">{{ $recentLetters->count() }} surat</span>
                </div>

                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @forelse($recentLetters as $letter)
                        <div class="letter-item p-4 border border-gray-200 rounded-lg">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900 text-sm leading-tight">
                                        {{ Str::limit($letter->judul, 40) }}
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">
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

                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    @if($letter->tipe == 'masuk')
                                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full"></span>
                                        <span class="text-xs text-green-600 font-medium">Masuk</span>
                                    @else
                                        <span class="inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                                        <span class="text-xs text-red-600 font-medium">Keluar</span>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-400">
                                    {{ $letter->tanggal_kirim->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">Belum ada surat terbaru</p>
                        </div>
                    @endforelse
                </div>

                @if($recentLetters->count() > 0)
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('login') }}" class="block text-center text-red-600 hover:text-red-700 font-medium text-sm">
                            Login Staff untuk Lihat Semua Surat →
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Cara Kerja</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
                    Sistem surat digital yang memudahkan komunikasi antara sekolah dan pihak eksternal
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 text-white rounded-full mb-6">
                        <span class="text-xl font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Kirim Surat</h3>
                    <p class="text-gray-600">
                        Isi formulir pengiriman surat dengan lengkap. Lampirkan dokumen pendukung jika diperlukan.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 text-white rounded-full mb-6">
                        <span class="text-xl font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Verifikasi Tim</h3>
                    <p class="text-gray-600">
                        Tim Tata Usaha akan memverifikasi dan memproses surat sesuai dengan kategori dan prioritas.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 text-white rounded-full mb-6">
                        <span class="text-xl font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Respon Cepat</h3>
                    <p class="text-gray-600">
                        Dapatkan balasan dari kontak yang anda berikan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
