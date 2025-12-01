-- =========================================
-- SQL MIGRATION: Tambah Kolom Semester dan Sesi Kelas
-- =========================================
-- Jalankan query di bawah ini di phpMyAdmin untuk menambahkan kolom baru ke tabel surat_peringatan

-- Tambahkan kolom semester jika belum ada
ALTER TABLE surat_peringatan ADD COLUMN IF NOT EXISTS semester VARCHAR(1) DEFAULT NULL;

-- Tambahkan kolom sesi_kelas jika belum ada
ALTER TABLE surat_peringatan ADD COLUMN IF NOT EXISTS sesi_kelas VARCHAR(50) DEFAULT NULL;

-- Verifikasi struktur tabel (query untuk mengecek)
-- DESCRIBE surat_peringatan;
