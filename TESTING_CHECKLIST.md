# Testing Checklist - Warta.id Reporting System

## 🔐 A. Authentication & Authorization

### A1. Login

-   [ ] Login dengan email dan password yang benar (user)
-   [ ] Login dengan email dan password yang benar (admin)
-   [ ] Login dengan email dan password yang benar (super_admin)
-   [ ] Login dengan email/password salah (error message muncul)
-   [ ] Login dengan akun yang dinonaktifkan (error message muncul)
-   [ ] Redirect otomatis ke dashboard sesuai role setelah login
-   [ ] "Remember me" checkbox berfungsi
-   [ ] Show/hide password toggle berfungsi

### A2. Register

-   [ ] Register dengan data valid (nama, email, password, password confirmation)
-   [ ] Register dengan email yang sudah terdaftar (error message muncul)
-   [ ] Register dengan password kurang dari 8 karakter (error message muncul)
-   [ ] Register dengan password confirmation tidak sama (error message muncul)
-   [ ] Show/hide password toggle berfungsi untuk kedua field password
-   [ ] Setelah register, redirect ke login dengan success message
-   [ ] User yang baru register memiliki role 'user' dan is_active = true

### A3. Logout

-   [ ] Logout dari semua role berfungsi
-   [ ] Setelah logout, redirect ke halaman login
-   [ ] Setelah logout, tidak bisa akses halaman yang memerlukan auth

---

## 👤 B. User Role Features

### B1. Dashboard User

-   [ ] Dashboard menampilkan statistik yang benar:
    -   [ ] Total Laporan
    -   [ ] Dalam Proses
    -   [ ] Selesai
    -   [ ] Ditolak
-   [ ] Menampilkan 5 laporan terbaru yang dibuat oleh user
-   [ ] Statistik sesuai dengan data laporan user tersebut

### B2. Buat Laporan

-   [ ] Form create laporan muncul dengan benar
-   [ ] Hanya menampilkan instansi dengan status 'active'
-   [ ] Validasi form:
    -   [ ] Judul wajib diisi
    -   [ ] Deskripsi wajib diisi
    -   [ ] Lokasi wajib diisi
    -   [ ] Instansi wajib dipilih
-   [ ] Upload file bukti:
    -   [ ] Bisa upload multiple files
    -   [ ] File preview muncul setelah pilih file
    -   [ ] Validasi format file (jpg, jpeg, png, pdf)
    -   [ ] Validasi ukuran per file (max 5MB)
    -   [ ] Validasi total ukuran (max 50MB)
    -   [ ] Error message muncul jika melebihi limit
-   [ ] Tidak bisa buat laporan ke instansi yang statusnya 'suspended'
-   [ ] Setelah submit, redirect ke list laporan dengan success message
-   [ ] Status history otomatis dibuat dengan status 'terkirim'

### B3. List Laporan Saya

-   [ ] Hanya menampilkan laporan yang dibuat oleh user tersebut
-   [ ] Menampilkan informasi: judul, instansi, lokasi, status, tanggal
-   [ ] Pagination berfungsi jika data lebih dari 10
-   [ ] Link "Lihat" mengarah ke detail laporan
-   [ ] Link "Edit" hanya muncul untuk laporan dengan status 'terkirim'
-   [ ] Link "Hapus" hanya muncul untuk laporan dengan status 'terkirim'

### B4. Detail Laporan

-   [ ] Menampilkan semua informasi laporan dengan benar
-   [ ] Menampilkan status dengan badge warna yang sesuai
-   [ ] Menampilkan file bukti (gambar bisa di-klik untuk preview, PDF bisa di-download)
-   [ ] Menampilkan catatan admin jika ada
-   [ ] Menampilkan riwayat status dengan timeline yang benar
-   [ ] Timeline menampilkan perubahan status dan catatan
-   [ ] Tombol "Edit" hanya muncul jika status = 'terkirim'
-   [ ] Tidak bisa akses laporan milik user lain

### B5. Edit Laporan

