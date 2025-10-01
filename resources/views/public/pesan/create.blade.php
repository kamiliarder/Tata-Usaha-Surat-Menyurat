@extends('public.layout')

@section('title', 'Kirim Surat')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Kirim Surat / Pesan</h1>
        <p class="mt-2 text-lg text-gray-600">Silakan isi form di bawah ini untuk mengirim surat atau pesan ke sekolah</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <form action="{{ route('public.pesan.store') }}" method="POST" enctype="multipart/form-data" id="pesanForm">
            @csrf

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Ada beberapa kesalahan:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6">
                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul Surat *</label>
                    <input type="text"
                           name="judul"
                           id="judul"
                           value="{{ old('judul') }}"
                           required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-300 @enderror"
                           placeholder="Masukkan judul surat">
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori dan Penerima -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori *</label>
                        <select name="kategori"
                                id="kategori"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('kategori') border-red-300 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="akademik" {{ old('kategori') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                            <option value="kesiswaan" {{ old('kategori') == 'kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                            <option value="keuangan" {{ old('kategori') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                            <option value="sarpras" {{ old('kategori') == 'sarpras' ? 'selected' : '' }}>Sarana Prasarana</option>
                            <option value="non_akademik" {{ old('kategori') == 'non_akademik' ? 'selected' : '' }}>Non Akademik</option>
                            <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penerima -->
                    <div>
                        <label for="id_penerima" class="block text-sm font-medium text-gray-700">Tujukan Kepada *</label>
                        <select name="id_penerima"
                                id="id_penerima"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('id_penerima') border-red-300 @enderror">
                            <option value="">Pilih kategori terlebih dahulu</option>
                        </select>
                        @error('id_penerima')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Perihal -->
                <div>
                    <label for="perihal" class="block text-sm font-medium text-gray-700">Isi Pesan / Perihal</label>
                    <textarea name="perihal"
                              id="perihal"
                              rows="4"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('perihal') border-red-300 @enderror"
                              placeholder="Jelaskan maksud dan tujuan surat Anda">{{ old('perihal') }}</textarea>
                    @error('perihal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data Pengirim -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Data Pengirim</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Pengirim -->
                        <div>
                            <label for="pengirim" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                            <input type="text"
                                   name="pengirim"
                                   id="pengirim"
                                   value="{{ old('pengirim') }}"
                                   required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('pengirim') border-red-300 @enderror"
                                   placeholder="Nama lengkap pengirim">
                            @error('pengirim')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kontak -->
                        <div>
                            <label for="kontak_pengirim" class="block text-sm font-medium text-gray-700">WhatsApp / Email *</label>
                            <input type="text"
                                   name="kontak_pengirim"
                                   id="kontak_pengirim"
                                   value="{{ old('kontak_pengirim') }}"
                                   required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('kontak_pengirim') border-red-300 @enderror"
                                   placeholder="08123456789 atau email@example.com">
                            @error('kontak_pengirim')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Instansi -->
                        <div>
                            <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi / Organisasi</label>
                            <input type="text"
                                   name="instansi"
                                   id="instansi"
                                   value="{{ old('instansi') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('instansi') border-red-300 @enderror"
                                   placeholder="Nama instansi atau organisasi">
                            @error('instansi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat_pengirim" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text"
                                   name="alamat_pengirim"
                                   id="alamat_pengirim"
                                   value="{{ old('alamat_pengirim') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('alamat_pengirim') border-red-300 @enderror"
                                   placeholder="Alamat lengkap">
                            @error('alamat_pengirim')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Lampiran -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Lampiran (Opsional)</h3>

                    <div>
                        <label for="lampiran" class="block text-sm font-medium text-gray-700">Upload File</label>
                        <input type="file"
                               name="lampiran[]"
                               id="lampiran"
                               multiple
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-xs text-gray-500">
                            Format yang diizinkan: PDF, DOC, DOCX, JPG, JPEG, PNG, GIF. Maksimal 10MB per file.
                        </p>
                        @error('lampiran.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Kirim Surat
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const kategoriSelect = document.getElementById('kategori');
    const penerimaSelect = document.getElementById('id_penerima');

    // Store all staff members data
    const staffData = @json($staffMembers);

    kategoriSelect.addEventListener('change', function() {
        const selectedKategori = this.value;

        // Clear current options
        penerimaSelect.innerHTML = '<option value="">Memuat...</option>';

        if (!selectedKategori) {
            penerimaSelect.innerHTML = '<option value="">Pilih kategori terlebih dahulu</option>';
            return;
        }

        // Fetch staff by division via AJAX for dynamic data
        fetch(`{{ route('public.pesan.staff-by-divisi') }}?divisi=${selectedKategori}`)
            .then(response => response.json())
            .then(data => {
                penerimaSelect.innerHTML = '<option value="">Pilih penerima</option>';

                data.forEach(staff => {
                    const option = document.createElement('option');
                    option.value = staff.id_pengguna;
                    option.textContent = `${staff.nama} (${staff.divisi})`;

                    // Maintain old selection if any
                    if ('{{ old("id_penerima") }}' == staff.id_pengguna) {
                        option.selected = true;
                    }

                    penerimaSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                penerimaSelect.innerHTML = '<option value="">Error memuat data</option>';
            });
    });

    // Trigger change event if kategori has old value
    if (kategoriSelect.value) {
        kategoriSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
