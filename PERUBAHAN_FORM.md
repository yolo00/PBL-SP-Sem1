# Dokumentasi Penambahan Form Semester dan Sesi Kelas

## Overview
Telah ditambahkan dua field form baru ke sistem Digitalisasi Surat Peringatan (DISPOL):
- **Semester**: Pilihan semester 1-8
- **Sesi Kelas**: Pilihan pagi atau malam

## Halaman yang Diperbarui

### 1. **tambah-surat.php** (Halaman Tambah Surat)
- Form Semester ditambahkan setelah field Kelas
- Form Sesi Kelas ditambahkan setelah field Semester
- Kedua field bersifat **required** (wajib diisi)

### 2. **edit_surat.php** (Halaman Edit Surat)
- Form Semester dengan nilai yang sudah tersimpan sebelumnya
- Form Sesi Kelas dengan nilai yang sudah tersimpan sebelumnya
- Kedua field bersifat **required** (wajib diisi)

### 3. **detail-surat.php** (Halaman Detail Surat)
- Menampilkan Semester dengan format "Semester X"
- Menampilkan Sesi Kelas (Pagi/Malam)

### 4. **detail_arsip.php** (Halaman Detail Arsip)
- Menampilkan Semester dengan format "Semester X"
- Menampilkan Sesi Kelas (Pagi/Malam)

## Backend yang Diperbarui

### 1. **backend/tambah_surat.php**
- Mengambil nilai `$_POST['semester']` dari form
- Mengambil nilai `$_POST['sesi_kelas']` dari form
- INSERT query diperbarui untuk menyimpan kedua field ke database

### 2. **backend/update_surat.php**
- Mengambil nilai `$_POST['semester']` dari form
- Mengambil nilai `$_POST['sesi_kelas']` dari form
- UPDATE query (dengan file) diperbarui untuk menyimpan kedua field
- UPDATE query (tanpa file) diperbarui untuk menyimpan kedua field

## Setup Database

**PENTING**: Jalankan query SQL di bawah ini untuk menambahkan kolom ke database:

```sql
ALTER TABLE surat_peringatan ADD COLUMN IF NOT EXISTS semester VARCHAR(1) DEFAULT NULL;
ALTER TABLE surat_peringatan ADD COLUMN IF NOT EXISTS sesi_kelas VARCHAR(50) DEFAULT NULL;
```

### Cara menjalankan:
1. Buka phpMyAdmin
2. Pilih database `dispol`
3. Klik tab "SQL"
4. Copy-paste query di atas
5. Klik tombol "Go" atau tekan Ctrl+Enter

**Alternatif**: Jalankan file `SETUP_DATABASE.sql` yang sudah disediakan.

## Data yang Disimpan

### Semester
- Nilai disimpan: `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8` (sebagai string)
- Tipe data: `VARCHAR(1)`

### Sesi Kelas
- Nilai disimpan: `Pagi` atau `Malam`
- Tipe data: `VARCHAR(50)`

## Testing

Untuk memverifikasi perubahan:

1. Buka halaman "Tambah Surat" (tambah-surat.php)
2. Isi semua field termasuk Semester dan Sesi Kelas
3. Klik "Kirim"
4. Verifikasi data tersimpan dengan membuka halaman "Detail Surat"
5. Edit surat dan verifikasi form Semester dan Sesi Kelas sudah terisi dengan nilai sebelumnya
6. Lihat di halaman "Arsip" apakah data menampilkan Semester dan Sesi Kelas

## Catatan
- Field Semester dan Sesi Kelas bersifat **wajib** untuk surat baru
- Data lama yang tidak memiliki nilai semester/sesi_kelas akan menampilkan `NULL` atau kosong
- Untuk data lama, lakukan update manual atau gunakan fitur Edit