-   [ ] Hanya bisa edit laporan dengan status 'terkirim'
-   [ ] Tidak bisa edit laporan dengan status selain 'terkirim' (error message)
-   [ ] Form pre-filled dengan data laporan
-   [ ] Hanya menampilkan instansi dengan status 'active'
-   [ ] Bisa edit semua field (judul, deskripsi, lokasi, instansi)
-   [ ] Bisa hapus file bukti yang sudah ada (checkbox)
-   [ ] Bisa tambah file bukti baru
-   [ ] File preview untuk file baru berfungsi
-   [ ] Validasi sama seperti create
-   [ ] Setelah update, redirect ke detail dengan success message

### B6. Hapus Laporan

-   [ ] Hanya bisa hapus laporan dengan status 'terkirim'
-   [ ] Tidak bisa hapus laporan dengan status selain 'terkirim' (error message)
-   [ ] Konfirmasi sebelum hapus
-   [ ] File bukti ikut terhapus dari server
-   [ ] Setelah hapus, redirect ke list dengan success message
-   [ ] Tidak bisa hapus laporan milik user lain

---

## 👨‍💼 C. Admin Role Features

### C1. Dashboard Admin

-   [ ] Dashboard menampilkan statistik yang benar:
    -   [ ] Laporan Masuk (status 'terkirim')
    -   [ ] Dalam Proses (status 'diverifikasi' atau 'diproses')
    -   [ ] Selesai
    -   [ ] Ditolak
-   [ ] Statistik hanya untuk instansi yang ditugaskan ke admin
-   [ ] Menampilkan 5 laporan terbaru dari instansi yang ditugaskan
-   [ ] Tidak menampilkan laporan dari instansi lain

### C2. List Laporan Masuk

-   [ ] Hanya menampilkan laporan dari instansi yang ditugaskan ke admin
-   [ ] Menampilkan informasi: judul, pelapor, instansi, admin, status, tanggal
-   [ ] Kolom "Admin" menampilkan "-" jika belum di-claim
-   [ ] Kolom "Admin" menampilkan nama admin jika sudah di-claim
-   [ ] Tombol "Ambil Laporan" muncul untuk laporan yang belum di-claim
-   [ ] Tombol "Ubah Status" hanya muncul untuk laporan yang di-claim oleh admin tersebut
-   [ ] Tidak bisa lihat laporan dari instansi yang tidak ditugaskan

### C3. Claim Laporan

-   [ ] Modal konfirmasi muncul saat klik "Ambil Laporan"
-   [ ] AJAX request berhasil claim laporan
-   [ ] Toast notification muncul dengan success message
-   [ ] Setelah claim, tombol "Ubah Status" muncul
-   [ ] Admin lain tidak bisa claim laporan yang sudah di-claim
-   [ ] Race condition: jika 2 admin claim bersamaan, hanya 1 yang berhasil
-   [ ] Tidak bisa claim laporan dari instansi yang tidak ditugaskan

### C4. Ubah Status Laporan (Modal)

-   [ ] Modal muncul saat klik "Ubah Status"
-   [ ] Dropdown status menampilkan opsi yang sesuai
-   [ ] Status preview badge muncul dan berubah sesuai pilihan
-   [ ] Character counter untuk catatan berfungsi
-   [ ] Validasi status progression:
    -   [ ] Tidak bisa mundur ke status sebelumnya
    -   [ ] Status 'selesai' hanya bisa dari 'diproses'
    -   [ ] Status 'ditolak' bisa dipilih kapan saja (selama belum final)
    -   [ ] Status final ('selesai', 'ditolak') tidak bisa diubah lagi
-   [ ] Hanya admin yang claim yang bisa ubah status
-   [ ] AJAX request berhasil update status
-   [ ] Toast notification muncul dengan success message
-   [ ] Status history otomatis dibuat jika status berubah
-   [ ] Status history dibuat jika catatan ditambahkan (meskipun status tidak berubah)
-   [ ] Tidak ada duplikasi status history

### C5. Detail Laporan (Admin)

-   [ ] Menampilkan semua informasi laporan
-   [ ] Menampilkan "Admin Penanggung Jawab"
-   [ ] Form "Ubah Status" hanya muncul jika:
    -   [ ] Laporan belum di-claim (tampilkan pesan)
    -   [ ] Laporan sudah di-claim oleh admin lain (tampilkan pesan)
    -   [ ] Laporan di-claim oleh admin tersebut (tampilkan form)
-   [ ] Menampilkan riwayat status dengan timeline

---

## 🔑 D. Super Admin Role Features

### D1. Dashboard Super Admin

