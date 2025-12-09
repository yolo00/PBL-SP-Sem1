<?php
session_start();
include "backend/config.php";

// Cek apakah user sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil Mahasiswa - DISPOL</title>
  <link rel="stylesheet" href="css/profil-mahasiswa.css" />
  <link rel="icon" type="image/png" href="image/dispol.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="container">
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <a href="dashboard-mahasiswa.php" class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="Logo DISPOL">
        <span class="brand">DISP<span class="brand-o">O</span>L</span>
      </a>

      <ul class="nav-links" id="navMenu">
        <li><a href="dashboard-mahasiswa.php">Beranda</a></li>
        <li><a href="profil-mahasiswa.php" class="active">Profil</a></li>
      </ul>
    </div>
  </nav>

  <main class="profil-container-mahasiswa">
    <div class="header-section">
      <h1><b>PROFIL MAHASISWA</b></h1>
      <p class="subtitle">Data Akademik & Informasi Pribadi</p>
    </div>

    <div class="profile-content-wrapper">
      <section class="profil-identitas-card">
        <div class="card-header-mahasiswa">
          <div class="photo-placeholder">
            <i class="fas fa-user-graduate"></i>
          </div>
          <div class="profil-info-header">
            <h2><?php echo htmlspecialchars($_SESSION['nama'] ?? 'Nama Mahasiswa'); ?></h2>
            <p class="nim-label">NIM: <?php echo htmlspecialchars($_SESSION['nim'] ?? '-'); ?></p>
          </div>
        </div>
        
        <div class="profil-info-details">
          <h3><i class="fas fa-graduation-cap"></i> Informasi Akademik</h3>
          <div class="detail-group">
            <div class="detail-item">
              <span class="label"><i class="fas fa-building"></i> Program Studi</span>
              <span class="value"><?php echo htmlspecialchars($_SESSION['prodi'] ?? '-'); ?></span>
            </div>
            <div class="detail-item">
              <span class="label"><i class="fas fa-university"></i> Jurusan</span>
              <span class="value"><?php echo htmlspecialchars($_SESSION['jurusan'] ?? '-'); ?></span>
            </div>
            <div class="detail-item">
              <span class="label"><i class="fas fa-users"></i> Kelas</span>
              <span class="value"><?php echo htmlspecialchars($_SESSION['kelas'] ?? '-'); ?></span>
            </div>
            <div class="detail-item">
              <span class="label"><i class="fas fa-calendar-alt"></i> Angkatan</span>
              <span class="value"><?php echo htmlspecialchars($_SESSION['angkatan'] ?? '-'); ?></span>
            </div>
          </div>

          <h3><i class="fas fa-address-card"></i> Informasi Kontak</h3>
          <div class="detail-group">
            <div class="detail-item">
              <span class="label"><i class="fas fa-envelope"></i> Email</span>
              <span class="value"><?php echo htmlspecialchars($_SESSION['email'] ?? '-'); ?></span>
            </div>
            <div class="detail-item">
              <span class="label"><i class="fas fa-phone"></i> No. Telepon</span>
              <span class="value"><?php echo htmlspecialchars($_SESSION['telepon'] ?? '-'); ?></span>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="aksi-logout-area">
<<<<<<< HEAD
        <a href="edit-profil-mahasiswa.php"><button class="btn-logout">Edit Profil</button></a>
        <button class="btn-logout" id="logoutBtn">Keluar</button>
=======
      <button class="btn-logout" onclick="confirmLogout()">
        <i class="fas fa-sign-out-alt"></i> Keluar
      </button>
>>>>>>> c327f355a5f14bff985be27ae1359fe89f48ff58
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
          <li><a href="dashboard-mahasiswa.php">Beranda</a></li>
          <li><a href="profil-mahasiswa.php">Profil</a></li>
        </ul>
      </div>
      <div class="footer-right">
        <h4>Hubungi Kami</h4>
        <p><img src="image/icon-address.png" alt="Address" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 5px; filter: brightness(0) invert(1);"> Jl. Ahmad Yani Batam Kota,<br>Kota Batam, Kepulauan Riau, Indonesia</p>
        <p><img src="image/icon-contact.png" alt="Phone" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 5px; filter: brightness(0) invert(1);"> +62-778-469858 Ext.1017</p>
        <p><img src="image/icon-email.png" alt="Email" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 5px; filter: brightness(0) invert(1);"> info@polibatam.ac.id</p>
        <ul class="social-links">
          <li><a href="https://www.instagram.com/polibatamofficial?igsh=MXNidmNrMDJobGY0Zw=="><img src="image/icon-instagram.png" alt="Instagram"></a></li>
          <li><a href="https://www.youtube.com/@polibatamofficial"><img src="image/icon-youtube.png" alt="YouTube"></a></li>
          <li><a href="https://www.polibatam.ac.id"><img src="image/icon-website.png" alt="Website"></a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 DISPOL | All Rights Reserved</p>
    </div>
  </footer>

  <script>
    // Navbar toggle
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if (menuToggle && navMenu) {
      menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('show');
      });
    }

    // Logout confirmation
    function confirmLogout() {
      if (confirm('Yakin ingin keluar dari akun ini?')) {
        window.location.href = 'backend/logout.php';
      }
    }
  </script>
</body>
</html>