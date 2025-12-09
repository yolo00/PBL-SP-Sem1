<!--Nama file: dashboard-staf.html-->
<!--Dibuat oleh: Muhammad Faturrahman-->

<?php
session_start();
include "backend/config.php";

// WAJIB ditaruh sebelum HTML, agar browser tidak simpan cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staf') {
    header("Location: login.php");
    exit;
}

// Ambil data user dari session
$data = $_SESSION;

// Ambil semua surat peringatan
$querySurat = mysqli_query($conn, "
    SELECT * FROM surat_peringatan
    WHERE status='aktif'
    ORDER BY id DESC
");

include "backend/auto-arsip.php";
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Staf</title>
    <link rel="stylesheet" href="css/dashboard-staf.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <a href="dashboard-staf.php" class="logo">
                <img src="image/dispol.png" width="65" height="65" alt="Logo DISPOL">
                <span class="brand">DISP<span class="brand-o">O</span>L</span>
            </a>

            <ul class="nav-links" id="navMenu">
                <li><a href="dashboard-staf.php" class="active">Beranda</a></li>
                <li><a href="kelola-staf.php">Kelola</a></li>
                <li><a href="arsip-staf.php">Arsip</a></li>
                <li><a href="profil-staf.php">Profil</a></li>
            </ul>
        </div>
    </nav>

    <section id="home" class="hero">
        <div data-aos="fade-up" data-aos-duration="1500">
            <h1>Selamat Datang di Layanan Surat Peringatan Mahasiswa Polibatam</h1>
        </div>
    </section>

    <div class="welcome">
        <h1>Halo👋, Selamat datang <span data-aos="fade-in" data-aos-delay="600"><?= $data['nama'] ?></span></h1>
        <h2><?= $data['nik'] ?></h2>
    </div>
    <div class="new">
        <h1>Surat Peringatan Aktif Terbaru</h1>
        <p id="noSuratMsg" class="no-surat-msg" style="display:none;">Tidak ada surat peringatan terbaru</p>
    </div>
    <div class="card-container">
        <?php
    if (mysqli_num_rows($querySurat) == 0) {
        echo "<p class=\"no-sp-found\" data-aos='fade-up'>🎉 Tidak ada surat peringatan aktif saat ini. Semua beres!</p>"; // Ubah tampilan pesan
    } else {
    while ($row = mysqli_fetch_assoc($querySurat)) {

        // Tentukan warna label SP
        $labelClass = "sp1";
        if ($row['tingkat'] == "SP II") $labelClass = "sp2";
        if ($row['tingkat'] == "SP III") $labelClass = "sp3";
    ?>

        <div class="card" data-aos="fade-up">
            <div class="sp-label <?= $labelClass ?>"><?= $row['tingkat'] ?></div>
            <div class="photo"></div>

            <div class="card-content">
                <p class="student-name"><strong><?= $row['nama'] ?></strong></p>
                <p class="student-detail">NIM: <?= $row['nim'] ?></p>
                <p class="student-detail">Prodi: <?= $row['prodi'] ?></p>
                <p class="issue-date">Tgl. Terbit: <?= $row['tanggal'] ?></p>
                <p class="sp-status">Status: <?= $row['status'] ?? 'Aktif' ?></p>
            </div>

            <a href="detail-surat.php?id=<?= $row['id'] ?>" class="detail">
                Lihat Rincian
                <i class="arrow-icon">→</i>
            </a>
        </div>
        <?php
 }
}
?>
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
    AOS.init({
        once: true,
        duration: 1000,
    });
    </script>
    <script>
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");

    menuToggle.addEventListener("click", () => {
        navMenu.classList.toggle("show");
    });
    </script>

</body>

</html>