-   [ ] Dashboard menampilkan statistik yang benar:
    -   [ ] Total Instansi
    -   [ ] Total Admin
    -   [ ] Total Laporan
    -   [ ] Pending Laporan
-   [ ] Menampilkan 5 instansi terbaru
-   [ ] Menampilkan 5 laporan terbaru

### D2. Kelola User

-   [ ] List menampilkan semua user (user, admin, super_admin)
-   [ ] Search berfungsi (nama atau email)
-   [ ] Filter by role berfungsi
-   [ ] Filter by status (active/inactive) berfungsi
-   [ ] Statistik cards menampilkan data yang benar
-   [ ] Toggle switch untuk is_active berfungsi (AJAX)
-   [ ] Tidak bisa toggle status akun sendiri
-   [ ] Create user baru (admin/super_admin):
    -   [ ] Form validasi berfungsi
    -   [ ] Show/hide password berfungsi
    -   [ ] Setelah create, user muncul di list
-   [ ] Edit user:
    -   [ ] Bisa edit semua user
    -   [ ] Role tidak bisa diubah (disabled field)
    -   [ ] is_active tidak ada di form (hanya via toggle)
    -   [ ] Password optional (jika tidak diisi, tidak diubah)
    -   [ ] Tidak bisa ubah role admin ↔ super_admin
-   [ ] Delete user:
    -   [ ] Bisa delete semua user kecuali diri sendiri
    -   [ ] Konfirmasi sebelum delete
    -   [ ] Error message jika coba delete diri sendiri

### D3. Kelola Instansi

-   [ ] List menampilkan semua instansi
-   [ ] Toggle switch untuk status (active/suspended) berfungsi (AJAX)
-   [ ] Create instansi baru:
    -   [ ] Form validasi berfungsi
    -   [ ] Setelah create, instansi muncul di list
-   [ ] Edit instansi:
    -   [ ] Bisa edit nama dan alamat
    -   [ ] Status tidak ada di form (hanya via toggle)
-   [ ] Delete instansi:
    -   [ ] Tidak bisa delete jika masih ada laporan (error message)
    -   [ ] Tidak bisa delete jika masih ada admin yang ditugaskan (error message)
    -   [ ] Bisa delete jika tidak ada relasi
    -   [ ] Konfirmasi sebelum delete

### D4. Kelola Admin-Instansi

-   [ ] List menampilkan semua admin dan instansi
-   [ ] Accordion/collapsible berfungsi untuk setiap instansi
-   [ ] Search berfungsi
-   [ ] Assign admin ke instansi:
    -   [ ] Validasi user adalah admin/super_admin
    -   [ ] Error jika admin sudah terdaftar di instansi tersebut
    -   [ ] Success message setelah assign
-   [ ] Remove admin dari instansi:
    -   [ ] Konfirmasi sebelum remove
    -   [ ] Success message setelah remove

### D5. Semua Laporan

-   [ ] List menampilkan semua laporan di sistem
-   [ ] Search berfungsi (judul, deskripsi, lokasi)
-   [ ] Filter by instansi berfungsi
-   [ ] Filter by status berfungsi
-   [ ] Filter by admin berfungsi (termasuk "Belum Ditugaskan")
-   [ ] Statistik cards menampilkan data yang benar
-   [ ] Pagination berfungsi
-   [ ] Link "Lihat", "Edit", "Hapus" berfungsi

### D6. Detail Laporan (Super Admin)

-   [ ] Menampilkan semua informasi laporan
-   [ ] Tombol "Edit" dan "Hapus" selalu muncul
-   [ ] Menampilkan riwayat status dengan timeline

### D7. Edit Laporan (Super Admin)

-   [ ] Bisa edit semua field termasuk status
-   [ ] Bisa edit laporan dengan status apapun
-   [ ] Bisa pindahkan laporan ke instansi lain
-   [ ] Bisa ubah status ke status apapun
-   [ ] Status history dibuat jika status berubah
-   [ ] Validasi sama seperti user edit
-   [ ] File upload validasi berfungsi

### D8. Hapus Laporan (Super Admin)

-   [ ] Bisa hapus laporan dengan status apapun
-   [ ] Konfirmasi sebelum hapus
-   [ ] File bukti ikut terhapus
-   [ ] Success message setelah hapus

---

