<?php
session_start();
include "backend/config.php";

// Cek apakah user sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}
?>
<!--Muhammad Ivan Febrian-->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil Mahasiswa</title>
  <link rel="stylesheet" href="css/profil-mahasiswa.css" />
</head>
<body>
  <!-- Navbar -->
<nav class="navbar">
    <div class="container nav-inner">
      <a class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
        <span class="brand">DISP<span class="brand-o">O</span>L</span>
    </a>

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
    <a href="dashboard-mahasiswa.php" class="menu-item">Beranda</a>
    <a href="profil-mahasiswa.php" class="menu-item active">Profil</a>
  </nav>
</aside>

<main class="profil-container-mahasiswa">
    <div class="header-section">
        <h1><i class="fas fa-id-badge"></i><b>PROFIL MAHASISWA</b></h1>
    </div>

    <div class="profile-content-wrapper">
        <section class="profil-identitas-card">
            <div class="card-header-mahasiswa">
                <div class="photo-placeholder">
                    <i class="fas fa-user-graduate fa-3x"></i>
                </div>
                <div class="profil-info-header">
                    <h2><?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Nama Mahasiswa'; ?></h2>
                    <p class="nim-label">NIM: <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '3312501048'; ?></p>
                </div>
            </div>
            
            <div class="profil-info-details">
                <h3><i class="fas fa-address-book"></i> Data Pribadi & Kontak</h3>
                <div class="detail-group">
                    <p><span class="label">Prodi</span><span class="value"><?php echo isset($_SESSION['prodi']) ? htmlspecialchars($_SESSION['prodi']) : '-'; ?></span></p>
                    <p><span class="label">Jurusan</span><span class="value"><?php echo isset($_SESSION['jurusan']) ? htmlspecialchars($_SESSION['jurusan']) : '-'; ?></span></p>
                    <p><span class="label">Kelas</span><span class="value"><?php echo isset($_SESSION['kelas']) ? htmlspecialchars($_SESSION['kelas']) : '-'; ?></span></p>
                    <p><span class="label">Angkatan</span><span class="value"><?php echo isset($_SESSION['angkatan']) ? htmlspecialchars($_SESSION['angkatan']) : '-'; ?></span></p>
                    <p><span class="label">Email</span><span class="value"><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '-'; ?></span></p>
                    <p><span class="label">No. HP</span><span class="value"><?php echo isset($_SESSION['telepon']) ? htmlspecialchars($_SESSION['telepon']) : '-'; ?></span></p>
                </div>
            </div>
        </section>

        <section class="akademik-card-modern">
            <h3><i class="fas fa-chart-line"></i> Informasi Akademik</h3>
            <div class="detail-group">
                <p><span class="label">IPK Terakhir</span><span class="value ipk">3.62</span></p>
                <p><span class="label">SKS Ditempuh</span><span class="value">108</span></p>
                <p><span class="label">Dosen Wali</span><span class="value dosen-wali">Ir. Ahmad Taufik, M.Kom</span></p>
                <p><span class="label">Status Akademik</span><span class="value status-aktif">Aktif</span></p>
            </div> 
        </section>
    </div>

    <div class="aksi-logout-area">
        <button class="btn-logout" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Keluar</button>
    </div>
</main>
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
              <li><a href="dashboard-mahasiswa.html">Beranda</a></li>
              <li><a href="profil-mahasiswa.html">Kelola</a></li>
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
  <script src="js/profil-mahasiswa.js"></script>
</body>
</html>
