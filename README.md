# Dispol — Digitalisasi Surat Peringatan ✅

**Deskripsi singkat**

Dispol adalah aplikasi web berbasis PHP yang digunakan untuk mendigitalisasi proses pembuatan, pengelolaan, dan pengarsipan Surat Peringatan (SP) bagi mahasiswa dan staf. Proyek ini fokus ke front-end + backend ringan (PHP/MySQL) dan cocok sebagai proyek praktikum atau prototipe divisualisasikan pada kampus.

---

## ✨ Fitur Utama

- Autentikasi pengguna (role: `staf`, `mahasiswa`)
- Dashboard untuk staf dan mahasiswa (`dashboard-staf`, `dashboard-mahasiswa`)
- Penambahan SP (`tambah-surat.php`) dengan upload file lampiran
- Daftar dan detail Surat Peringatan (`lihat-sp-mh.php`, `detail-surat.php`)
- Pengelolaan staf (`kelola-staf.php`)
- Reset password / OTP flow (`lupa-password.php`, `input-otp.php`)
- Arsip dan manajemen arsip SP (`arsip-staf.php`, backend `arsip-manual.php`, `surat-arsip.php`)

---

## 📁 Struktur Projek (ringkas)

- Root PHP pages: `login.php`, `dashboard-mahasiswa.php`, `dashboard-staf.php`, `tambah-surat.php`, `kelola-staf.php`, `profil-mahasiswa.php`, `profil-staf.php`, dll.
- `backend/` : API endpoint dan proses server-side (contoh: `tambah_surat.php`, `get-sp.php`, `login-process.php`, `register-process.php`, `update_surat.php`, `surat-delete.php`, `otp-request.php`, `otp-verify.php`)
- `css/` : stylesheet per halaman
- `js/` : script klien (render tabel, filter, validasi form, drag/drop file)
- `uploads/` : lampiran file yang diupload
- `dispol.sql` : dump database sample

---

## 🔧 Persyaratan & Instalasi

Prereq:
- PHP >= 7.4 (direkomendasikan PHP 8.x)
- MySQL / MariaDB
- XAMPP (direkomendasikan untuk pengujian lokal) atau server LAMP

Langkah cepat (XAMPP):
1. Simpan folder proyek di `htdocs` (misal: `C:\xampp\htdocs\Dispol`).
2. Mulai Apache & MySQL lewat Control Panel XAMPP.
3. Import database: buka `http://localhost/phpmyadmin` → buat database `dispol` → import file `dispol.sql`.
   - Atau lewat terminal: `mysql -u root -p dispol < dispol.sql`.
4. Perbarui konfigurasi DB di `backend/config.php` jika perlu (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).
5. Buka aplikasi: `http://localhost/Dispol/login.php`.

Catatan: beberapa halaman menggunakan path relatif; menjalankan melalui webserver (XAMPP) menghindari masalah path.

---

## 🧭 Database — ringkasan (dari `dispol.sql`)

Tabel penting:

- `users`
  - Simpan pengguna, role (`staf`/`mahasiswa`), info profil, email, telepon.
  - Fields penting: `id`, `username`, `password` (hash), `role`, `nama`, `nim`, `jurusan`, `prodi`, `kelas`, `angkatan`.

- `surat_peringatan`
  - Menyimpan riwayat SP: `nama`, `nim`, `jurusan`, `tingkat` (`SP I|SP II|SP III`), `tanggal`, `sampai`, `perihal`, `deskripsi`, `file`, `status`.

- `password_resets`
  - Menyimpan token dan OTP untuk reset password.

> Contoh: proyek sudah menyertakan data sample untuk `users` dan `surat_peringatan` pada `dispol.sql`.

---

## 🔧 Penjelasan Modul & Alur

- Login (`login.php`) → memanggil `backend/login-process.php` untuk verifikasi. Setelah login, redirect berdasarkan `role`.
- Tambah SP (`tambah-surat.php`) → form validasi client-side (`js/scripttambah.js`), file upload disimpan ke `uploads/`, backend `backend/tambah_surat.php` menyimpan ke DB.
- Kelola SP (`lihat-sp-mh.php`, `detail-surat.php`) → page menampilkan data dari `backend/get-sp.php`/query langsung PHP.
- Reset password → `lupa-password.php` menghasilkan OTP (`backend/otp-request.php`), verifikasi di `input-otp.php` (`backend/otp-verify.php`), proses reset di `backend/reset-password-process.php`.
- Arsip & Unduh → file yang diupload dapat diarsipkan (`backend/surat-arsip.php`, `backend/auto-arsip.php`) dan diunduh lewat link aman.

---

## 🧩 Catatan Pengembangan & Kode

- JS: `js/sp-mahasiswa.js` digunakan untuk merender tabel SP; pola: `DOMContentLoaded` → ambil data → append `tr`.
- `js/script-login.js` saat ini dasar/empty — tempat ideal menaruh validasi login tambahan.
- Banyak halaman menyimpan data demo hard-coded (array). Jika ingin state persistence cepat tanpa server baru: gunakan `localStorage` (prototype).

---

## 🔐 Keamanan & Praktik Baik

- Simpan credential DB **di luar** repositori atau gunakan file konfigurasi yang tidak di-commit.
- Password harus selalu di-hash (seperti yang dipakai: bcrypt via `password_hash`/`password_verify`).
- Validasi input di server (tidak hanya di client) untuk mencegah SQL injection / XSS.

---

## ✅ Cara Menambah Fitur / Saran Perbaikan

- Tambahkan unit tests (PHPUnit) dan CI untuk code quality.
- Implementasi pagination, filter server-side untuk daftar SP besar.
- Tambahkan role-based access control lebih ketat (middleware check di tiap endpoint).
- Perbaiki path asset relative (hilangkan leading slash jika ingin support tanpa virtual host) atau gunakan base URL di config.

---

## 📋 Troubleshooting singkat

- 500 Internal Server Error: periksa `error_log` Apache / PHP dan cek `backend/config.php`.
- File upload gagal: periksa permission direktori `uploads/` dan `upload_max_filesize` di `php.ini`.
- Koneksi DB gagal: cek kredensial di `backend/config.php` dan pastikan database `dispol` sudah di-import.

---

## 👩‍💻 Kontribusi

1. Michael Sando Turnip - 3312501042 (UI/UX Design & Frontend Development.)
2. Muhammad Faturrahman - 3312501043 (Pengembangan Sistem & Backend Logic.)
3. Muhammad Ivan Febrian - 3312501044 (Backend Development & Penyelesaian Dokumen Proyek.)
4. Nur Iliyanie - 3312501045 (Frontend Development & Penyelesaian Laporan Proyek.)