## 🔒 E. Security & Authorization Tests

### E1. Unauthorized Access

-   [ ] User tidak bisa akses halaman admin
-   [ ] User tidak bisa akses halaman super admin
-   [ ] Admin tidak bisa akses halaman super admin
-   [ ] Admin tidak bisa akses halaman user (create/edit laporan)
-   [ ] User tidak bisa akses laporan milik user lain
-   [ ] Admin tidak bisa akses laporan dari instansi yang tidak ditugaskan
-   [ ] Admin tidak bisa ubah status laporan yang di-claim admin lain

### E2. Data Integrity

-   [ ] User tidak bisa edit/hapus laporan yang sudah diproses
-   [ ] Admin tidak bisa ubah status laporan yang sudah final
-   [ ] Instansi yang suspended tidak bisa menerima laporan baru
-   [ ] User yang dinonaktifkan tidak bisa login
-   [ ] Admin yang dinonaktifkan tidak bisa login

### E3. Input Validation

-   [ ] SQL injection attempt (input dengan SQL syntax)
-   [ ] XSS attempt (input dengan script tags)
-   [ ] File upload dengan ekstensi tidak valid
-   [ ] File upload dengan ukuran melebihi limit
-   [ ] Input dengan karakter khusus

---

## 🐛 F. Edge Cases & Error Handling

### F1. Empty States

-   [ ] Dashboard user tanpa laporan (tampilkan pesan kosong)
-   [ ] Dashboard admin tanpa laporan (tampilkan pesan kosong)
-   [ ] List laporan kosong (tampilkan pesan kosong)
-   [ ] List user kosong (tampilkan pesan kosong)
-   [ ] List instansi kosong (tampilkan pesan kosong)

### F2. Concurrent Operations

-   [ ] 2 admin claim laporan yang sama bersamaan (race condition)
-   [ ] 2 admin update status laporan yang sama bersamaan
-   [ ] User edit laporan yang sedang di-claim admin

### F3. Data Consistency

-   [ ] Hapus instansi yang masih punya laporan (error message)
-   [ ] Hapus instansi yang masih punya admin (error message)
-   [ ] Nonaktifkan instansi, cek apakah masih bisa buat laporan baru (tidak bisa)
-   [ ] Nonaktifkan user, cek apakah masih bisa login (tidak bisa)

### F4. File Handling

-   [ ] Upload file dengan nama yang sama (harus unique)
-   [ ] Hapus file yang sudah di-upload
-   [ ] Upload file corrupt
-   [ ] Upload file dengan ekstensi salah (misal: .exe dengan nama .jpg)

---

## 📱 G. UI/UX Tests

### G1. Responsive Design

-   [ ] Layout responsive di mobile
-   [ ] Layout responsive di tablet
-   [ ] Layout responsive di desktop
-   [ ] Sidebar collapse di mobile (jika ada)

### G2. User Experience

-   [ ] Loading states untuk AJAX requests
-   [ ] Toast notifications muncul dan hilang dengan benar
-   [ ] Modal overlay transparan dengan blur
-   [ ] Form validation error messages jelas
-   [ ] Success messages muncul setelah action
-   [ ] Navigation menu highlight sesuai halaman aktif

### G3. Accessibility

-   [ ] Form labels jelas
-   [ ] Error messages accessible
-   [ ] Keyboard navigation berfungsi
-   [ ] Focus states terlihat jelas

---

## ✅ H. Final Checks

-   [ ] Semua route terproteksi dengan middleware auth
-   [ ] Semua form memiliki CSRF protection
-   [ ] Semua file upload memiliki validasi
-   [ ] Semua delete operations memiliki konfirmasi
-   [ ] Semua error messages user-friendly
-   [ ] Tidak ada console errors di browser
-   [ ] Tidak ada linter errors di code
-   [ ] Database constraints bekerja dengan benar
-   [ ] Status history tidak ada duplikasi
-   [ ] Timeline riwayat status menampilkan data dengan benar

---

## 📝 Notes

-   Gunakan akun test untuk setiap role
-   Test dengan data realistik
-   Dokumentasikan bug yang ditemukan
-   Test di browser yang berbeda (Chrome, Firefox, Edge)
-   Test dengan ukuran file yang berbeda
-   Test dengan jumlah data yang banyak (pagination)
