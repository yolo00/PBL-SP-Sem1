<!--Nama file: dashboard-staf.html-->
<!--Dibuat oleh: Muhammad Faturrahman-->

<?php
session_start();
include "backend/check-session.php";
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

// Tentukan halaman aktif
// Deteksi Mobile vs Desktop (Sederhana)
$isMobile = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
$limit = $isMobile ? 4 : 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = ($page < 1) ? 1 : $page;

$offset = ($page - 1) * $limit;

$keyword = $_GET['keyword'] ?? '';
$tingkat = $_GET['tingkat'] ?? '';

$where = "WHERE status='aktif'";

// Filter pencarian
if (!empty($keyword)) {
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $where .= " AND (nama LIKE '%$keyword%' OR nim LIKE '%$keyword%')";
}


if (!empty($tingkat)) {
    $tingkat = mysqli_real_escape_string($conn, $tingkat);
    $where .= " AND tingkat='$tingkat'";
}

// Filter Tambahan
$prodi = $_GET['prodi'] ?? '';
$semester = $_GET['semester'] ?? '';
$sesi_kelas = $_GET['sesi_kelas'] ?? '';

if (!empty($prodi)) {
    $prodi = mysqli_real_escape_string($conn, $prodi);
    $where .= " AND prodi='$prodi'";
}

if (!empty($semester)) {
    $semester = mysqli_real_escape_string($conn, $semester);
    $where .= " AND semester='$semester'";
}

if (!empty($sesi_kelas)) {
    $sesi_kelas = mysqli_real_escape_string($conn, $sesi_kelas);
    $where .= " AND sesi_kelas='$sesi_kelas'";
}


