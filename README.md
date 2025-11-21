<div align="center">

<div style="background-color: white; padding: 40px; border-radius: 10px; display: inline-block;">
  <img src="https://raw.githubusercontent.com/kamiliarder/Tata-Usaha-Surat-Menyurat/main/public/assets/logo.png" alt="Project Banner" width="600px">
</div>

<br><br>

# 📬 Sistem Tata Usaha Surat Menyurat

### *Modern Laravel-Based Correspondence Management for Educational Institutions*

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Livewire](https://img.shields.io/badge/Livewire-Volt-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

[Features](#-features) • [Tech Stack](#-tech-stack) • [Installation](#-quick-start) • [Usage](#️-running-the-app) • [Testing](#-testing)

---

</div>

---

## ✨ Features

<table>
<tr>
<td width="50%">

### 📥 Core Features
- ✅ **Incoming & Outgoing Letters** - Complete tracking system
- 🔢 **Auto Numbering** - Automatic letter numbering
- 📂 **Categorization** - Organized by department & type
- 📎 **File Attachments** - Multi-file upload support
- 🔄 **Status Tracking** - Real-time status updates
- 💬 **Reply System** - Internal correspondence replies

</td>
<td width="50%">

### 🎯 Advanced Features
- 📊 **Dashboard Analytics** - Visual statistics & insights
- 🌐 **Public Portal** - External submission gateway
- 👥 **Role Management** - Admin & Teacher roles
- 🔐 **Two-Factor Auth** - Enhanced security (2FA)
- 📱 **Responsive Design** - Mobile-friendly interface
- 🎨 **Modern UI** - Clean & intuitive design

</td>
</tr>
</table>

---

---

## 🛠 Tech Stack

<div align="center">

### Backend
![Laravel](https://img.shields.io/badge/Laravel_12-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP_8.2+-777BB4?style=flat-square&logo=php&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire_Volt-4E56A6?style=flat-square&logo=livewire&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL_8+-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Fortify](https://img.shields.io/badge/Laravel_Fortify-FF2D20?style=flat-square&logo=laravel&logoColor=white)

### Frontend
![TailwindCSS](https://img.shields.io/badge/TailwindCSS_4-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=flat-square&logo=alpine.js&logoColor=black)
![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?style=flat-square&logo=chart.js&logoColor=white)
![Flux UI](https://img.shields.io/badge/Flux_UI-6366F1?style=flat-square)

### Tools & Testing
![Composer](https://img.shields.io/badge/Composer-885630?style=flat-square&logo=composer&logoColor=white)
![NPM](https://img.shields.io/badge/NPM-CB3837?style=flat-square&logo=npm&logoColor=white)
![Pest](https://img.shields.io/badge/Pest-8BC0D0?style=flat-square)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white)
![Laravel Sail](https://img.shields.io/badge/Laravel_Sail-FF2D20?style=flat-square&logo=docker&logoColor=white)

</div>

---

---

## 📋 System Requirements

> **Important:** Make sure your system meets these requirements before installation.

| Requirement | Version |
|------------|---------|
| 🐘 **PHP** | 8.2 or higher |
| 🎼 **Composer** | 2.0 or higher |
| 📦 **Node.js** | 18.0 or higher |
| 🗄️ **MySQL** | 8.0 or higher |
| 📝 **PHP Extensions** | BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML |

---

---

## ⚡ Quick Start

### 📥 Step 1: Clone Repository

```bash
git clone https://github.com/kamiliarder/Tata-Usaha-Surat-Menyurat.git
cd Tata-Usaha-Surat-Menyurat
```

### 📦 Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 🔧 Step 3: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 🗄️ Step 4: Database Setup

Edit your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tata_usaha
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

Run migrations and seeders:

```bash
php artisan migrate --seed
```

### 🔗 Step 5: Storage Link

```bash
php artisan storage:link
```

### 🎨 Step 6: Build Frontend Assets

```bash
# For development (with hot reload)
npm run dev

# For production (optimized)
npm run build
```

<div align="center">

### 🎉 Installation Complete!

Your application is now ready to use.

</div>

---

---

## ▶️ Running the App

<table>
<tr>
<td width="33%">

### 🔨 Development Mode

```bash
# Terminal 1: Laravel Server
php artisan serve

# Terminal 2: Vite Dev Server
npm run dev
```

**Access:** http://localhost:8000

</td>
<td width="33%">

### 🚀 Quick Start (All-in-One)

```bash
composer dev
```

> Runs server, queue, logs, and Vite simultaneously using concurrently.

</td>
<td width="33%">

### 🐳 Docker (Laravel Sail)

```bash
# Start containers
./vendor/bin/sail up -d

# Stop containers
./vendor/bin/sail down
```

**Access:** http://localhost

</td>
</tr>
</table>

---

---

## 🔐 Default Credentials

> **Note:** These credentials are automatically created when running `php artisan db:seed`

### 👨‍💼 Administrator Account

```
📧 Email:    admin@sekolah.id
🔑 Password: admin123
```

### 👨‍🏫 Teacher Accounts

> **All teachers use the same password:** `guru123`

<table>
<tr>
<th>🏢 Division</th>
<th>📧 Email</th>
<th>👤 Role</th>
</tr>
<tr>
<td>📚 Akademik</td>
<td><code>akademik@sekolah.id</code></td>
<td>Teacher</td>
</tr>
<tr>
<td>🎓 Kesiswaan</td>
<td><code>kesiswaan@sekolah.id</code></td>
<td>Teacher</td>
</tr>
<tr>
<td>💰 Keuangan</td>
<td><code>keuangan@sekolah.id</code></td>
<td>Teacher</td>
</tr>
<tr>
<td>🏗️ Sarpras</td>
<td><code>sarpras@sekolah.id</code></td>
<td>Teacher</td>
</tr>
<tr>
<td>📝 Non Akademik</td>
<td><code>nonakademik@sekolah.id</code></td>
<td>Teacher</td>
</tr>
<tr>
<td>🔧 Umum</td>
<td><code>umum@sekolah.id</code></td>
<td>Teacher</td>
</tr>
</table>

<div align="center">

⚠️ **Security Warning:** Change these passwords in production!

</div>

---

---

## 🧪 Testing

### Run All Tests

```bash
# Using Laravel's test command
php artisan test

# Using Pest directly
./vendor/bin/pest

# With coverage
./vendor/bin/pest --coverage
```

### Run Specific Tests

```bash
# Run feature tests only
php artisan test --testsuite=Feature

# Run a specific test file
./vendor/bin/pest tests/Feature/DashboardTest.php
```

---

## 📚 Additional Resources

<div align="center">

| Resource | Description |
|----------|-------------|
| 📖 [MVC Architecture](./MVC_Architecture_Documentation.md) | System architecture overview |
| 🔄 [System Flow](./System_Flow_Documentation.md) | Complete workflow documentation |
| 🚀 [Setup Guide](./SETUP.md) | Detailed setup instructions |
| 🔑 [Login Credentials](./LOGIN_CREDENTIALS.md) | Default user credentials |

</div>

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

<div align="center">

### Made with ❤️ for Telkom Schools

**[⬆ Back to Top](#-sistem-tata-usaha-surat-menyurat)**

</div>

