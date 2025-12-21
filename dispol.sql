-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2025 at 09:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dispol`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `otp_code` varchar(6) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `email`, `token`, `otp_code`, `expires_at`, `used`, `created_at`) VALUES
(1, 2147483647, 'faturrahman290607@gmail.com', '05cf7fb55bd6cb7205cce59184ce78591a330d63ac3580ed35b1695d79e2684b', '944373', '2025-12-20 15:26:38', 0, '2025-12-20 21:11:38'),
(2, 2147483647, 'faturrahman2906@gmail.com', '89556f2bc75e108ce39bbbb2cfe9d8710e95600f485ecc8bac6bf8b1f32c9feb', '070461', '2025-12-20 15:26:55', 0, '2025-12-20 21:11:55'),
(3, 2147483647, 'faturrahman290607@gmail.com', '3c6effb4fc8f01f1fdc52ce10d78920b129ee82950ad751cef25aebcfebc913c', '849551', '2025-12-20 15:32:16', 0, '2025-12-20 21:17:16'),
(4, 2147483647, 'faturrahman290607@gmail.com', 'b4490fc863b574f38b576dd5dca5211bf80d734ac35267f4e346c7021bb55709', '380643', '2025-12-20 15:32:27', 0, '2025-12-20 21:17:27'),
(5, 2147483647, 'faturrahman290607@gmail.com', '38e661e7cb280940e34d4fa175eb3f2145329da710e9d214e07e1d14afc8f348', '147281', '2025-12-20 15:32:29', 0, '2025-12-20 21:17:29'),
(6, 2147483647, 'faturrahman2906@gmail.com', '825fbc1f78cafb63d13cb16557c65a91c5b61af47233e2b30e09bf62acc63ea3', '714238', '2025-12-20 15:34:47', 0, '2025-12-20 21:19:47'),
(7, 2147483647, 'faturrahman290607@gmail.com', '7392c993e9c9b73305205c2328f86c1b63d96e0070caa75ac04bb78f9136ef3d', '148407', '2025-12-20 15:35:30', 0, '2025-12-20 21:20:30'),
(8, 2147483647, 'faturrahman290607@gmail.com', '1c16e3083babeff0d7226a71eda894938346422fe1d324d7738df7699a3d676f', '086366', '2025-12-20 15:35:32', 0, '2025-12-20 21:20:32'),
(9, 2147483647, 'faturrahman290607@gmail.com', '521ce6e89f37f6ba2345242a1648b5a98324f53d3defb2d2f4a833b049f7876f', '659945', '2025-12-20 15:35:34', 0, '2025-12-20 21:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `surat_peringatan`
--

CREATE TABLE `surat_peringatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `tingkat` enum('SP I','SP II','SP III') NOT NULL,
  `tanggal` date NOT NULL,
  `sampai` date NOT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Selesai') DEFAULT 'Aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `semester` varchar(10) NOT NULL,
  `sesi_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_peringatan`
--

INSERT INTO `surat_peringatan` (`id`, `nama`, `nim`, `jurusan`, `prodi`, `kelas`, `tingkat`, `tanggal`, `sampai`, `perihal`, `deskripsi`, `file`, `status`, `created_at`, `semester`, `sesi_kelas`) VALUES
(61, 'Muhammad Faturrahman', '3312501043', 'Teknik Informatika', 'Teknik Informatika', 'B', 'SP II', '2025-12-20', '2025-12-31', 'absen ', 'tidak hadir pada matkul siskom', '', 'Aktif', '2025-12-20 20:50:15', '1', 'Pagi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(64) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `role` enum('staf','mahasiswa') NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT 'L',
  `kelas` varchar(50) DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `token_expiry`, `role`, `nama`, `nik`, `nim`, `jurusan`, `prodi`, `jenis_kelamin`, `kelas`, `angkatan`, `jabatan`, `email`, `telepon`, `created_at`) VALUES
(3312501010, '33124567', '$2y$10$p70qsXDP7VOb1w9o1v3x7e9pk10oCYtgUCLTn2WqoaiR/jFkDRe0C', NULL, '2026-01-19 10:50:08', 'staf', 'Fatur', '33124567', NULL, NULL, 'Teknik Informatika', 'L', NULL, NULL, 'TU', 'faturrahman2906@gmail.com', '085823310134', '2025-12-20 05:16:31'),
(3312501011, '3312501043', '$2y$10$/mPGSBOBf0wl8eR5BmxZIuq7ROBVAj0vRV98aUSmh9PYASwgZ3WqS', '82162389f60bdebf5aede37e2c07cbe41d3df0cb4f1fefc7be0d6c75d6f82ee0', '2026-01-19 10:47:34', 'mahasiswa', 'Muhammad Faturrahman', NULL, '3312501043', NULL, 'Teknik Informatika', 'L', 'B', '2025', NULL, 'faturrahman290607@gmail.com', '085823310134', '2025-12-20 05:37:53'),
(3312501012, '331245678', '$2y$10$m.xUcaYubCbTeIK0qlcz7.aXBq3O3pzqlWxVlOys466Ym0pn/Wewi', NULL, NULL, 'staf', 'Muradika L.P', '331245678', NULL, NULL, 'Teknik Informatika', 'L', NULL, NULL, 'TU', 'faturrahman290607@gmail.com', '085823310134', '2025-12-20 08:52:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_token` (`token`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_expires` (`expires_at`);

--
-- Indexes for table `surat_peringatan`
--
ALTER TABLE `surat_peringatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idx_remember_token` (`remember_token`,`token_expiry`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat_peringatan`
--
ALTER TABLE `surat_peringatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3312501013;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
