# Fitur Reset Password dengan Token

## Ringkasan
Sistem reset password menggunakan token yang digenerate otomatis saat pembuatan akun. Setiap user WAJIB mencatat dan menyimpan token ini dengan aman.

## Alur Fitur

### 1. Generate Token Otomatis
Token reset password (32 karakter random) otomatis dibuat saat:
- **Registrasi User Baru** (`AuthController@register`)
  - Token ditampilkan di pesan sukses setelah registrasi
  - User WAJIB mencatat token ini
  
- **Super Admin Membuat User Baru** (`UserController@store`)
  - Token ditampilkan di pesan sukses
  - Super admin harus memberikan token ke user yang dibuat

- **Seeder Super Admin** (`SuperAdminSeeder`)
  - Token dibuat untuk super admin default
  - Token bisa dilihat di database atau profil

### 2. Tampilan Token di Profil
- **Halaman Profil** (`/profile`)
  - Token ditampilkan dengan desain mencolok (background merah/kuning)
  - Pesan peringatan WAJIB mencatat token
  - Tombol "Salin Token" untuk memudahkan copy
  - Tombol "Buat Token Baru" untuk regenerate token (dengan konfirmasi)

### 3. Reset Password dengan Token
- **Form Reset Password** (`/password/reset`)
  - User memasukkan:
    - Email
    - Token reset password
    - Password baru
    - Konfirmasi password baru
  - Validasi: email + token harus cocok
  - Setelah berhasil, user bisa login dengan password baru

### 4. Super Admin Reset Password
- **Halaman Edit User** (`/users/{user}/edit`)
  - Super admin bisa reset password user tanpa perlu token
  - Form terpisah di bagian bawah halaman edit
  - Tidak memerlukan password lama

## File yang Diubah/Dibuat

### Migration
- `database/migrations/2025_11_26_231705_add_reset_token_to_users_table.php`
  - Menambah kolom `reset_token` (string, nullable) di tabel `users`

### Models
- `app/Models/User.php`
  - Menambah `reset_token` ke `$fillable`

### Controllers
- `app/Http/Controllers/AuthController.php`
  - Generate token saat registrasi
  - Tampilkan token di pesan sukses

- `app/Http/Controllers/UserController.php`
  - Generate token saat super admin membuat user
  - Method `resetPassword()` untuk super admin reset password user

- `app/Http/Controllers/ProfileController.php` (BARU)
  - `show()` - Tampilkan profil dan token
  - `edit()` - Form edit profil
  - `update()` - Update nama dan email
  - `updatePassword()` - Ubah password (perlu password lama)
  - `generateNewToken()` - Generate token baru

- `app/Http/Controllers/PasswordResetController.php` (BARU)
  - `showResetForm()` - Form reset password dengan token
  - `reset()` - Proses reset password dengan validasi token

### Views
- `resources/views/profile/show.blade.php` (BARU)
  - Tampilkan informasi profil
  - Tampilkan token dengan peringatan mencolok
  - Form ubah password
  - Tombol salin token

- `resources/views/profile/edit.blade.php` (BARU)
  - Form edit nama dan email

- `resources/views/auth/passwords/reset.blade.php` (BARU)
  - Form reset password dengan token

- `resources/views/auth/login.blade.php`
  - Link "Lupa password?"
  - Tampilkan pesan token dengan peringatan setelah registrasi

- `resources/views/partials/header.blade.php`
  - Link ke profil (klik nama user)

- `resources/views/dashboard/super_admin/users/edit.blade.php`
  - Form reset password untuk super admin

### Routes
- `routes/web.php`
  - `/password/reset` - GET (form) dan POST (proses)
  - `/profile` - GET (tampilkan)
  - `/profile/edit` - GET (form edit)
  - `/profile` - PUT (update profil)
  - `/profile/password` - PUT (ubah password)
  - `/profile/generate-token` - POST (generate token baru)
  - `/users/{user}/reset-password` - POST (super admin reset password)

### Seeders
- `database/seeders/SuperAdminSeeder.php`
  - Generate token untuk super admin default

## Catatan Penting

1. **Token WAJIB Dicatat User**
   - Token hanya ditampilkan saat:
     - Registrasi (di pesan sukses)
     - Di halaman profil
     - Saat super admin membuat user baru
   - User harus menyimpan token di tempat yang aman

2. **Keamanan Token**
   - Token adalah string random 32 karakter
   - Token disimpan di database (plain text, karena user perlu melihatnya)
   - Jika token hilang, user bisa:
     - Generate token baru (jika sudah login)
     - Minta super admin reset password

3. **Validasi Reset Password**
   - Email + token harus cocok
   - User harus aktif (`is_active = true`)
   - Password baru minimal 8 karakter

4. **Super Admin Privilege**
   - Super admin bisa reset password user tanpa token
   - Super admin bisa melihat semua user dan token mereka
   - Super admin harus memberikan token ke user saat membuat akun baru

## Cara Menggunakan

### Untuk User
1. **Saat Registrasi**: Catat token yang ditampilkan
2. **Lihat Token**: Login → Klik nama di header → Lihat di halaman profil
3. **Reset Password**: 
   - Klik "Lupa password?" di halaman login
   - Masukkan email + token + password baru
   - Login dengan password baru

### Untuk Super Admin
1. **Buat User Baru**: 
   - Buat user → Catat token yang ditampilkan
   - Berikan token ke user
2. **Reset Password User**:
   - Edit user → Scroll ke "Reset Password"
   - Masukkan password baru → Submit

