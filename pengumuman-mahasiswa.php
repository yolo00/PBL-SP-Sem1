<!--File: Pengumuman-->
<!--Michael Sando Turnip-->
<!--Note: Ini bakal jadi landing page nantinya dan belum yakin mau ditambahin atau gak-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pengumuman-mahasiswa.css"><!--CSS-->
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
        <li><a href="dashboard-mahasiswa.html" class="active"><p>Beranda</p></a></li>
        <li><a href="profil-mahasiswa.html">Profil</a></li>
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
    <a href="pengumuman-mahasiswa.html" class="menu-item active">Pengumuman</a>
    <a href="dashboard-mahasiswa.html" class="menu-item">Daftar SP</a>
    <a href="riwayat-sp.html" class="menu-item">Riwayat SP</a>
  </nav>
</aside>


<section id="home" class="hero">
  <div data-aos="fade-up">
    <h1>Selamat Datang di Layanan Surat Peringatan Mahasiswa Polibatam</h1>
  </div>
</section>

<div class="welcome">
  <h1>Halo, Selamat datang <span>..(Nama Mahasiswa)</span>👋</h1>
  <h2>(33125......)</h2>
</div>

<!--Pengumuman-->
<section id="pengumuman" class="container announcements-section" aria-labelledby="announcements-heading">
  <h2 id="announcements-heading" class="section-title">Panduan Sistem Informasi dan Layanan Mahasiswa</h2>

  <div id="announcementsGrid" class="announcement-grid" aria-live="polite">
    <!-- Cards akan di-render oleh JS -->
  </div>

  <!-- Fallback jika JS mati (akan disembunyikan oleh JS saat ada data) -->
  <noscript>
    <p class="no-data">JavaScript dinonaktifkan — daftar pengumuman tidak dapat ditampilkan.</p>
  </noscript>
</section>


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
        <li><a href="profil-mahasiswa.html">Profil</a></li>
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
<script src="js/pengumuman-mahasiswa.js"></script>
</body>
</html>