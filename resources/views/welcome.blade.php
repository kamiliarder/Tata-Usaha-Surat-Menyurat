@extends('public.layout')

@section('title', 'Selamat Datang')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
            Sistem Tata Usaha<br>
            <span class="text-blue-600">Surat Menyurat</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
            Platform digital untuk mengelola surat masuk dan keluar di lingkungan sekolah.
            Kirim surat Anda dengan mudah dan pantau prosesnya secara real-time.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('public.pesan.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-lg text-lg transition duration-200 shadow-lg hover:shadow-xl">
                📧 Kirim Surat Sekarang
            </a>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-4 px-8 rounded-lg text-lg transition duration-200">
                        🏠 Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-4 px-8 rounded-lg text-lg transition duration-200">
                        🔐 Login Staff
                    </a>
                @endauth
            @endif
        </div>
    </div>

    <!-- Features Section -->
    <div class="grid md:grid-cols-3 gap-8 mb-16">
        <div class="text-center p-6 bg-white rounded-lg shadow-md">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Kirim Surat</h3>
            <p class="text-gray-600">Kirim surat atau pesan ke sekolah dengan mudah melalui form online</p>
        </div>

        <div class="text-center p-6 bg-white rounded-lg shadow-md">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Proses Cepat</h3>
            <p class="text-gray-600">Surat Anda akan diproses dengan cepat oleh tim yang berwenang</p>
        </div>

        <div class="text-center p-6 bg-white rounded-lg shadow-md">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Komunikasi Lancar</h3>
            <p class="text-gray-600">Dapatkan balasan langsung melalui WhatsApp atau email</p>
        </div>
    </div>

    <!-- How it Works Section -->
    <div class="bg-gray-50 rounded-lg p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-8">Cara Kerja</h2>

        <div class="grid md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-lg">1</div>
                <h4 class="font-semibold text-gray-900 mb-2">Isi Form</h4>
                <p class="text-sm text-gray-600">Lengkapi form pengiriman surat dengan data yang diperlukan</p>
            </div>

            <div class="text-center">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-lg">2</div>
                <h4 class="font-semibold text-gray-900 mb-2">Kirim Surat</h4>
                <p class="text-sm text-gray-600">Sistem akan memberikan nomor surat dan meneruskan ke pihak terkait</p>
            </div>

            <div class="text-center">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-lg">3</div>
                <h4 class="font-semibold text-gray-900 mb-2">Proses Admin</h4>
                <p class="text-sm text-gray-600">Tim admin akan meninjau dan memproses surat Anda</p>
            </div>

            <div class="text-center">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-lg">4</div>
                <h4 class="font-semibold text-gray-900 mb-2">Terima Balasan</h4>
                <p class="text-sm text-gray-600">Dapatkan balasan melalui kontak yang Anda berikan</p>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Kategori Surat</h2>

        <div class="grid md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition duration-200">
                <div class="text-2xl mb-2">📚</div>
                <div class="text-sm font-medium text-gray-700">Akademik</div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition duration-200">
                <div class="text-2xl mb-2">👥</div>
                <div class="text-sm font-medium text-gray-700">Kesiswaan</div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition duration-200">
                <div class="text-2xl mb-2">💰</div>
                <div class="text-sm font-medium text-gray-700">Keuangan</div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition duration-200">
                <div class="text-2xl mb-2">🏗️</div>
                <div class="text-sm font-medium text-gray-700">Sarpras</div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition duration-200">
                <div class="text-2xl mb-2">📋</div>
                <div class="text-sm font-medium text-gray-700">Non Akademik</div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition duration-200">
                <div class="text-2xl mb-2">📄</div>
                <div class="text-sm font-medium text-gray-700">Umum</div>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('public.pesan.create') }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                Mulai kirim surat →
            </a>
        </div>
    </div>
</div>
@endsection
    </body>
</html>
