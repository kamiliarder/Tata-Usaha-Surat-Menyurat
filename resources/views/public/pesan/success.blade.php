@extends('public.layout')

@section('title', 'Surat Berhasil Dikirim')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="text-center">
        <!-- Success Icon -->
        <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6">
            <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Success Message -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Surat Berhasil Dikirim!</h1>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="prose prose-lg text-gray-600 mb-8">
            <p>Terima kasih telah mengirim surat melalui sistem kami. Surat Anda akan segera diproses oleh tim yang berwenang.</p>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Apa yang akan terjadi selanjutnya?</h3>
                <ul class="text-left text-blue-800 space-y-2">
                    <li class="flex items-start">
                        <span class="font-bold mr-2">1.</span>
                        <span>Tim kami akan meninjau surat Anda</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-bold mr-2">2.</span>
                        <span>Surat akan diproses sesuai dengan kategori dan urgensitas</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-bold mr-2">3.</span>
                        <span>Kami akan menghubungi Anda melalui kontak yang telah disediakan</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('public.pesan.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Kirim Surat Lain
            </a>

            <a href="/"
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Kembali ke Beranda
            </a>
        </div>

        <!-- Contact Information -->
        <div class="mt-12 bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Butuh Bantuan?</h3>
            <p class="text-gray-600 mb-4">Jika Anda memerlukan bantuan atau memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>

            <div class="flex flex-col sm:flex-row gap-4 text-sm text-gray-600">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>admin@sekolah.id</span>
                </div>

                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span>(021) 123-4567</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
