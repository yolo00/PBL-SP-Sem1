<?php
session_start();
include "backend/config.php";

// Cegah browser menyimpan cache (WAJIB sebelum HTML)
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Cek login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staf') {
    header("Location: login.php");
    exit;
}

// Ambil data staf
$id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$data  = mysqli_fetch_assoc($query);
?>



<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil Staf Akademik</title>
  <link rel="stylesheet" href="css/profil-staf.css" />
</head>
<body>
  
<nav class="navbar">
    <div class="container">
        <a class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
        <span class="brand">DISP<span class="brand-o">O</span>L</span>
        </a>
        <ul class="nav-links">
            <li><a href="dashboard-staf.php"><p>Beranda</p></a></li>
            <li><a href="kelola-staf.php">Kelola</li>
            <li><a href="arsip-staf.php">Arsip</li>
            <li><a href="profil-staf.php" class="active">Profil</a></li>
        </ul>
    </div>
</nav>

<main class="profil-container-modern">
  <div class="header-section">
      <h1><b>PROFIL STAF AKADEMIK</b></h1>
  </div>

  <section class="profile-card-modern">
      <div class="card-left">
          <div class="photo-placeholder">
              <i class="fas fa-user fa-3x"></i>
          </div>
          
          <!-- Nama Staf -->
          <h2 class="staff-name">
              <?= $data['nama']; ?>
          </h2>

          <p class="staff-role">
              Staf Akademik
          </p>
      </div>

      <div class="card-right">
          <h3>Detail Informasi</h3>
          <div class="detail-group">
              <p><span class="label">NIK</span><span class="value"><?= $data['nik']; ?></span></p>
              <p><span class="label">Jabatan</span><span class="value"><?= $data['jabatan']; ?></span></p>
              <p><span class="label">Program Studi</span><span class="value"><?= !empty($data['prodi']) ? $data['prodi'] : '-'; ?></span></p>
          </div>

          <h3>Kontak</h3>
          <div class="detail-group">
              <p><span class="label">Email&nbsp;&nbsp;</span><span class="value"><?= $data['email']; ?></span></p>
              <p><span class="label">No. Telepon</span><span class="value"><?= $data['telepon']; ?></span></p>
          </div>
      </div>
  </section> 

  <div class="aksi-logout-area">
      <a href="backend/logout.php">
        <button class="btn-logout">
          Keluar
        </button>
      </a>
  </div>

</main>

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
        <li><a href="dashboard-staf.php">Beranda</a></li>
        <li><a href="kelola-staf.php">Kelola</a></li>
        <li><a href="arsip-staf.php">Arsip</a></li>
        <li><a href="profil-staf.php">Profil</a></li>
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

</body>
</html>
