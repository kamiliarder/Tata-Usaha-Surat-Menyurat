<p align="center" style="background-color: white;">
  <img src="https://raw.githubusercontent.com/kamiliarder/Tata-Usaha-Surat-Menyurat/main/public/assets/logo.png" 
       alt="Project Banner"
       width="70%">
</p>

<h1 align="center">📬 Sistem Tata Usaha Surat Menyurat</h1>

<p align="center">A minimal & modern Laravel-based system for managing school administrative letters.</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-red?style=for-the-badge">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB3?style=for-the-badge">
  <img src="https://img.shields.io/badge/Livewire-Volt-F72585?style=for-the-badge">
  <img src="https://img.shields.io/badge/TailwindCSS-4-38BDF8?style=for-the-badge">
  <img src="https://img.shields.io/badge/License-MIT-brightgreen?style=for-the-badge">
</p>

<hr style="height:2px; border:none; background:linear-gradient(to right, transparent, rgb(127 29 29), transparent);">

## <p align="center">✨ Fitur Utama</p>

- Surat masuk & keluar  
- Penomoran otomatis  
- Kategori & status tracking  
- Upload lampiran  
- Dashboard statistik  
- Portal publik pengajuan  
- Role Admin & Guru  
- Two-Factor Authentication  

<hr style="height:2px; border:none; background:linear-gradient(to right, transparent, rgb(127 29 29), transparent);">

## <p align="center">🛠 Teknologi</p>

**Backend:** Laravel 12 · PHP 8.2+ · Livewire Volt  
**Frontend:** TailwindCSS · Flux UI · Alpine.js · Chart.js  
**Tools:** Composer · NPM · Pest · Pint · Laravel Sail  

<hr style="height:2px; border:none; background:linear-gradient(to right, transparent, rgb(127 29 29), transparent);">

## <p align="center">📋 Persyaratan Sistem</p>

- PHP 8.2+  
- Composer 2+  
- Node.js 18+  
- MySQL 8+  
- Ekstensi PHP: `BCMath`, `Mbstring`, `PDO`, `XML`, dll.  

<hr style="height:2px; border:none; background:linear-gradient(to right, transparent, rgb(127 29 29), transparent);">

## <p align="center">⚡ Instalasi Cepat</p>

### 1. Clone
```bash
git clone https://github.com/kamiliarder/Tata-Usaha-Surat-Menyurat.git
cd Tata-Usaha-Surat-Menyurat
````

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database

Edit `.env`:

```env
DB_DATABASE=tata_usaha
DB_USERNAME=root
DB_PASSWORD=your_password
```

Migrasi:

```bash
php artisan migrate --seed
```

### 5. Storage Link

```bash
php artisan storage:link
```

### 6. Build Frontend

```bash
npm run dev      # Development
npm run build    # Production
```

<!-- Gradient Divider -->

<hr style="height:2px; border:none; background:linear-gradient(to right, transparent, rgb(127 29 29), transparent);">

## <p align="center">▶️ Menjalankan Aplikasi</p>

### Development

```bash
php artisan serve
npm run dev
```

### Composer Script (All-in-one)

```bash
composer dev
```

### Docker (Laravel Sail)

```bash
./vendor/bin/sail up -d
```


<hr style="height:2px; border:none; background:linear-gradient(to right, transparent, rgb(127 29 29), transparent);">

## <p align="center">🔐 Kredensial Login (Seeder)</p>

### Admin

```
Email: admin@sekolah.id
Password: admin123
```

### Guru

Password semua guru: **guru123**

| Divisi       | Email                                                   |
| ------------ | ------------------------------------------------------- |
| Akademik     | [akademik@sekolah.id](mailto:akademik@sekolah.id)       |
| Kesiswaan    | [kesiswaan@sekolah.id](mailto:kesiswaan@sekolah.id)     |
| Keuangan     | [keuangan@sekolah.id](mailto:keuangan@sekolah.id)       |
| Sarpras      | [sarpras@sekolah.id](mailto:sarpras@sekolah.id)         |
| Non Akademik | [nonakademik@sekolah.id](mailto:nonakademik@sekolah.id) |
| Umum         | [umum@sekolah.id](mailto:umum@sekolah.id)               |

<!-- Gradient Divider -->

<hr style="height:2px; border:none; background:linear-gradient(to right, transparent, rgb(127 29 29), transparent);">

## <p align="center">🧪 Testing</p>

```bash
php artisan test
./vendor/bin/pest
```

<!-- Gradient Divider -->

<hr style="height:2px; border:none; background:linear-gradient(to right, transparent, rgb(127 29 29), transparent);">

## <p align="center">📄 Lisensi</p>

MIT License

