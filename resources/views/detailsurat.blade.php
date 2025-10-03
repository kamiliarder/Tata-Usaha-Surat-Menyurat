<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Detail Surat - Tata Usaha Telkom Schools Banjarbaru</title>
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

        .logo-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .logo-container img {
            width: auto;
            height: 30px; /* Reduced size */
            vertical-align: middle;
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
            max-width: 900px;
            margin: 50px auto;
            padding: 0 20px;
        }

        /* Card */
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 40px;
            color: #000;
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px 40px;
            margin-bottom: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 10px;
            color: #000;
            font-size: 16px;
        }

        .form-group .value {
            padding: 10px 0;
            color: #666;
            font-size: 15px;
        }

        /* Perihal Section */
        .perihal-section {
            margin-bottom: 30px;
        }

        .perihal-section label {
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
            color: #000;
            font-size: 16px;
        }

        .perihal-content {
            color: #666;
            line-height: 1.6;
            font-size: 15px;
        }

        /* File Section */
        .file-section {
            margin-bottom: 30px;
        }

        .file-section label {
            font-weight: 600;
            margin-bottom: 15px;
            display: block;
            color: #000;
            font-size: 16px;
        }

        .file-box {
            border: 2px solid #ccc;
            border-radius: 8px;
            padding: 60px;
            text-align: center;
            background-color: #fafafa;
        }

        .file-icon {
            font-size: 80px;
            color: #000;
        }

        /* Button */
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }

        .btn-kembali {
            background-color: #b71c1c;
            color: #ffffff;
            padding: 12px 40px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Afacad', sans-serif;
        }

        .btn-kembali:hover {
            background-color: #8b0000;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .card {
                padding: 25px;
            }

            .navbar {
                padding: 15px 20px;
            }

            .nav-links {
                gap: 15px;
            }

            .nav-links a {
                font-size: 18px;
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
                <li>|</li>
                <li><a href="#dashboard" class="nav-link">Dashboard</a></li>
                <li><a href="#surat" class="nav-link active">Surat</a></li>
                <li><a href="#laporan" class="nav-link">Laporan</a></li>
            </ul>
        </div>
        <hr class="navbar-divider">
    </nav>

    <!-- Page Title -->
    <div class="page-title">
        Lihat Detail Surat - Tata Usaha Telkom Schools Banjarbaru
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="card">
            <h2 class="card-title">Detail Surat</h2>

            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Pengirim</label>
                    <div class="value">Kesiswaan</div>
                </div>
                <div class="form-group">
                    <label>Instansi Asal</label>
                    <div class="value">Kesiswaan</div>
                </div>
                <div class="form-group">
                    <label>Nama Pengirim</label>
                    <div class="value">Kesiswaan</div>
                </div>
                <div class="form-group">
                    <label>Instansi Asal</label>
                    <div class="value">Kesiswaan</div>
                </div>
                <div class="form-group">
                    <label>Nama Pengirim</label>
                    <div class="value">Kesiswaan</div>
                </div>
                <div class="form-group">
                    <label>Instansi Asal</label>
                    <div class="value">Kesiswaan</div>
                </div>
            </div>

            <div class="perihal-section">
                <label>Perihal</label>
                <p class="perihal-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
            </div>

            <div class="file-section">
                <label>File Surat</label>
                <div class="file-box">
                    <span class="iconify file-icon" data-icon="bxs:file-doc"></span>
                </div>
            </div>

            <div class="btn-container">
                <button class="btn-kembali" onclick="goBack()">Kembali</button>
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

        // Go Back Function
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
