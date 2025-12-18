<!--Michael Sando Turnip-->
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
    <div class="container">
      <a href="dashboard-mahasiswa.php" class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="Logo DISPOL">
        <span class="brand">DISP<span class="brand-o">O</span>L</span>
      </a>

      <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <ul class="nav-links" id="navMenu">
        <li><a href="dashboard-mahasiswa.php">Beranda</a></li>
        <li><a href="profil-mahasiswa.php">Profil</a></li>
      </ul>
    </div>
  </nav>







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
        menuToggle.classList.toggle("active");
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
})();

</script>
</body>
</html>