<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Tata Usaha Telkom Schools</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Custom Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Left side - Logo and Navigation -->
                <div class="flex items-center space-x-8">
                    <!-- Logo -->
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/mainLogo.png') }}" alt="Telkom Schools Logo" class="h-10 w-auto">
                    </div>

                    <!-- Navigation Links -->
                    <nav class="flex space-x-6">
                        <a href="{{ route('dashboard') }}" class="text-red-600 font-medium px-3 py-2 rounded-md bg-red-50">Dashboard</a>
                        <a href="#" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md hover:bg-gray-50">Surat</a>
                        <a href="#" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md hover:bg-gray-50">Akun Guru</a>
                    </nav>
                </div>

                <!-- Right side - User Menu -->
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="relative">
                        <button onclick="toggleDropdown()" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 p-2 rounded-md hover:bg-gray-50">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen bg-gray-50">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Title -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard - Tata Usaha Telkom Schools Banjarbaru</h1>
                </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Surat Masuk -->
                <div class="stats-card stats-card-red">
                    <div class="stats-content">
                        <div class="stats-text">
                            <h3>SURAT MASUK</h3>
                            <div class="stats-number">{{ $suratMasuk ?? 0 }}</div>
                        </div>
                        <div class="stats-icon stats-icon-red">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M3 8L10.89 13.26C11.2187 13.4793 11.6049 13.5963 12 13.5963C12.3951 13.5963 12.7813 13.4793 13.11 13.26L21 8M5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Surat Keluar -->
                <div class="stats-card stats-card-green">
                    <div class="stats-content">
                        <div class="stats-text">
                            <h3>SURAT KELUAR</h3>
                            <div class="stats-number">{{ $suratKeluar ?? 0 }}</div>
                        </div>
                        <div class="stats-icon stats-icon-green">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 19L7 14L8.41 12.59L11 15.17V4H13V15.17L15.59 12.59L17 14L12 19ZM5 21V19H19V21H5Z" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Surat Proses -->
                <div class="stats-card stats-card-yellow">
                    <div class="stats-content">
                        <div class="stats-text">
                            <h3>SURAT PROSES</h3>
                            <div class="stats-number">{{ $suratProses ?? 0 }}</div>
                        </div>
                        <div class="stats-icon stats-icon-yellow">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Statistics Chart -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Statistik Surat</h3>
                    </div>
                    <div class="card-content">
                        <canvas id="statistikChart" width="400" height="300"></canvas>
                    </div>
                </div>

                <!-- Recent Letters -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Surat Terbaru</h3>
                    </div>
                    <div class="card-content">
                        <div class="letter-list">
                            @if($recentLetters->count() > 0)
                                @foreach($recentLetters as $letter)
                                    <div class="letter-item">
                                        <div class="letter-content">
                                            <h4>{{ $letter->judul }}</h4>
                                            <p>{{ $letter->nomor_pesan }}</p>
                                            <p>{{ $letter->pengirim }}</p>
                                        </div>
                                        <div class="letter-status
                                            @if($letter->status_pesan == 'pending') status-follow-up
                                            @elseif($letter->status_pesan == 'disetujui') status-completed
                                            @elseif($letter->status_pesan == 'dalam_proses') status-follow-up
                                            @elseif($letter->status_pesan == 'ditolak') status-follow-up
                                            @else status-completed
                                            @endif">
                                            @if($letter->status_pesan == 'pending') Pending
                                            @elseif($letter->status_pesan == 'disetujui') Disetujui
                                            @elseif($letter->status_pesan == 'dalam_proses') Dalam Proses
                                            @elseif($letter->status_pesan == 'diterima') Diterima
                                            @elseif($letter->status_pesan == 'ditolak') Ditolak
                                            @elseif($letter->status_pesan == 'perlu_perbaikan') Perlu Perbaikan
                                            @else {{ ucfirst($letter->status_pesan) }}
                                            @endif
                                        </div>
                                        <div class="letter-time">
                                            {{ $letter->tanggal_kirim->diffForHumans() }}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="letter-item">
                                    <div class="letter-content">
                                        <h4>Belum ada surat</h4>
                                        <p>Tidak ada surat yang ditemukan</p>
                                        <p>-</p>
                                    </div>
                                    <div class="letter-status status-follow-up">-</div>
                                    <div class="letter-time">-</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button class="action-btn action-btn-red">
                        <svg class="action-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Surat Baru
                    </button>

                    <button class="action-btn action-btn-red">
                        <svg class="action-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Lihat Semua Surat
                    </button>

                    <button class="action-btn action-btn-red">
                        <svg class="action-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                        </svg>
                        Manajemen Akun Guru
                    </button>
                </div>
            </div>
            </div>
        </div>
    </main>

    <!-- Custom CSS -->
    <style>
        /* Stats Cards */
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-left: 4px solid;
            position: relative;
        }

        .stats-card-red {
            border-left-color: #ef4444;
        }

        .stats-card-green {
            border-left-color: #10b981;
        }

        .stats-card-yellow {
            border-left-color: #f59e0b;
        }

        .stats-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stats-text h3 {
            font-size: 14px;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .stats-number {
            font-size: 32px;
            font-weight: bold;
            color: #1f2937;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stats-icon-red {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .stats-icon-green {
            background-color: #d1fae5;
            color: #10b981;
        }

        .stats-icon-yellow {
            background-color: #fef3c7;
            color: #f59e0b;
        }

        /* Dashboard Cards */
        .dashboard-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }

        .card-content {
            padding: 24px;
        }

        /* Letter List */
        .letter-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .letter-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background: #f9fafb;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .letter-content h4 {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
            min-width: 200px;
        }

        .letter-content p {
            font-size: 12px;
            color: #6b7280;
            margin: 0;
        }

        .letter-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-completed {
            background-color: #d1fae5;
            color: #059669;
        }

        .status-follow-up {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .letter-time {
            font-size: 11px;
            color: #9ca3af;
            min-width: 80px;
            text-align: right;
        }

        /* Action Buttons */
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .action-btn-red {
            background-color: #dc2626;
            color: white;
        }

        .action-btn-red:hover {
            background-color: #b91c1c;
        }

        .action-btn-icon {
            width: 20px;
            height: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .letter-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .letter-content h4 {
                max-width: 200px;
            }

            .letter-time {
                text-align: left;
                min-width: auto;
            }
        }
    </style>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('statistikChart').getContext('2d');

            // Get real data from PHP
            const chartDataMasuk = @json($chartDataMasuk);
            const chartDataKeluar = @json($chartDataKeluar);

            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [{
                        label: 'Surat Masuk',
                        data: chartDataMasuk,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Surat Keluar',
                        data: chartDataKeluar,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    elements: {
                        point: {
                            radius: 4,
                            hoverRadius: 6
                        }
                    }
                }
            });
        });

        // Dropdown functionality
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const button = event.target.closest('button[onclick="toggleDropdown()"]');

            if (!button && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

        </div>
    </div>
</body>
</html>
