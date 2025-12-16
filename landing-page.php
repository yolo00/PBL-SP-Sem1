<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DISPOL | Landing Page</title>

  <link rel="stylesheet" href="css/landing-page.css">
  <link rel="icon" href="image/dispol.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="container">
    <a href="#" class="logo">
      <img src="image/dispol.png" alt="DISPOL">
      <span class="brand">DISP<span class="brand-o">O</span>L</span>
    </a>

    <a href="login.php" class="btn-login">Login</a>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    <h1>Digitalisasi Surat Peringatan Mahasiswa</h1>
    <p>Sistem terintegrasi untuk pengelolaan surat peringatan mahasiswa Polibatam.</p>
  </div>
</section>

<!-- ===== FITUR DISPOL ===== -->
<section id="features" class="features-section">
  <h2 class="section-title">Fitur Unggulan <span>DISPOL</span></h2>
  <p class="section-subtitle">
    Sistem Digital Surat Peringatan Mahasiswa yang mudah, cepat, dan transparan
  </p>

  <div class="features-container">
    <!-- Card 1 -->
    <div class="feature-card">
      <div class="feature-icon">📂</div>
      <h3>Manajemen Surat Digital</h3>
      <p>
        Mengelola surat peringatan mahasiswa secara terpusat, rapi, dan aman
        tanpa proses manual.
      </p>
    </div>

    <!-- Card 2 -->
    <div class="feature-card">
      <div class="feature-icon">🔍</div>
      <h3>Filter & Pencarian SP</h3>
      <p>
        Memudahkan pencarian surat peringatan berdasarkan mahasiswa, tingkat SP,
        status, dan tanggal.
      </p>
    </div>

    <!-- Card 3 -->
    <div class="feature-card">
      <div class="feature-icon">✍️</div>
      <h3>Input Surat Peringatan</h3>
      <p>
        Staf akademik dapat menambahkan surat peringatan baru melalui form yang
        sederhana dan terstruktur.
      </p>
    </div>

    <!-- Card 4 -->
    <div class="feature-card">
      <div class="feature-icon">📱</div>
      <h3>Tampilan Responsif</h3>
      <p>
        Antarmuka dapat diakses dengan nyaman melalui desktop, tablet, dan
        smartphone.
      </p>
    </div>

    <!-- Card 5 -->
    <div class="feature-card">
      <div class="feature-icon">📥</div>
      <h3>Unduh Surat Peringatan</h3>
      <p>
        Mahasiswa dapat melihat dan mengunduh surat peringatan langsung dari akun
        masing-masing.
      </p>
    </div>
  </div>
</section>

<!-- TEAM -->
<section class="team">
  <h2>Tim Pengembang</h2>

  <div class="team-grid">
    <div class="team-card">
      <img src="image/team1.jpg" alt="Developer">
      <h3>Michael Sando Turnip</h3>
      <p>Backend Developer</p>
    </div>

    <div class="team-card">
      <img src="image/team2.jpg" alt="Developer">
      <h3>Muhammad Faturrahman</h3>
      <p>Frontend Developer</p>
    </div>

    <div class="team-card">
      <img src="image/team3.jpg" alt="Developer">
      <h3>Muhammad Ivan Febrian</h3>
      <p>UI/UX Designer</p>
    </div>

    <div class="team-card">
      <img src="image/team3.jpg" alt="Developer">
      <h3>Nur Iliyanie</h3>
      <p>UI/UX Designer</p>
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
          <li><a href="landing-page.php">Beranda</a></li>
          <li><a href="login.php">Login</a></li>
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
  document.addEventListener("DOMContentLoaded", () => {

  /* ===============================
     HAMBURGER MENU NAVBAR
  =============================== */
  const menuToggle = document.querySelector(".menu-toggle");
  const navLinks = document.querySelector(".nav-links");

  if (menuToggle && navLinks) {
    menuToggle.addEventListener("click", () => {
      navLinks.classList.toggle("show");
      menuToggle.classList.toggle("open");
    });
  }

  /* ===============================
     CLOSE MENU WHEN LINK CLICKED
  =============================== */
  document.querySelectorAll(".nav-links a").forEach(link => {
    link.addEventListener("click", () => {
      if (window.innerWidth < 900) {
        navLinks.classList.remove("show");
        menuToggle.classList.remove("open");
      }
    });
  });

  /* ===============================
     SMOOTH SCROLL
  =============================== */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start"
        });
      }
    });
  });

  /* ===============================
     TEAM CARD INTERACTION
  =============================== */
  document.querySelectorAll(".team-card").forEach(card => {
    card.addEventListener("mouseenter", () => {
      card.style.transform = "translateY(-10px)";
    });

    card.addEventListener("mouseleave", () => {
      card.style.transform = "translateY(0)";
    });

    card.addEventListener("click", () => {
      alert("👋 Tim Pengembang DISPOL");
    });
  });

  /* ===============================
     NAVBAR SHADOW ON SCROLL
  =============================== */
  const navbar = document.querySelector(".navbar");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 30) {
      navbar.style.boxShadow = "0 4px 12px rgba(0,0,0,0.4)";
    } else {
      navbar.style.boxShadow = "0 2px 10px rgba(0,0,0,0.3)";
    }
  });

});
</script>
</body>
</html>
