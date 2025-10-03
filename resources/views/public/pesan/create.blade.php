<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Surat - Telkom Schools Banjarbaru</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e8e8e8;
        }

        /* Header */
        .header {
            background-color: white;
            padding: 15px 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 40px;
            height: 40px;
            background-color: #c41e3a;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 24px;
        }

        .nav {
            display: flex;
            gap: 30px;
        }

        .nav a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        .nav a:hover {
            color: #c41e3a;
        }

        /* Page Title */
        .page-title {
            background-color: #f5f5f5;
            padding: 20px 40px;
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        /* Container */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background-color: white;
            border-radius: 8px;
            padding: 40px 50px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Title */
        .form-title {
            text-align: center;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 40px;
            color: #333;
        }

        /* Form Layout */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 15px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea {
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #c41e3a;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Upload Section */
        .upload-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .upload-box {
            display: flex;
            flex-direction: column;
        }

        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 6px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background-color: #fafafa;
        }

        .upload-area:hover {
            border-color: #c41e3a;
            background-color: #fff;
        }

        .upload-icon {
            font-size: 48px;
            margin-bottom: 10px;
            color: #333;
        }

        .upload-text {
            font-size: 15px;
            color: #333;
            font-weight: 500;
        }

        .download-icon {
            font-size: 48px;
            margin-bottom: 10px;
            color: #333;
        }

        .download-btn {
            background-color: #c41e3a;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-top: 10px;
            display: inline-block;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: #c41e3a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #a01829;
        }

        .submit-btn:active {
            transform: translateY(1px);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">T</div>

    </div>

    <!-- Page Title -->
    <div class="page-title">
        Buat Surat Baru - Tata Usaha Telkom Schools Banjarbaru
    </div>

    <!-- Main Container -->
    <div class="container">
        <h1 class="form-title">Buat Surat</h1>

        <form>
            <!-- Form Grid -->
            <div class="form-grid">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" name="judul">
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori">
                </div>

                <div class="form-group">
                    <label for="pengirim">Nama Pengirim</label>
                    <input type="text" id="pengirim" name="pengirim">
                </div>

                <div class="form-group">
                    <label for="instansi">Instansi Asal</label>
                    <input type="text" id="instansi" name="instansi">
                </div>

                <div class="form-group">
                    <label for="ditujukan">Ditujukan Kepada</label>
                    <input type="text" id="ditujukan" name="ditujukan">
                </div>

                <div class="form-group">
                    <label for="whatsapp">No Telp. Whatsapp</label>
                    <input type="text" id="whatsapp" name="whatsapp">
                </div>

                <div class="form-group full-width">
                    <label for="perihal">Perihal</label>
                    <textarea id="perihal" name="perihal"></textarea>
                </div>
            </div>

            <!-- Upload Section -->
            <div class="upload-section">
                <div class="upload-box">
                    <label>Upload Surat</label>
                    <div class="upload-area">
                        <div class="upload-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <div class="upload-text">Browse files</div>
                    </div>
                </div>

                <div class="upload-box">
                    <label>Unduh Tenplate Surat</label>
                    <div class="upload-area">
                        <div class="download-icon">📄</div>
                        <span class="download-btn">Unduh</span>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Kirim</button>
        </form>
    </div>
</body>
</html>