// 6 surat peringatan aktif terbaru
$querySurat = mysqli_query($conn, "
    SELECT * FROM surat_peringatan
    $where
    ORDER BY id DESC
    LIMIT $limit OFFSET $offset
");

// Hitung total halaman
$totalDataQuery = mysqli_query($conn, "
    SELECT id FROM surat_peringatan $where
");

$totalData = mysqli_num_rows($totalDataQuery);
$totalPage = ceil($totalData / $limit);

$totalPage = ceil($totalData / $limit);


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

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

    <section id="home" class="hero">
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
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1500">
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
    <div class="filter-search">
    <form method="GET" class="filter-form">
        <div class="search-group">
            <input 
                type="text" 
                name="keyword" 
                placeholder="Cari nama / NIM..." 
                value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
            >
            <button type="button" class="btn-filter-toggle" id="filterToggleBtn" title="Filter Pencarian">
                <i class="fas fa-filter"></i>
            </button>
            <button type="submit" class="btn-cari">Cari</button>
        </div>

        <div class="filter-options" id="filterOptions" style="display: none;">
            <select name="tingkat">
                <option value="">Semua Tingkat</option>
                <option value="SP I" <?= (($_GET['tingkat'] ?? '') == 'SP I') ? 'selected' : '' ?>>SP I</option>
                <option value="SP II" <?= (($_GET['tingkat'] ?? '') == 'SP II') ? 'selected' : '' ?>>SP II</option>
                <option value="SP III" <?= (($_GET['tingkat'] ?? '') == 'SP III') ? 'selected' : '' ?>>SP III</option>
            </select>

            <select name="prodi">
                <option value="">Semua Prodi</option>
                <option value="Teknik Informatika" <?= (($_GET['prodi'] ?? '') == 'Teknik Informatika') ? 'selected' : '' ?>>Teknik Informatika</option>
                <option value="Teknik Geomatika" <?= (($_GET['prodi'] ?? '') == 'Teknik Geomatika') ? 'selected' : '' ?>>Teknik Geomatika</option>
                <option value="Rekayasa Keamanan Siber" <?= (($_GET['prodi'] ?? '') == 'Rekayasa Keamanan Siber') ? 'selected' : '' ?>>Rekayasa Keamanan Siber</option>
                <option value="Teknologi Rekayasa Multimedia" <?= (($_GET['prodi'] ?? '') == 'Teknologi Rekayasa Multimedia') ? 'selected' : '' ?>>Teknologi Rekayasa Multimedia</option>
                <option value="Teknologi Rekayasa Perangkat Lunak" <?= (($_GET['prodi'] ?? '') == 'Teknologi Rekayasa Perangkat Lunak') ? 'selected' : '' ?>>Teknologi Rekayasa Perangkat Lunak</option>
                <option value="Animasi" <?= (($_GET['prodi'] ?? '') == 'Animasi') ? 'selected' : '' ?>>Animasi</option>
                <option value="Teknologi Permainan" <?= (($_GET['prodi'] ?? '') == 'Teknologi Permainan') ? 'selected' : '' ?>>Teknologi Permainan</option>
            </select>

            <select name="semester">
                <option value="">Semua Semester</option>
                <?php for($i=1; $i<=8; $i++): ?>
                    <option value="<?= $i ?>" <?= (($_GET['semester'] ?? '') == $i) ? 'selected' : '' ?>>Semester <?= $i ?></option>
                <?php endfor; ?>
            </select>

            <select name="sesi_kelas">
                <option value="">Semua Sesi</option>
                <option value="Pagi" <?= (($_GET['sesi_kelas'] ?? '') == 'Pagi') ? 'selected' : '' ?>>Pagi</option>
                <option value="Malam" <?= (($_GET['sesi_kelas'] ?? '') == 'Malam') ? 'selected' : '' ?>>Malam</option>
            </select>
        </div>
    </form>
</div>
    <div class="card-container">
<?php
if (mysqli_num_rows($querySurat) == 0) {
    // Cek apakah ada filter yang aktif
    $isFiltered = !empty($keyword) || !empty($tingkat) || !empty($prodi) || !empty($semester) || !empty($sesi_kelas);

    if ($isFiltered) {
        echo "<div style='text-align:center; padding: 40px; color: #666; width: 100%; grid-column: 1 / -1;'>
                <i class='fas fa-search' style='font-size: 40px; color: #ddd; margin-bottom: 15px;'></i>
                <p style='font-size: 1.1rem; font-weight: 500;'>Data tidak ditemukan</p>
                <p style='font-size: 0.9rem; color: #888;'>Coba ubah kata kunci atau reset filter pencarian Anda.</p>
              </div>";
    } else {
        echo "<p class='no-sp-found'>🎉 Tidak ada surat peringatan aktif.</p>";
    }
} else {
    while ($row = mysqli_fetch_assoc($querySurat)) {

        $labelClass = "sp1";
        if ($row['tingkat'] == "SP II") $labelClass = "sp2";
        if ($row['tingkat'] == "SP III") $labelClass = "sp3";
?>
    <div class="card" data-aos="fade-up">
        <div class="sp-label <?= $labelClass ?>"><?= $row['tingkat'] ?></div>

        <div class="card-content">
            <p class="student-name"><strong><?= $row['nama'] ?></strong></p>
            <p class="student-detail">NIM: <?= $row['nim'] ?></p>
            <p class="student-detail">Prodi: <?= $row['prodi'] ?></p>
            <p class="issue-date">Tgl. Terbit: <?= $row['tanggal'] ?></p>
            <p class="sp-status">Status: <?= $row['status'] ?? 'Aktif' ?></p>
        </div>

        <a href="detail-surat.php?id=<?= $row['id'] ?>" class="detail">
            Lihat Rincian <i class="arrow-icon">→</i>
        </a>
    </div>
<?php
    }
}
?>
</div> <!-- ❗ card-container TUTUP DI SINI -->
        

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>&keyword=<?= urlencode($keyword) ?>&tingkat=<?= urlencode($tingkat) ?>">‹ Sebelumya</a>
    <?php endif; ?>

    <span>Halaman <?= $page ?> dari <?= $totalPage ?></span>

    <?php if ($page < $totalPage): ?>
        <a href="?page=<?= $page + 1 ?>&keyword=<?= urlencode($keyword) ?>&tingkat=<?= urlencode($tingkat) ?>">Berikutnya ›</a>
    <?php endif; ?>
</div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="image/dispol.png" alt="Logo Dispol" width="60">
                <div>
                    <h3>DISPOL</h3>
                    <p>Digital Surat Peringatan Mahasiswa Polibatam</p>
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
                    <li><a href="https://www.instagram.com/polibatamofficial?igsh=MXNidmNrMDJobGY0Zw=="><img src="image/icon-instagram.png" alt="Instagram"></a></li>
          <li><a href="https://www.youtube.com/@polibatamofficial"><img src="image/icon-youtube.png" alt="YouTube"></a></li>
          <li><a href="https://www.polibatam.ac.id"><img src="image/icon-website.png" alt="Website"></a></li>
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
        menuToggle.classList.toggle("active");
    });

    const filterToggleBtn = document.getElementById("filterToggleBtn");
    const filterOptions = document.getElementById("filterOptions");

    if (filterToggleBtn && filterOptions) {
        filterToggleBtn.addEventListener("click", () => {
            if (filterOptions.style.display === "none") {
                filterOptions.style.display = "flex";
                filterOptions.style.flexWrap = "wrap";
                filterOptions.style.gap = "10px";
                filterOptions.style.marginTop = "15px";
                filterOptions.style.width = "100%";
                filterOptions.style.justifyContent = "center";
                filterOptions.style.animation = "fadeIn 0.3s ease";
            } else {
                filterOptions.style.display = "none";
            }
        });
    }
    </script>
</body>

</html>