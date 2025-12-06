<?php
session_start();

// Ambil config
$configPath = __DIR__ . '/backend/config.php';
if (!file_exists($configPath)) {
    die("Config not found at: $configPath");
}
require_once $configPath;

// Cek login
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'mahasiswa') {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}

$nim = $_SESSION['nim'];
$id_sp = isset($_GET['id']) ? $_GET['id'] : 0;

// Ambil detail surat, pastikan milik mahasiswa yang login
$stmt = $conn->prepare("SELECT * FROM surat_peringatan WHERE id = ? AND nim = ?");
$stmt->bind_param("is", $id_sp, $nim);
$stmt->execute();
$result = $stmt->get_result();
$sp = $result->fetch_assoc();

if (!$sp) {
    echo "<script>alert('Surat tidak ditemukan atau Anda tidak memiliki akses!'); window.location='dashboard-mahasiswa.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Surat Peringatan - <?= htmlspecialchars($sp['perihal']) ?></title>
    <link rel="stylesheet" href="css/lihat-spmh.css">
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="container nav-inner">
      <a class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
        <span class="brand">DISP<span class="brand-o">O</span>L</span>
      </a>
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
    <a href="dashboard-mahasiswa.php" class="menu-item active">Beranda</a>
    <a href="profil-mahasiswa.php" class="menu-item">Profil</a>
  </nav>
</aside>

<main class="main-content">
    <div class="detail-container">
        <div class="detail-header">
            <h2><?= isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Mahasiswa' ?></h2>
            <p>Mahasiswa Politeknik Negeri Batam</p>
        </div>

        <div class="rincian-surat">
            <h3>Rincian Surat Peringatan</h3>
            
            <div class="preview-container">
                <div class="preview-section">
                    <div class="section-header">
                        <h4>Data Surat Peringatan</h4>
                        <span class="status-badge status-<?= strtolower($sp['status']) ?>"><?= htmlspecialchars($sp['status']) ?></span>
                    </div>

                    <div class="preview-item">
                        <label>Tingkat SP:</label> 
                        <span><?= htmlspecialchars($sp['tingkat']) ?></span>
                    </div>
                    <div class="preview-item">
                        <label>Perihal:</label> 
                        <span><?= htmlspecialchars($sp['perihal']) ?></span>
                    </div>
                    <div class="preview-item">
                        <label>Tanggal Surat:</label> 
                        <span><?= date('d F Y', strtotime($sp['tanggal'])) ?></span>
                    </div>
                    <div class="preview-item">
                        <label>Berlaku Sampai:</label> 
                        <span><?= date('d F Y', strtotime($sp['sampai'])) ?></span>
                    </div>
                    <div class="preview-item">
                        <label>Deskripsi:</label> 
                        <span><?= nl2br(htmlspecialchars($sp['deskripsi'])) ?></span>
                    </div>
                    <div class="preview-item">
                        <label>File Surat:</label>
                        <?php if ($sp['file']) : ?>
                            <a href="uploads/<?= htmlspecialchars($sp['file']) ?>" target="_blank" class="file-link">Lihat File</a>
                        <?php else : ?>
                            <span>-</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-buttons">
            <button type="button" class="btn-kembali" onclick="window.location='dashboard-mahasiswa.php'">Kembali</button>
        </div>
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
        <li><a href="dashboard-mahasiswa.php">Beranda</a></li>
        <li><a href="profil-mahasiswa.php">Profil</a></li>
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

<script src="js/sp-mahasiswa.js"></script>
</body>
</html>