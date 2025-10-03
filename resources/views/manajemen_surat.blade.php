<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Surat - Tata Usaha Telkom Schools Banjarbaru</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Afacad', sans-serif;
            background-color: #e5e5e5;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: #ffffff;
            padding: 15px 30px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-top {
            display: flex;
            align-items: center;
            gap: 40px;
            width: 100%;
            padding-bottom: 15px;
        }

        .nav-links img {
            width: auto;
            height: 30px; /* Reduced from original height */
            vertical-align: middle;
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
            align-items: center;
        }

        .nav-links li {
            position: relative;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 24px;
            transition: border-bottom 0.3s;
            padding-bottom: 5px;
            display: block;
        }

        .nav-links a:hover {
            border-bottom: 3px solid #b71c1c;
        }

        .nav-links a.active {
            border-bottom: 3px solid #b71c1c;
        }

        .navbar-divider {
            width: 100%;
            height: 1px;
            background-color: #e0e0e0;
            margin: 0;
            border: none;
        }

        /* Page Title */
        .page-title {
            background-color: #ffffff;
            padding: 20px 30px;
            font-size: 20px;
            font-weight: 600;
            color: #000;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Search Box */
        .search-box {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .search-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .search-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .search-group {
            display: flex;
            flex-direction: column;
        }

        .search-group label {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .search-input {
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Afacad', sans-serif;
        }

        .search-input::placeholder {
            color: #999;
        }

        select.search-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            cursor: pointer;
        }

        /* Table */
        .table-container {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #7a7a7a;
            color: #ffffff;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 16px;
        }

        tbody tr {
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        td {
            padding: 15px;
            font-size: 15px;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .badge-blue {
            background-color: #b3d9ff;
            color: #0066cc;
        }

        .badge-green {
            background-color: #90c695;
            color: #ffffff;
        }

        /* Action Icons */
        .action-icons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .action-icon {
            cursor: pointer;
            font-size: 20px;
            transition: transform 0.2s;
        }

        .action-icon:hover {
            transform: scale(1.2);
        }

        .icon-view {
            color: #0066cc;
        }

        .icon-edit {
            color: #4caf50;
        }

        .icon-delete {
            color: #f44336;
        }

        /* Modal Overlay */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        /* Modal Content */
        .modal {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        }

        .modal-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Radio Options */
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .radio-option input[type="radio"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .radio-option label {
            font-size: 18px;
            cursor: pointer;
        }

        /* Confirm Delete Modal */
        .confirm-text {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        /* Modal Buttons */
        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            padding: 12px 40px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Afacad', sans-serif;
            border: 2px solid;
        }

        .btn-cancel {
            background-color: #ffffff;
            color: #b71c1c;
            border-color: #b71c1c;
        }

        .btn-cancel:hover {
            background-color: #fff5f5;
        }

        .btn-confirm {
            background-color: #b71c1c;
            color: #ffffff;
            border-color: #b71c1c;
        }

        .btn-confirm:hover {
            background-color: #8b0000;
        }

        @media (max-width: 1024px) {
            .search-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-top">
            <ul class="nav-links">
                <div class="logo-container">
                    <img src="{{ asset('images/logo.png') }}" alt="Telkom Schools Logo">
                </div>
                <li><a href="#dashboard" class="nav-link">Dashboard</a></li>
                <li><a href="#surat" class="nav-link active">Surat</a></li>
                <li><a href="#laporan" class="nav-link">Laporan</a></li>
            </ul>
        </div>
        <hr class="navbar-divider">
    </nav>

    <!-- Page Title -->
    <div class="page-title">
        Manajemen Surat
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Search Box -->
        <div class="search-box">
            <div class="search-grid">
                <div class="search-group">
                    <label>Pencarian</label>
                    <input type="text" class="search-input" placeholder="Cari judul atau nomor surat">
                </div>
                <div class="search-group">
                    <label>Kategori</label>
                    <select class="search-input">
                        <option>Semua Kategori</option>
                        <option>Akademik</option>
                        <option>Kesiswaan</option>
                        <option>Keuangan</option>
                        <option>Umum</option>
                        <option>Non Akademik</option>
                        <option>Sarpras</option>
                    </select>
                </div>
                <div class="search-group">
                    <label>Tipe</label>
                    <select class="search-input">
                        <option>Semua Tipe</option>
                        <option>Masuk</option>
                        <option>Keluar</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>NOMOR SURAT</th>
                        <th>JUDUL</th>
                        <th>KATEGORI</th>
                        <th>TIPE</th>
                        <th>TANGGAL</th>
                        <th>PENGIRIM</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>KLR/20250922/001</td>
                        <td>Undangan Rapat Koodinasi Semester Genap</td>
                        <td><span class="badge badge-blue">Kesiswaan</span></td>
                        <td><span class="badge badge-green">Masuk</span></td>
                        <td>22/09/2025</td>
                        <td>Staff Kesiswaan</td>
                        <td>
                            <div class="action-icons">
                                <span class="iconify action-icon icon-view" data-icon="mdi:eye"></span>
                                <span class="iconify action-icon icon-edit" data-icon="mdi:pencil" onclick="openEditModal()"></span>
                                <span class="iconify action-icon icon-delete" data-icon="mdi:delete" onclick="openDeleteModal()"></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>KLR/20250922/001</td>
                        <td>Undangan Rapat Koodinasi Semester Genap</td>
                        <td><span class="badge badge-blue">Kesiswaan</span></td>
                        <td><span class="badge badge-green">Masuk</span></td>
                        <td>22/09/2025</td>
                        <td>Staff Kesiswaan</td>
                        <td>
                            <div class="action-icons">
                                <span class="iconify action-icon icon-view" data-icon="mdi:eye"></span>
                                <span class="iconify action-icon icon-edit" data-icon="mdi:pencil" onclick="openEditModal()"></span>
                                <span class="iconify action-icon icon-delete" data-icon="mdi:delete" onclick="openDeleteModal()"></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>KLR/20250922/001</td>
                        <td>Undangan Rapat Koodinasi Semester Genap</td>
                        <td><span class="badge badge-blue">Kesiswaan</span></td>
                        <td><span class="badge badge-green">Masuk</span></td>
                        <td>22/09/2025</td>
                        <td>Staff Kesiswaan</td>
                        <td>
                            <div class="action-icons">
                                <span class="iconify action-icon icon-view" data-icon="mdi:eye"></span>
                                <span class="iconify action-icon icon-edit" data-icon="mdi:pencil" onclick="openEditModal()"></span>
                                <span class="iconify action-icon icon-delete" data-icon="mdi:delete" onclick="openDeleteModal()"></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>KLR/20250922/001</td>
                        <td>Undangan Rapat Koodinasi Semester Genap</td>
                        <td><span class="badge badge-blue">Kesiswaan</span></td>
                        <td><span class="badge badge-green">Masuk</span></td>
                        <td>22/09/2025</td>
                        <td>Staff Kesiswaan</td>
                        <td>
                            <div class="action-icons">
                                <span class="iconify action-icon icon-view" data-icon="mdi:eye"></span>
                                <span class="iconify action-icon icon-edit" data-icon="mdi:pencil" onclick="openEditModal()"></span>
                                <span class="iconify action-icon icon-delete" data-icon="mdi:delete" onclick="openDeleteModal()"></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>KLR/20250922/001</td>
                        <td>Undangan Rapat Koodinasi Semester Genap</td>
                        <td><span class="badge badge-blue">Kesiswaan</span></td>
                        <td><span class="badge badge-green">Masuk</span></td>
                        <td>22/09/2025</td>
                        <td>Staff Kesiswaan</td>
                        <td>
                            <div class="action-icons">
                                <span class="iconify action-icon icon-view" data-icon="mdi:eye"></span>
                                <span class="iconify action-icon icon-edit" data-icon="mdi:pencil" onclick="openEditModal()"></span>
                                <span class="iconify action-icon icon-delete" data-icon="mdi:delete" onclick="openDeleteModal()"></span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit Status -->
    <div class="modal-overlay" id="editModal">
        <div class="modal">
            <h2 class="modal-title">Edit Status Surat</h2>
            <div class="radio-group">
                <div class="radio-option">
                    <input type="radio" id="diterima" name="status" value="diterima" checked>
                    <label for="diterima">Diterima</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="proses" name="status" value="proses">
                    <label for="proses">Dalam Proses</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="perbaikan" name="status" value="perbaikan">
                    <label for="perbaikan">Perlu Perbaikan</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="disetujui" name="status" value="disetujui">
                    <label for="disetujui">Disetujui</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="ditolak" name="status" value="ditolak">
                    <label for="ditolak">Ditolak</label>
                </div>
            </div>
            <div class="modal-buttons">
                <button class="btn btn-cancel" onclick="closeEditModal()">Batal</button>
                <button class="btn btn-confirm" onclick="saveStatus()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">
            <p class="confirm-text">Yakin ingin hapus surat?</p>
            <div class="modal-buttons">
                <button class="btn btn-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn btn-confirm" onclick="confirmDelete()">Ya, hapus surat</button>
            </div>
        </div>
    </div>

    <script>
        // Navigation Active State
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all links
                document.querySelectorAll('.nav-link').forEach(l => {
                    l.classList.remove('active');
                });

                // Add active class to clicked link
                this.classList.add('active');
            });
        });

        // Edit Modal Functions
        function openEditModal() {
            document.getElementById('editModal').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }

        function saveStatus() {
            const selectedStatus = document.querySelector('input[name="status"]:checked').value;
            alert('Status diubah menjadi: ' + selectedStatus);
            closeEditModal();
        }

        // Delete Modal Functions
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
        }

        function confirmDelete() {
            alert('Surat berhasil dihapus!');
            closeDeleteModal();
        }

        // Close modal when clicking outside
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
