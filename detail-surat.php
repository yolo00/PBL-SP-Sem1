<!-- dibuat oleh: Nur Iliyanie -->
<?php
session_start();
include "backend/config.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('Surat tidak ditemukan'); window.location='dashboard-staf.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM surat_peringatan WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan'); window.location='dashboard-staf.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Surat Peringatan | DISPOL</title>
  <link rel="stylesheet" href="css/detail-surat.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/dispol.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
   <nav class="navbar">
        <div class="container">
            <a href="dashboard-staf.php" class="logo">
                <img src="image/dispol.png" width="65" height="65" alt="Logo DISPOL">
                <span class="brand">DISP<span class="brand-o">O</span>L</span>
            </a>

            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="nav-links" id="navMenu">
                <li><a href="dashboard-staf.php" class="active">Beranda</a></li>
                <li><a href="kelola-staf.php">Kelola</a></li>
                <li><a href="arsip-staf.php">Arsip</a></li>
                <li><a href="profil-staf.php">Profil</a></li>
            </ul>
        </div>
    </nav>

  <div class="detail-container" data-aos="fade-up">
    <div class="detail-header">
      <h2 id="namaMahasiswaHeader"><?= $data['nama'] ?></h2>
      <p>Mahasiswa Politeknik Negeri Batam</p>
    </div>
 
    <div class="rincian-surat">
      <h3>Rincian Surat Peringatan</h3>
      <div class="preview-container">

        <!-- DATA MAHASISWA -->
        <div class="preview-section">
          <h4>Data Mahasiswa</h4>

          <div class="preview-item"><label>Nama:</label> <span><?= $data['nama'] ?></span></div>
          <div class="preview-item"><label>NIM:</label> <span><?= $data['nim'] ?></span></div>
          <div class="preview-item"><label>Program Studi:</label> <span><?= $data['prodi'] ?></span></div>
          <div class="preview-item"><label>Jurusan:</label> <span><?= $data['jurusan'] ?></span></div>
          <div class="preview-item"><label>Kelas:</label> <span><?= $data['kelas'] ?></span></div>
          <div class="preview-item"><label>Semester:</label> <span>Semester <?= $data['semester'] ?></span></div>
          <div class="preview-item"><label>Sesi Kelas:</label> <span><?= $data['sesi_kelas'] ?></span></div>
          <div class="preview-item"><label>Status:</label> 
            <span><?= $data['status'] ?? 'Aktif' ?></span></div>
        </div>

        <!-- DATA SURAT -->
        <div class="preview-section">
          <h4>Data Surat Peringatan</h4>

          <div class="preview-item"><label>Tingkat SP:</label> <span><?= $data['tingkat'] ?></span></div>
          <div class="preview-item"><label>Tanggal Surat:</label> <span><?= $data['tanggal'] ?></span></div>
          <div class="preview-item"><label>Perihal:</label> <span><?= $data['perihal'] ?></span></div>
          <div class="preview-item"><label>Deskripsi:</label> <span><?= $data['deskripsi'] ?></span></div>
          <div class="preview-item">
            <label>File Surat:</label>
            <?php if ($data['file']): ?>
              <a href="uploads/<?= $data['file'] ?>" target="_blank">Lihat File</a>
            <?php else: ?>
              <span>-</span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div> 
    
    <!-- Tombol -->
    <div class="form-buttons">
      <button type="button" class="btn btn-batal" onclick="window.history.back()">Kembali</button>
    </div>

  </div>

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

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ once:true, duration:1000 });
  </script>
  <script>
  (function() {
      const menuToggle = document.getElementById("menuToggle");
      const navMenu = document.getElementById("navMenu");
      const body = document.body;

      if (!menuToggle || !navMenu) return;

      // Create overlay
      const overlay = document.createElement('div');
      overlay.style.cssText = `
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100vh;
          background: rgba(0, 0, 0, 0.5);
          opacity: 0;
          visibility: hidden;
          transition: all 0.3s ease;
          z-index: 998;
      `;
      body.appendChild(overlay);

      function toggleMenu() {
          const isOpen = navMenu.classList.contains('show');
          if (isOpen) {
              closeMenu();
          } else {
              openMenu();
          }
      }

      function openMenu() {
          navMenu.classList.add('show');
          overlay.style.opacity = '1';
          overlay.style.visibility = 'visible';
          body.style.overflow = 'hidden';
          menuToggle.setAttribute('aria-expanded', 'true');
      }

      function closeMenu() {
          navMenu.classList.remove('show');
          overlay.style.opacity = '0';
          overlay.style.visibility = 'hidden';
          body.style.overflow = '';
          menuToggle.setAttribute('aria-expanded', 'false');
      }

      menuToggle.addEventListener('click', toggleMenu);
      overlay.addEventListener('click', closeMenu);

      // Close on link click
      navMenu.querySelectorAll('a').forEach(link => {
          link.addEventListener('click', () => {
              if (window.innerWidth < 900) {
                  closeMenu();
              }
          });
      });

      // Close on ESC
      document.addEventListener('keydown', (e) => {
          if (e.key === 'Escape' && navMenu.classList.contains('show')) {
              closeMenu();
          }
      });

      // Close on resize
      let resizeTimer;
      window.addEventListener('resize', () => {
          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(() => {
              if (window.innerWidth >= 900 && navMenu.classList.contains('show')) {
                  closeMenu();
              }
          }, 250);
      });
  })();
  </script>
</body>
</html>
