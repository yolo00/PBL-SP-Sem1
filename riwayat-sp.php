<!--Lily, jangan lupa klaim hak mu😡-->
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Surat Peringatan</title>
  <link rel="stylesheet" href="css/riwayat-sp.css">
  <link rel="icon" type="image/png" href="image/dispol.png">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="container nav-inner">
      <a class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
        <span class="brand">DISP<span class="brand-o">O</span>L</span>
      </a>
      <ul class="nav-links">
        <li><a href="dashboard-mahasiswa.html" class="active">
            <p>Beranda</p>
          </a></li>
        <li><a href="profil-mahasiswa.html">Profil</a></li>
      </ul>
    </div>
  </nav>

  <!-- Tombol hamburger di bawah navbar -->
  <button id="sidebarToggle" class="sidebar-toggle" aria-label="Buka menu" aria-expanded="false">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
  </button>

  <!-- Sidebar kanan -->
  <aside id="sidebar" class="sidebar" aria-hidden="true">
    <nav class="sidebar-menu">
      <a href="pengumuman-mahasiswa.html" class="menu-item">Pengumuman</a>
      <a href="dashboard-mahasiswa.html" class="menu-item">Daftar SP</a>
      <a href="riwayat-sp.html" class="menu-item active">Riwayat SP</a>
    </nav>
  </aside>

  <main>
    <div class="title-bar">
      <h1>Riwayat Surat Peringatan</h1>
    </div>

    <section class="riwayat-container">
      <div id="riwayatList" class="riwayat-list">
        <!-- Data SP akan dimuat otomatis dari localStorage -->
      </div>

      <p id="noSPMessage" class="no-sp">Belum ada surat peringatan yang diterbitkan.</p>
    </section>
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
          <li><a href="riwayat-sp.html">Riwayat SP</a></li>
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

  <script src="js/riwayat-sp.js"></script>
</body>

</html>