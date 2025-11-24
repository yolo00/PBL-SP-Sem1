<?php
session_start();
include "backend/config.php";

// Cek apakah user sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}
?>
<!DOCTYPE html><!--Michael Sando Turnip-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard-mahasiswa.css"><!--CSS-->
    <title>Beranda Mahasiswa</title>
</head>
<body>

<nav class="navbar">
    <div class="container nav-inner">
      <a class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
        <span class="brand">DISP<span class="brand-o">O</span>L</span>
      </a>
    <ul class="nav-links">
        <li><a href="dashboard-mahasiswa.php" class="active"><p>Beranda</p></a></li>
        <li><a href="profil-mahasiswa.php">Profil</a></li>
      </ul>
    </div>
</nav>

<!-- Tombol sidebar-->
<button id="sidebarToggle" class="sidebar-toggle" aria-label="Buka menu" aria-expanded="false">
  <span class="bar"></span>
  <span class="bar"></span>
  <span class="bar"></span>
</button>

<!-- Sidebar kanan -->
<aside id="sidebar" class="sidebar" aria-hidden="true">
  <nav class="sidebar-menu">
    <a href="pengumuman-mahasiswa.php" class="menu-item">Pengumuman</a>
    <a href="dashboard-mahasiswa.php" class="menu-item active">Daftar SP</a>
    <a href="riwayat-sp.php" class="menu-item">Riwayat SP</a>
  </nav>
</aside>

<section id="home" class="hero">
    <div class="container">
      <h1>Halo 👋, Selamat datang <span><?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Nama Mahasiswa'; ?></span></h1>
      <h2><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '33125XXXXX'; ?></h2>
    </div>
  </section>

  <!-- Tabel Section -->
  <section id="list" class="container">
    <div class="container2">
      <div class="tabelsp">
        <table>
          <thead>
            <tr>
              <th>Perihal</th>
              <th>Tingkat SP</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tabelSP">
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!--Footer-->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-left">
      <img src="image/dispol.png" alt="Logo Dispol" width="60">
      <div>
        <h3>DISPOL</h3>
        <p>Digitalisasi Surat Peringatan Mahasiswa Polibatam</p>
      </div>
    </div>
    <div class="footer-center">
      <h4>Menu</h4>
      <ul>
        <li><a href="dashboard-mahasiswa.php">Beranda</a></li>
        <li><a href="profil-mahasiswa.php">Profil</a></li>
      </ul>
    </div>
    <div class="footer-right">
      <h4>Hubungi Kami</h4>
      <p>Politeknik Negeri Batam<br>Jl. Ahmad Yani, Batam Center</p>
      <ul class="social-links">
        <li><a href="#"><img src="image/icon-facebook.png" alt="Facebook"></a></li>
        <li><a href="#"><img src="image/icon-twitter.png" alt="Twitter"></a></li>
        <li><a href="#"><img src="image/icon-instagram.png" alt="Instagram"></a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 DISPOL | All Rights Reserved</p>
  </div>
</footer>
<script src="js/sp-mahasiswa.js"></script>
</body>
</html>