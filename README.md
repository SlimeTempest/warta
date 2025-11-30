# Warta.id - Sistem Pelaporan Masyarakat

Sistem pelaporan berbasis web yang memungkinkan masyarakat untuk membuat laporan dan admin untuk mengelola laporan tersebut.

## 📋 Prerequisites

Sebelum memulai, pastikan Anda telah menginstall:

-   **PHP** >= 8.2
-   **Composer** (PHP Package Manager)
-   **Node.js** >= 18.x dan **npm**
-   **MySQL** atau **MariaDB**
-   **Git**

## 🚀 Setup Project (Setelah Clone)

Ikuti langkah-langkah berikut untuk setup project:

### 1. Clone Repository

```bash
git clone <repository-url>
cd warta
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Install Dependencies JavaScript

```bash
npm install
```

### 4. Setup Environment File

```bash
# Copy file .env.example ke .env (jika belum ada)
cp .env.example .env

# Atau jika menggunakan Windows
copy .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=warta
DB_USERNAME=root
DB_PASSWORD=
```

**Pastikan database sudah dibuat terlebih dahulu!**

```sql
CREATE DATABASE warta;
```

### 7. Jalankan Migration dan Seeder

```bash
php artisan migrate --seed
```

Ini akan:

-   Membuat semua tabel di database
-   Menambahkan user Super Admin default:
    -   **Email**: `superadmin@warta.id`
    -   **Password**: `password`

### 8. Buat Storage Link (Jika diperlukan)

```bash
php artisan storage:link
```

### 9. Build Assets (Development)

```bash
npm run dev
```

Atau untuk production:

```bash
npm run build
```

### 10. Jalankan Server

Buka terminal baru dan jalankan:

```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://127.0.0.1:8000`

## 📝 Checklist Setup

Gunakan checklist ini untuk memastikan semua langkah sudah dilakukan:

-   [ ] Repository sudah di-clone
-   [ ] `composer install` sudah dijalankan
-   [ ] `npm install` sudah dijalankan
-   [ ] File `.env` sudah dibuat dan dikonfigurasi
-   [ ] `php artisan key:generate` sudah dijalankan
-   [ ] Database sudah dibuat
-   [ ] Konfigurasi database di `.env` sudah benar
-   [ ] `php artisan migrate --seed` sudah dijalankan
-   [ ] `npm run dev` atau `npm run build` sudah dijalankan
-   [ ] `php artisan serve` sudah dijalankan
-   [ ] Aplikasi bisa diakses di browser

## 🔐 Default Login Credentials

Setelah menjalankan seeder, Anda bisa login dengan:

**Super Admin:**

-   Email: `superadmin@warta.id`
-   Password: `password`

**⚠️ PENTING:** Segera ubah password setelah login pertama kali!

## 👥 Roles & Permissions

### User (Masyarakat)

-   Dapat membuat, melihat, edit, dan hapus laporan sendiri (hanya status 'terkirim')
-   Dapat melihat riwayat status laporan
-   Dashboard menampilkan statistik laporan mereka

### Admin

-   Dapat melihat laporan dari instansi yang ditugaskan
-   Dapat mengambil (claim) laporan
-   Dapat mengubah status laporan yang sudah di-claim
-   Dapat menambahkan catatan pada laporan
-   Dashboard menampilkan statistik laporan instansi mereka

### Super Admin

-   Dapat mengelola semua user (create, edit, delete, activate/deactivate)
-   Dapat mengelola instansi (create, edit, delete, suspend/activate)
-   Dapat mengelola assignment admin ke instansi
-   Dapat melihat dan mengelola semua laporan
-   Dapat edit/hapus laporan dengan status apapun
-   Dashboard menampilkan statistik keseluruhan sistem

## 📁 Struktur Project

```
warta/
├── app/
│   ├── Http/
│   │   └── Controllers/     # Controllers untuk semua fitur
│   └── Models/              # Eloquent Models
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   └── views/               # Blade templates
│       ├── auth/            # Login & Register
│       ├── dashboard/       # Dashboard untuk setiap role
│       └── layouts/         # Layout templates
├── routes/
│   └── web.php             # Web routes
└── public/
    └── uploads/             # File uploads (bukti laporan)
```

## 🛠️ Perintah Berguna

### Development

```bash
# Jalankan development server dengan hot reload
php artisan serve
npm run dev

# Atau jalankan keduanya sekaligus
composer run dev
```

### Database

```bash
# Reset database dan jalankan seeder
php artisan migrate:fresh --seed

# Buat migration baru
php artisan make:migration create_nama_tabel

# Buat seeder baru
php artisan make:seeder NamaSeeder
```

### Cache

```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Atau clear semua sekaligus
php artisan optimize:clear
```

### Build Production

```bash
# Build assets untuk production
npm run build

# Optimize aplikasi
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🧪 Testing

Gunakan file `TESTING_CHECKLIST.md` untuk panduan testing lengkap.

## 📚 Fitur Utama

-   ✅ Authentication & Authorization (Login, Register, Logout)
-   ✅ Role-based Access Control (User, Admin, Super Admin)
-   ✅ User Management (Super Admin)
-   ✅ Instansi Management (Super Admin)
-   ✅ Admin-Instansi Assignment (Super Admin)
-   ✅ Laporan Management (User)
-   ✅ Laporan Processing (Admin)
-   ✅ Status History & Timeline
-   ✅ File Upload (Bukti Laporan)
-   ✅ Search & Filter
-   ✅ Real-time Statistics Dashboard

## 🐛 Troubleshooting

### Error: "SQLSTATE[HY000] [1045] Access denied"

-   Pastikan username dan password database di `.env` benar
-   Pastikan database sudah dibuat

### Error: "Class 'PDO' not found"

-   Install extension PDO untuk PHP
-   Di XAMPP/Laragon: biasanya sudah terinstall

### Error: "npm: command not found"

-   Install Node.js dari https://nodejs.org/
-   Restart terminal setelah install

### Error: "Composer: command not found"

-   Install Composer dari https://getcomposer.org/
-   Restart terminal setelah install

### File upload tidak berfungsi

-   Pastikan folder `public/uploads/bukti` ada dan writable
-   Cek permission folder (chmod 755 atau 777)

## 📄 License

MIT License

## 👨‍💻 Developer

Dibuat dengan Laravel Framework

---

**Selamat coding! 🚀**
