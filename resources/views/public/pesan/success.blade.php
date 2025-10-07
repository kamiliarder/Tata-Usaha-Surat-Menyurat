@extends('public.layout')

@section('title', 'Surat Berhasil Dikirim')

@push('styles')
<style>
    .success-gradient {
        background: linear-gradient(135deg, #bdffc0 0%, #bdffc0 100%);
    }

    .success-icon-bg {
        background: linear-gradient(135deg, #dafddc 0%, #bdffc0 10%);
    }

    .success-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

    .step-circle {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    }

    .info-card {
        border: 0.1rem solid black;
    }

    .top-info-card {
        background: linear-gradient(135deg, #dafddc 0%, #bdffc0 10%);
        border: 1px solid #bdffc0;
    }

    .contact-card {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Success Card -->
        <div class="success-card rounded-3xl shadow-2xl p-8 md:p-12">
            <div class="text-center">
                <!-- Success Icon -->
                <div class="mx-auto flex items-center justify-center rounded-full success-icon-bg mb-8 shadow-lg" style="width: 7rem; height: 7rem;">
                    <svg class="h-16 w-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <!-- Success Message -->
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Surat Berhasil Dikirim!</h1>

                @if(session('success'))
                    <div class="top-info-card rounded-xl p-6 mb-8">
                        <p class="text-green-600 font-medium text-lg">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="max-w-2xl mx-auto mb-8">
                    <p class="text-xl text-gray-600 leading-relaxed">
                        Terima kasih telah menggunakan sistem Tata Usaha Telkom Schools Banjarbaru.
                        Surat Anda akan segera diproses oleh tim yang berwenang.
                    </p>
                </div>
            </div>

            <!-- Process Steps -->
            <div class="info-card rounded-2xl p-8 mb-8">
                <h3 class="text-2xl font-bold text-red-900 mb-8 text-center">Apa yang akan terjadi selanjutnya?</h3>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="step-circle h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <span class="text-2xl font-bold text-white">1</span>
                        </div>
                        <h4 class="font-semibold text-red-900 mb-2 text-lg">Tinjauan Tim</h4>
                        <p class="text-red-700 text-sm leading-relaxed">Tim kami akan meninjau dan memverifikasi surat Anda sesuai kategori</p>
                    </div>

                    <div class="text-center">
                        <div class="step-circle h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <span class="text-2xl font-bold text-white">2</span>
                        </div>
                        <h4 class="font-semibold text-red-900 mb-2 text-lg">Proses Admin</h4>
                        <p class="text-red-700 text-sm leading-relaxed">Surat akan diproses sesuai dengan kategori dan tingkat urgensitas</p>
                    </div>

                    <div class="text-center">
                        <div class="step-circle h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <span class="text-2xl font-bold text-white">3</span>
                        </div>
                        <h4 class="font-semibold text-red-900 mb-2 text-lg">Respon & Tindak Lanjut</h4>
                        <p class="text-red-700 text-sm leading-relaxed">Kami akan menghubungi Anda melalui kontak yang telah disediakan</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10">
                <a href="{{ route('public.pesan.create') }}"
                   class="inline-flex items-center justify-center px-8 py-4 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Kirim Surat Lain
                </a>

                <a href="/"
                   class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200 border-2 border-gray-200 hover:border-gray-300">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Contact Information -->
           <div class="contact-card rounded-2xl p-8 border mt-8">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Butuh Bantuan?</h3>
                    <p class="text-gray-600 mb-8 max-w-lg mx-auto">
                        Jika Anda memerlukan bantuan atau memiliki pertanyaan, jangan ragu untuk menghubungi
                        Tim Tata Usaha Telkom Schools Banjarbaru.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-6 max-w-2xl mx-auto">
                        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow flex-1">
                            <div class="flex items-center justify-center mb-3">
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                            <p class="text-gray-600 text-sm">tatausaha@telkomschools.sch.id</p>
                        </div>

                        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow flex-1">
                            <div class="flex items-center justify-center mb-3">
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                 </div>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Telepon</h4>
                            <p class="text-gray-600 text-sm">(0511) 123-4567</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
