# Tata Usaha Surat Menyurat - Telkom Schools

A Laravel-based correspondence management system for Telkom Schools administration staff to handle incoming and outgoing letters efficiently.

## 🏫 Project Overview

This system is designed for Telkom Schools administrative staff to manage correspondence workflow including:
- **Incoming Letters**: Public correspondence submissions with automated routing
- **Outgoing Letters**: Internal replies and official school correspondence  
- **Status Tracking**: Multi-stage approval workflow (pending → received → in process → approved/rejected)
- **Division Management**: Letters routed to specific school divisions (academic, student affairs, finance, etc.)
- **File Attachments**: Upload and download document attachments
- **Dashboard Analytics**: Statistics and recent activity overview

## 🛠️ Technology Stack

- **Backend**: Laravel 12 (PHP 8.3+)
- **Frontend**: Livewire, Alpine.js, Tailwind CSS 4.x
- **Database**: MySQL
- **Authentication**: Laravel Fortify
- **UI Components**: Livewire Flux
- **Charts**: Chart.js
- **File Storage**: Laravel Storage (public disk)

## 📋 System Requirements

- PHP 8.3 or higher
- Composer
- Node.js & npm
- MySQL/MariaDB
- Web server (Apache/Nginx) or use Laravel's built-in server

## 🚀 Installation & Setup

### 1. Clone Repository
```bash
git clone https://github.com/kamiliarder/Tata-Usaha-Surat-Menyurat.git
cd Tata-Usaha-Surat-Menyurat
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env file
```

**Required .env configuration:**
```env
APP_NAME="Tata Usaha Surat Menyurat"
APP_URL=http://localhost:8000
APP_LOCALE=id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tata_usaha_surat
DB_USERNAME=your_username
DB_PASSWORD=your_password

FILESYSTEM_DISK=public
```

### 4. Database Setup
```bash
# Create database (make sure MySQL is running)
mysql -u root -p -e "CREATE DATABASE tata_usaha_surat;"

# Run migrations
php artisan migrate

# Seed with test data
php artisan db:seed
```

### 5. Storage Setup
```bash
# Create symbolic link for file storage
php artisan storage:link
```

### 6. Build Frontend Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### 7. Start Development Server
```bash
php artisan serve --port=8000
```

Visit: `http://localhost:8000`

## 👥 Test Accounts

The system comes with pre-configured test accounts for different roles:

| Role | Name | Email | Division | Purpose |
|------|------|-------|----------|---------|
| **Administrator** | Administrator | admin@sekolah.id | umum | Full system access |
| **Academic Staff** | Guru Akademik | akademik@sekolah.id | akademik | Academic letters |
| **Student Affairs** | Guru Kesiswaan | kesiswaan@sekolah.id | kesiswaan | Student-related letters |
| **Finance Staff** | Guru Keuangan | keuangan@sekolah.id | keuangan | Financial correspondence |
| **Infrastructure** | Guru Sarana Prasarana | sarpras@sekolah.id | sarpras | Facility management |
| **Non-Academic** | Guru Non Akademik | nonakademik@sekolah.id | non_akademik | Non-academic affairs |
| **General Staff** | Guru Umum | umum@sekolah.id | umum | General administration |

**Default Password**: `password` (for all accounts)

**Note**: The `visitor@dummy.local` account is used internally for external correspondence routing.

## 🏗️ System Architecture

### Key Components

1. **Public Interface** (`/pesan/create`)
   - External parties submit correspondence
   - Dynamic dropdown for staff selection by division
   - File upload capability
   - Automatic status assignment to "pending"

2. **Admin Dashboard** (`/admin/pesan`)
   - View all correspondence with filtering
   - Status management with modal interface
   - Detailed letter view with attachments
   - Conditional deletion (only rejected/needs-revision)

3. **Staff Dashboard** (`/dashboard`)
   - Statistics overview with charts
   - Recent letters assigned to logged-in user
   - Quick status overview

### Database Schema

- **tb_pesan**: Main letters table with status tracking
- **tb_pengguna**: Users/staff with division assignments  
- **tb_lampiran**: File attachments linked to letters

### Status Workflow

```
Public Submission → pending → diterima → dalam_proses → [disetujui | ditolak | perlu_perbaikan]
```

## 🔧 Development Guide

### Project Structure
```
app/
├── Http/Controllers/
│   ├── AdminPesanController.php    # Admin letter management
│   ├── PublicPesanController.php   # Public submission
│   └── DashboardController.php     # Dashboard statistics
├── Models/
│   ├── Pesan.php                   # Letter model
│   ├── User.php                    # User model  
│   └── Lampiran.php               # Attachment model
└── Livewire/                      # Livewire components

resources/views/
├── admin/pesan/index.blade.php    # Letter management interface
├── dashboard.blade.php            # Main dashboard
├── components/                    # Reusable UI components
└── livewire/                     # Livewire views
```

### Key Routes
- `GET /` - Welcome page
- `GET /pesan/create` - Public letter submission
- `GET /dashboard` - Staff dashboard (auth required)
- `GET /admin/pesan` - Letter management (auth required)
- `GET|PATCH|DELETE /admin/pesan/{id}` - Letter CRUD operations

### API Endpoints
- `GET /api/pengguna/by-divisi/{divisi}` - Get staff by division

## 📱 Features

### ✅ Implemented Features
- [x] Public letter submission with file upload
- [x] Dynamic staff dropdown by division
- [x] Admin letter management interface
- [x] Status tracking and updates
- [x] File attachment handling
- [x] Dashboard with statistics
- [x] User authentication
- [x] Responsive design
- [x] AJAX-powered modals
- [x] Conditional letter deletion

### 🚧 Planned Features
- [ ] Email notifications for status changes
- [x] Advanced search and filtering
- [x] Letter templates
- [ ] Bulk operations
- [ ] Audit trail
- [ ] Reports and analytics
- [ ] Mobile app integration

## 🐛 Common Issues & Solutions

### Issue 1: "Gagal memuat surat" when viewing details
**Solution**: Ensure you're logged in and the AJAX request headers are properly set.

### Issue 2: Status update shows error but actually works
**Solution**: Clear browser cache and ensure CSRF tokens are valid.

### Issue 3: File uploads not working
**Solution**: 
```bash
php artisan storage:link
chmod -R 775 storage/
```

### Issue 4: Database connection errors
**Solution**: Check `.env` database configuration and ensure MySQL is running.

## 🔒 Security Considerations

- All admin routes require authentication
- CSRF protection on forms
- File upload validation (type and size limits)
- SQL injection protection via Eloquent ORM
- XSS protection via Blade templating

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📞 Support

For technical issues or questions:
- Check the issues section on GitHub
- Contact the development team
- Review Laravel documentation for framework-specific questions

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 💌 Special Thanks to
- Arman D. (Requirement Analyst)
- Muhammad Husain H. (Quality Assurance)
- Meraz E.H. (Frontend, UI/UX)
- Betarus M.B. (Frontend, UI/UX)
- Copilot (Backend & Frontend Assist)
---

**Developed for Telkom Schools** | Last Updated: October 2025
