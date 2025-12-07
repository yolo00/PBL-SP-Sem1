<?php include "backend/config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Surat</title>
  <link rel="stylesheet" href="css/tambah-surat.css">
  <link rel="icon" type="image/png" href="image/dispol.png">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar">
    <div class="container">
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a href="dashboard-staf.php" class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
        <span class="brand">DISP<span class="brand-o">O</span>L</span></a>
      <ul class="nav-links" id="navMenu">
        <li><a href="dashboard-staf.php">Beranda</a></li>
        <li><a href="kelola-staf.php" class="active">Kelola</a></li>
        <li><a href="arsip-staf.php">Arsip</a></li>
        <li><a href="profil-staf.php">Profil</a></li>
      </ul>
    </div>
  </nav>

  <main>
    <div class="title-bar">
      <h1><b>TAMBAH SURAT PERINGATAN BARU</b></h1>
    </div>

    <section class="form-container">
      <h2>Input Surat Peringatan</h2>

      <form action="backend/tambah_surat.php" method="POST" enctype="multipart/form-data">

        <div class="form-grid">

          <div>
            <label>Tingkat Peringatan</label>
            <select name="tingkat" required>
              <option value="SP I">SP I</option>
              <option value="SP II">SP II</option>
              <option value="SP III">SP III</option>
            </select>
          </div>

          <div>
            <label>Tanggal Dikeluarkan</label>
            <input type="date" name="tanggal" required>
          </div>

          <div>
            <label>Sampai Dengan Tanggal</label>
            <input type="date" name="sampai" required>
          </div>

        </div>

        <div class="form-grid">

          <div>
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Nama Mahasiswa" required>
          </div>

          <div>
            <label>NIM</label>
            <input type="text" name="nim" placeholder="3312xxxxxx" required>
          </div>

          <div>
            <label>Jurusan</label>
            <select name="jurusan" id="jurusanInput" required>
              <option value="Teknik Informatika">Teknik Informatika</option>
            </select>
          </div>

          <div>
            <label>Prodi</label>
            <select name="prodi" id="prodiInput" required>
              <option value="">Pilih Jurusan Terlebih Dahulu</option>
              <option value="Teknik Informatika">Teknik Informatika</option>
              <option value="Teknik Geomatika">Teknik Geomatika</option>
              <option value="Rekayasa Keamanan Siber">Rekayasa Keamanan Siber</option>
              <option value="Teknologi Rekayasa Multimedia">Teknologi Rekayasa Multimedia</option>
              <option value="Teknologi Rekayasa Perangkat Lunak">Teknologi Rekayasa Perangkat Lunak</option>
              <option value="Animasi">Animasi</option>
              <option value="Teknologi Permainan">Teknologi Permainan</option>
            </select>
          </div>

          <div>
            <label>Kelas</label>
            <select name="kelas" required>
              <option value="">Pilih Kelas</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
              <option value="E">E</option>
            </select>
          </div>

          <div>
            <label>Semester</label>
            <select name="semester" required>
              <option value="">Pilih Semester</option>
              <option value="1">Semester 1</option>
              <option value="2">Semester 2</option>
              <option value="3">Semester 3</option>
              <option value="4">Semester 4</option>
              <option value="5">Semester 5</option>
              <option value="6">Semester 6</option>
              <option value="7">Semester 7</option>
              <option value="8">Semester 8</option>
            </select>
          </div>

          <div>
            <label>Sesi Kelas</label>
            <select name="sesi_kelas" required>
              <option value="">Pilih Sesi Kelas</option>
              <option value="Pagi">Pagi</option>
              <option value="Malam">Malam</option>
            </select>
          </div>

        </div>

        <div>
          <label>Perihal</label>
          <input type="text" name="perihal" placeholder="Pelanggaran Tata Tertib">
        </div>

        <div>
          <label>Deskripsi Peringatan</label>
          <input type="text" name="deskripsi" placeholder="Tuliskan deskripsi singkat...">
        </div>

        <div>
          <label>Unggah File Surat Peringatan (Opsional)</label>
          <input type="file" name="file" accept=".pdf,.jpg,.png,.doc,.docx">
        </div>

        <div class="form-buttons">
          <button type="button" class="btn-batal" onclick="window.location.href='kelola-staf.php'">Batal</button>
          <button type="submit" class="btn-kirim">Kirim</button>
        </div>

      </form>
    </section>
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