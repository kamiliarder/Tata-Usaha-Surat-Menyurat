# 📬 Sistem Tata Usaha Surat Menyurat

Aplikasi web berbasis Laravel untuk mengelola surat-menyurat di lingkungan sekolah/institusi pendidikan. Sistem ini memungkinkan pengelolaan surat masuk dan keluar secara digital dengan fitur tracking, kategorisasi, dan manajemen pengguna.

![Laravel](https://img.shields.io/badge/Laravel-12.0-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)
![Livewire](https://img.shields.io/badge/Livewire-3.0-pink.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

## 📑 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Kredensial Login](#-kredensial-login)
- [Struktur Direktori](#-struktur-direktori)
- [Fitur Keamanan](#-fitur-keamanan)
- [Testing](#-testing)
- [Deployment](#-deployment)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

## ✨ Fitur Utama

### 🔐 Manajemen Pengguna
- **Dua Role Pengguna**: Administrator dan Guru
- **Autentikasi Aman**: Login dengan email dan password
- **Two-Factor Authentication**: Keamanan ekstra dengan 2FA
- **Manajemen Profil**: Upload foto profil, edit data personal
- **Role-Based Access Control**: Pembatasan akses berdasarkan role

### 📨 Manajemen Surat
- **Surat Masuk & Keluar**: Kelola kedua jenis surat dalam satu sistem
- **Nomor Surat Otomatis**: Generate nomor surat dengan format YYYY/MM/NNNN
- **Kategori Surat**: 6 kategori (Akademik, Kesiswaan, Keuangan, Umum, Non Akademik, Sarana Prasarana)
- **Status Tracking**: Monitor status surat (Pending, Diterima, Dalam Proses, Perlu Perbaikan, Disetujui, Ditolak)
- **Upload Lampiran**: Tambahkan file lampiran untuk setiap surat
- **Threading**: Sistem balasan surat dengan link ke surat terkait
- **Filter & Pencarian**: Cari surat berdasarkan berbagai kriteria

### 📊 Dashboard & Statistik
- **Ringkasan Real-time**: Jumlah surat masuk, keluar, dan dalam proses
- **Grafik Bulanan**: Visualisasi data surat dengan Chart.js
- **Surat Terbaru**: Tampilkan 5 surat terbaru di dashboard
- **Responsive Design**: Tampilan optimal di desktop dan mobile

### 🌐 Portal Publik
- **Form Pengajuan Surat**: Masyarakat umum dapat mengajukan surat tanpa login
- **Pilih Penerima**: Dropdown dinamis untuk memilih staf penerima berdasarkan divisi
- **Konfirmasi Pengiriman**: Halaman sukses setelah pengajuan

## 🛠 Teknologi yang Digunakan

### Backend
- **PHP 8.2+**: Bahasa pemrograman modern
- **Laravel 12**: Framework web terbaru
- **Livewire Volt**: Reactive components tanpa JavaScript kompleks
- **Laravel Fortify**: Autentikasi dan two-factor authentication
- **MySQL**: Database relational

### Frontend
- **Livewire Flux**: UI component library modern
- **Tailwind CSS 4**: Utility-first CSS framework
- **Alpine.js**: JavaScript framework minimalis
- **Chart.js**: Library untuk grafik interaktif
- **Vite**: Build tool modern dan cepat

### Development Tools
- **Laravel Pint**: PHP code style fixer
- **Pest PHP**: Testing framework
- **Laravel Sail**: Docker development environment
- **Laravel Pail**: Log viewer real-time
- **Composer**: PHP dependency manager
- **NPM**: JavaScript package manager

## 📋 Persyaratan Sistem

Sebelum memulai instalasi, pastikan sistem Anda memenuhi persyaratan berikut:

### Minimum Requirements
- **PHP**: 8.2 atau lebih tinggi
- **Composer**: 2.0 atau lebih tinggi
- **Node.js**: 18.0 atau lebih tinggi
- **NPM**: 9.0 atau lebih tinggi
- **MySQL**: 8.0 atau lebih tinggi (atau MariaDB 10.3+)
- **Web Server**: Apache/Nginx

### PHP Extensions
Pastikan extension berikut terinstall:
```
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- PDO_MySQL
- Tokenizer
- XML
```

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/kamiliarder/Tata-Usaha-Surat-Menyurat.git
cd Tata-Usaha-Surat-Menyurat
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Setup Environment File
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tata_usaha
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### 5. Buat Database
Buat database baru di MySQL:

```bash
# Login ke MySQL
mysql -u root -p

# Buat database
CREATE DATABASE tata_usaha CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 6. Jalankan Migrasi & Seeder
```bash
# Jalankan migrasi untuk membuat tabel
php artisan migrate

# Isi database dengan data dummy (opsional, recommended untuk testing)
php artisan db:seed
```

### 7. Setup Storage Link
```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

### 8. Build Assets
```bash
# Build asset untuk production
npm run build

# Atau untuk development dengan hot reload
npm run dev
```

## ⚙️ Konfigurasi

### Konfigurasi Aplikasi
Edit file `.env` untuk menyesuaikan pengaturan aplikasi:

```env
APP_NAME="Tata Usaha Surat Menyurat"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_LOCALE=id
APP_TIMEZONE=UTC
```

### Konfigurasi Email (Opsional)
Untuk fitur notifikasi email:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Konfigurasi Queue (Opsional)
Untuk background jobs:

```env
QUEUE_CONNECTION=database
```

## 🎯 Menjalankan Aplikasi

### Development Mode

#### Metode 1: PHP Built-in Server
```bash
# Terminal 1: Jalankan server
php artisan serve

# Terminal 2: Jalankan Vite untuk hot reload
npm run dev
```

Aplikasi akan berjalan di: `http://localhost:8000`

#### Metode 2: Composer Script (Recommended)
```bash
# Menjalankan semua service sekaligus (server, queue, logs, vite)
composer dev
```

Script ini akan menjalankan:
- Laravel development server
- Queue worker
- Log viewer (Pail)
- Vite dev server

#### Metode 3: Laravel Sail (Docker)
```bash
# Jalankan dengan Sail
./vendor/bin/sail up -d

# Akses aplikasi
# http://localhost
```

### Production Mode
```bash
# Build assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Setup web server (Apache/Nginx) untuk mengarah ke /public
```

## 🔐 Kredensial Login

Setelah menjalankan `php artisan db:seed`, Anda dapat login menggunakan akun berikut:

### 👨‍💼 Administrator
```
Email: admin@sekolah.id
Password: admin123
Role: Administrator
Akses: Full system access
```

### 👨‍🏫 Akun Guru (Teacher)

| Divisi | Email | Password | NIP |
|--------|-------|----------|-----|
| Akademik | akademik@sekolah.id | guru123 | 2001 |
| Kesiswaan | kesiswaan@sekolah.id | guru123 | 2002 |
| Keuangan | keuangan@sekolah.id | guru123 | 2003 |
| Sarana Prasarana | sarpras@sekolah.id | guru123 | 2004 |
| Non Akademik | nonakademik@sekolah.id | guru123 | 2005 |
| Umum | umum@sekolah.id | guru123 | 2006 |

> ⚠️ **Penting**: Ganti semua password default sebelum deployment ke production!

### Reset Database
Untuk mereset database dan membuat ulang data dummy:

```bash
php artisan migrate:fresh --seed
```

## 📁 Struktur Direktori

```
Tata-Usaha-Surat-Menyurat/
├── app/
│   ├── Console/          # Artisan commands
│   ├── Http/
│   │   ├── Controllers/  # Controller files
│   │   └── Middleware/   # Custom middleware
│   ├── Livewire/        # Livewire components
│   ├── Models/          # Eloquent models
│   ├── Providers/       # Service providers
│   └── Traits/          # Reusable traits
├── bootstrap/           # Framework bootstrap files
├── config/             # Configuration files
├── database/
│   ├── factories/      # Model factories
│   ├── migrations/     # Database migrations
│   └── seeders/        # Database seeders
├── public/             # Public assets & index.php
│   ├── assets/         # Images & static files
│   └── storage/        # Symlink to storage
├── resources/
│   ├── css/           # CSS source files
│   ├── js/            # JavaScript source files
│   └── views/         # Blade templates
│       ├── components/   # Blade components
│       ├── akun/        # Account management views
│       ├── pesan/       # Mail management views
│       └── public/      # Public portal views
├── routes/
│   ├── web.php        # Web routes
│   └── volt.php       # Volt routes
├── storage/
│   ├── app/           # Application storage
│   ├── framework/     # Framework files
│   └── logs/          # Application logs
├── tests/             # Test files
├── vendor/            # Composer dependencies
├── .env.example       # Environment template
├── composer.json      # PHP dependencies
├── package.json       # JavaScript dependencies
├── phpunit.xml        # PHPUnit configuration
├── tailwind.config.js # Tailwind configuration
└── vite.config.js     # Vite configuration
```

## 🔒 Fitur Keamanan

### 1. Role-Based Access Control (RBAC)
- **Admin Middleware**: Membatasi akses fitur admin
- **Readonly Middleware**: Membatasi guru dari operasi write
- **Route Protection**: Semua route dilindungi dengan middleware auth

### 2. Two-Factor Authentication
- Menggunakan Laravel Fortify
- Mendukung TOTP (Time-based One-Time Password)
- Setup melalui aplikasi authenticator (Google Authenticator, Authy, dll)

### 3. Password Security
- Password di-hash menggunakan bcrypt
- Minimum 12 rounds untuk bcrypt
- Password reset dengan token

### 4. Database Security
- Prepared statements untuk mencegah SQL injection
- Foreign key constraints
- Input validation di controller dan model

### 5. File Upload Security
- Validasi tipe file
- Size limit enforcement
- Storage di luar public directory

### 6. CSRF Protection
- Semua form dilindungi dengan CSRF token
- Automatic validation oleh Laravel

## 🧪 Testing

### Menjalankan Tests
```bash
# Jalankan semua tests
php artisan test

# Atau menggunakan Pest directly
./vendor/bin/pest

# Jalankan test spesifik
php artisan test --filter=UserTest

# Generate coverage report
php artisan test --coverage
```

### Code Style
```bash
# Check code style
./vendor/bin/pint --test

# Auto-fix code style
./vendor/bin/pint
```

## 📦 Deployment

### Persiapan Production

1. **Update Environment**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

2. **Optimize Application**
```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Setup Permissions**
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

4. **Configure Web Server**

**Nginx Example:**
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/app/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

5. **Setup Queue Worker** (Opsional)
```bash
# Install supervisor
sudo apt-get install supervisor

# Create configuration
sudo nano /etc/supervisor/conf.d/tata-usaha.conf
```

Isi dengan:
```ini
[program:tata-usaha-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/app/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/path/to/app/storage/logs/worker.log
```

6. **Setup Scheduled Tasks**
```bash
# Edit crontab
crontab -e

# Add this line
* * * * * cd /path/to/app && php artisan schedule:run >> /dev/null 2>&1
```

## 🤝 Kontribusi

Kontribusi sangat diterima! Berikut cara berkontribusi:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan Anda (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Guidelines
- Follow PSR-12 coding standard
- Tulis test untuk fitur baru
- Update dokumentasi jika diperlukan
- Pastikan semua test pass sebelum PR

## 📝 Changelog

### Fitur yang Akan Datang
- [ ] Export surat ke PDF
- [ ] Notifikasi real-time
- [ ] Arsip surat digital
- [ ] Statistik lanjutan
- [ ] Mobile app

## ❓ FAQ

**Q: Bagaimana cara mengubah bahasa aplikasi?**  
A: Edit `APP_LOCALE` di file `.env`. Default adalah `id` (Indonesia).

**Q: Kenapa email tidak terkirim?**  
A: Pastikan konfigurasi email di `.env` sudah benar. Untuk testing, gunakan `MAIL_MAILER=log`.

**Q: Bagaimana cara backup database?**  
A: Gunakan command `mysqldump -u username -p tata_usaha > backup.sql`

**Q: Bisa menggunakan database selain MySQL?**  
A: Ya, Laravel mendukung PostgreSQL, SQLite, dan SQL Server. Ubah `DB_CONNECTION` di `.env`.

## 📧 Kontak & Support

Jika Anda mengalami masalah atau memiliki pertanyaan:

- **Issues**: Buat issue di [GitHub Issues](https://github.com/kamiliarder/Tata-Usaha-Surat-Menyurat/issues)
- **Discussions**: Gunakan [GitHub Discussions](https://github.com/kamiliarder/Tata-Usaha-Surat-Menyurat/discussions)

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP framework
- [Livewire](https://livewire.laravel.com) - Full-stack framework for Laravel
- [Flux](https://flux.laravel.com) - Beautiful UI components
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Chart.js](https://www.chartjs.org) - Simple yet flexible charting

---

<div align="center">
Dibuat dengan ❤️ untuk digitalisasi administrasi sekolah di Indonesia
</div>
