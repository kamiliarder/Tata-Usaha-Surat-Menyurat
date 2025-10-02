# 🔐 Login Credentials untuk Testing

## 👨‍💼 **Admin Account**
- **Email**: `admin@sekolah.id`
- **Password**: `admin123`
- **Role**: Administrator
- **Akses**: Full system access, dapat mengelola semua surat dan pengguna

---

## 👨‍🏫 **Teacher Accounts (Guru)**

### 📚 **Akademik**
- **Email**: `akademik@sekolah.id`
- **Password**: `guru123`
- **Divisi**: Akademik

### 👥 **Kesiswaan**
- **Email**: `kesiswaan@sekolah.id`
- **Password**: `guru123`
- **Divisi**: Kesiswaan

### 💰 **Keuangan**
- **Email**: `keuangan@sekolah.id`
- **Password**: `guru123`
- **Divisi**: Keuangan

### 🏗️ **Sarana Prasarana**
- **Email**: `sarpras@sekolah.id`
- **Password**: `guru123`
- **Divisi**: Sarana Prasarana

### 📋 **Non Akademik**
- **Email**: `nonakademik@sekolah.id`
- **Password**: `guru123`
- **Divisi**: Non Akademik

### 📄 **Umum**
- **Email**: `umum@sekolah.id`
- **Password**: `guru123`
- **Divisi**: Umum

---

## 🚀 **Cara Login**

1. Buka aplikasi di browser
2. Klik tombol **"Login Staff"** 
3. Masukkan email dan password sesuai akun yang ingin digunakan
4. Klik **"Login"**

## 📝 **Catatan**
- Password untuk semua guru adalah `guru123`
- Password untuk admin adalah `admin123`
- Akun ini hanya untuk testing/development
- Ganti password sebelum production!

## 🔄 **Reset Database**
Jika ingin mereset dan membuat ulang akun:
```bash
php artisan migrate:fresh --seed
```
