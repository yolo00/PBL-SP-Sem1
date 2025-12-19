<?php
session_start();
include "backend/config.php";

// Cek Cookie jika session belum ada
if (!isset($_SESSION['user_id']) && isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['user_id']  = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama']     = $row['nama'];
        $_SESSION['role']     = $row['role'];
        $_SESSION['email']    = $row['email'];
        $_SESSION['telepon']  = $row['telepon'];
        $_SESSION['jurusan']  = $row['jurusan'];
        $_SESSION['prodi']    = $row['prodi'];
        $_SESSION['kelas']    = $row['kelas'];
        $_SESSION['angkatan'] = $row['angkatan'];
        $_SESSION['nim']      = $row['nim'];
        $_SESSION['nik']      = $row['nik'];
        $_SESSION['jabatan']  = $row['jabatan'];
        $_SESSION['jenis_kelamin'] = $row['jenis_kelamin'];
        
        // Refresh cookie jika perlu
        setcookie('jenis_kelamin', $row['jenis_kelamin'], time() + (86400 * 30), "/");
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DISPOL | Landing Page</title>

    <link rel="stylesheet" href="css/landing-page.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" href="image/dispol.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">
                <img src="image/dispol.png" alt="DISPOL">
                <span class="brand">DISP<span class="brand-o">O</span>L</span>
            </a>

            <div class="nav-right">
                <div class="nav-menu">
                    <ul class="nav-links">
                        <li><a href="#features">Fitur</a></li>
                        <li><a href="#team">Tim</a></li>
                    </ul>

                    <div class="auth-buttons">
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <?php 
                  $dashboardLink = ($_SESSION['role'] == 'staf') ? 'dashboard-staf.php' : 'dashboard-mahasiswa.php';
                ?>
                        <a href="<?= $dashboardLink ?>" class="btn-login">Beranda</a>
                        <a href="backend/logout.php" class="btn-login">Keluar</a>
                        <?php else: ?>
                        <a href="login.php" class="btn-login">Masuk</a>
                        <a href="daftar.php" class="btn-login">Daftar</a>
                        <?php endif; ?>
                    </div>
                </div>

                <button class="menu-toggle" id="menuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-slider">
            <div class="slide slide-1"></div>
            <div class="slide slide-2"></div>
            <div class="slide slide-3"></div>
            <div class="slide slide-4"></div>
            <div class="slide slide-5"></div>
            <div class="slide slide-6"></div>
            <div class="slide slide-7"></div>
            <div class="slide slide-8"></div>
        </div>

        <div class="hero-content">
            <h1>Digitalisasi Surat Peringatan Sebagai Pengelolaan Staf Akademik Terhadap Mahasiswa Polibatam</h1>
            <p>Sistem terintegrasi untuk pengelolaan surat peringatan mahasiswa Polibatam.</p>
        </div>
    </section>

    <!-- ===== MAIN CONTENT AREA WITH SHARED AURA ===== -->
    <div class="aura-wrapper">
        <!-- ===== FITUR DISPOL ===== -->
        <section id="features" class="features-section">
            <h2 class="section-title">Fitur Unggulan <span>DISPOL</span></h2>
            <p class="section-subtitle">
                Sistem Digital Surat Peringatan Mahasiswa yang mudah, cepat, dan transparan
            </p>

            <div class="features-container">
                <!-- Card 1 -->
                <div class="feature-card" data-aos="fade-up">
                    <div class="feature-icon"><i class="fas fa-folder-open"></i></div>
                    <h3>Manajemen Surat Digital</h3>
                    <p>
                        Mengelola surat peringatan mahasiswa secara terpusat, rapi, dan aman
                        tanpa proses manual.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon"><i class="fas fa-search"></i></div>
                    <h3>Filter & Pencarian SP</h3>
                    <p>
                        Memudahkan pencarian surat peringatan berdasarkan mahasiswa, tingkat SP,
                        status, dan tanggal.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon"><i class="fas fa-pen-to-square"></i></div>
                    <h3>Input Surat Peringatan</h3>
                    <p>
                        Staf akademik dapat menambahkan surat peringatan baru melalui form yang
                        sederhana dan terstruktur.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon"><i class="fas fa-mobile-screen"></i></div>
                    <h3>Tampilan Responsif</h3>
                    <p>
                        Antarmuka dapat diakses dengan nyaman melalui desktop, tablet, dan
                        smartphone.
                    </p>
                </div>

                <!-- Card 5 -->
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon"><i class="fas fa-download"></i></div>
                    <h3>Unduh Surat Peringatan</h3>
                    <p>
                        Mahasiswa dapat melihat dan mengunduh surat peringatan langsung dari akun
                        masing-masing.
                    </p>
                </div>
            </div>
        </section>

        <!-- TEAM -->
        <section id="team" class="team">
            <h2>Tim Pengembang</h2>

            <div class="team-grid">
                <a href="https://www.instagram.com/acbdwsk?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                    target="_blank" class="team-card-link" style="text-decoration: none; color: inherit;">
                    <div class="team-card" data-aos="fade-up">
                        <img src="image/fotomikel.jpg" alt="Developer">
                        <h3>Michael Sando Turnip</h3>
                        <p>UI/UX Designer</p>
                    </div>
                </a>

                <a href="https://www.instagram.com/fthurrchmnn?igsh=cnA3NnhlYXVsbW5h" target="_blank"
                    class="team-card-link" style="text-decoration: none; color: inherit;">
                    <div class="team-card" data-aos="fade-up" data-aos-delay="100">
                        <img src="image/fotompatur.jpg" alt="Developer">
                        <h3>Muhammad Faturrahman</h3>
                        <p>Full Stack Developer</p>
                    </div>
                </a>

                <a href="https://www.instagram.com/vanfbrn_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                    target="_blank" class="team-card-link" style="text-decoration: none; color: inherit;">
                    <div class="team-card" data-aos="fade-up" data-aos-delay="200">
                        <img src="image/fotoivan.jpg" alt="Developer">
                        <h3>Muhammad Ivan Febrian</h3>
                        <p>Backend Developer</p>
                    </div>
                </a>

                <a href="https://www.instagram.com/nuriliyanie1?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                    target="_blank" class="team-card-link" style="text-decoration: none; color: inherit;">
                    <div class="team-card" data-aos="fade-up" data-aos-delay="300">
                        <img src="image/fotolilyy.jpg" alt="Developer">
                        <h3>Nur Iliyanie<br></br></h3>
                        <p>Frontend Developer</p>
                    </div>
                </a>
            </div>
        </section>

        <!-- SHARED AURA SQUARES -->
        <div class="content-aura">
            <ul class="squares">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div> <!-- End .aura-wrapper -->

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
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#team">Tim Pengembang</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <?php $dashboardLink = ($_SESSION['role'] == 'staf') ? 'dashboard-staf.php' : 'dashboard-mahasiswa.php'; ?>
                    <li><a href="<?= $dashboardLink ?>">Beranda</a></li>
                    <li><a href="backend/logout.php">Keluar</a></li>
                    <?php else: ?>
                    <li><a href="login.php">Masuk</a></li>
                    <li><a href="daftar.php">Daftar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="footer-right">
                <h4>Hubungi Kami</h4>
                <p><img src="image/icon-address.png" alt="Address"
                        style="width: 16px; height: 16px; vertical-align: middle; margin-right: 5px; filter: brightness(0) invert(1);">
                    Jl. Ahmad Yani Batam Kota,<br>Kota Batam, Kepulauan Riau, Indonesia</p>
                <p><img src="image/icon-contact.png" alt="Phone"
                        style="width: 16px; height: 16px; vertical-align: middle; margin-right: 5px; filter: brightness(0) invert(1);">
                    +62-778-469858 Ext.1017</p>
                <p><img src="image/icon-email.png" alt="Email"
                        style="width: 16px; height: 16px; vertical-align: middle; margin-right: 5px; filter: brightness(0) invert(1);">
                    info@polibatam.ac.id</p>
                <ul class="social-links">
                    <li><a href="https://www.instagram.com/polibatamofficial?igsh=MXNidmNrMDJobGY0Zw=="><img
                                src="image/icon-instagram.png" alt="Instagram"></a></li>
                    <li><a href="https://www.youtube.com/@polibatamofficial"><img src="image/icon-youtube.png"
                                alt="YouTube"></a></li>
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
    document.addEventListener("DOMContentLoaded", () => {
        // Initialize AOS
        AOS.init({
            once: true,
            duration: 1000,
        });

        /* ===============================
           HAMBURGER MENU NAVBAR
        =============================== */
        const menuToggle = document.querySelector(".menu-toggle");
        const navMenu = document.querySelector(".nav-menu");

        if (menuToggle && navMenu) {
            menuToggle.addEventListener("click", () => {
                navMenu.classList.toggle("show");
                menuToggle.classList.toggle("open");
            });
        }

        /* ===============================
           CLOSE MENU WHEN LINK CLICKED
        =============================== */
        document.querySelectorAll(".nav-links a").forEach(link => {
            link.addEventListener("click", () => {
                if (window.innerWidth < 900) {
                    navMenu.classList.remove("show");
                    menuToggle.classList.remove("open");
                }
            });
        });

        /* ===============================
           SMOOTH SCROLL
        =============================== */
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener("click", function(e) {
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
           NAVBAR SCROLL EFFECT
        =============================== */
        const navbar = document.querySelector(".navbar");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });

        /* ===============================
           CHARACTER HOVER EFFECT (HERO)
        =============================== */
        const heroTitle = document.querySelector(".hero-content h1");
        const heroDesc = document.querySelector(".hero-content p");

        const wrapCharacters = (element) => {
            if (!element) return;
            const text = element.innerText;
            const words = text.split(" ");
            element.innerHTML = "";

            words.forEach((word, wordIndex) => {
                const wordSpan = document.createElement("span");
                wordSpan.style.whiteSpace = "nowrap";
                wordSpan.style.display = "inline-block";

                [...word].forEach(char => {
                    const charSpan = document.createElement("span");
                    charSpan.innerText = char;
                    charSpan.classList.add("hover-char");
                    wordSpan.appendChild(charSpan);
                });

                element.appendChild(wordSpan);

                // Add space after word if not the last one
                if (wordIndex < words.length - 1) {
                    element.appendChild(document.createTextNode(" "));
                }
            });
        };

        wrapCharacters(heroTitle);
        wrapCharacters(heroDesc);
    });
    </script>
</body>

</html>