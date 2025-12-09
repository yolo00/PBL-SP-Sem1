<?php
session_start();
include "backend/config.php";

// Cegah browser menyimpan cache (WAJIB sebelum HTML)
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Cek login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staf') {
  header("Location: login.php");
  exit;
}

// Ambil data staf
$id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$data  = mysqli_fetch_assoc($query);

// Proses update profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nik = mysqli_real_escape_string($conn, $_POST['nik']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $prodi = mysqli_real_escape_string($conn, $_POST['prodi']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);

    $update_query = "UPDATE users SET nama='$nama', nik='$nik', jabatan='$jabatan', prodi='$prodi', email='$email', telepon='$telepon' WHERE id='$id'";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='profil-staf.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui profil!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profil Staf Akademik</title>
    <link rel="stylesheet" href="css/profil-staf.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="png" href="image/dispol.png">
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
                <img src="image/dispol.png" width="65" height="65" alt="dispol logo" />
                <span class="brand">DISP<span class="brand-o">O</span>L</span>
            </a>
            <ul class="nav-links" id="navMenu">
                <li><a href="dashboard-staf.php">Beranda</a></li>
                <li><a href="kelola-staf.php">Kelola</a></li>
                <li><a href="arsip-staf.php">Arsip</a></li>
                <li><a href="profil-staf.php" class="active">Profil</a></li>
            </ul>
        </div>
    </nav>

    <main class="profil-container-mahasiswa">
        <div class="header-section">
            <h1><b>EDIT PROFIL STAF AKADEMIK</b></h1>
            <p class="subtitle">Perbarui Data Identitas & Kontak</p>
        </div>

        <div class="profile-content-wrapper">
            <section class="profil-identitas-card">
                <form method="POST" action="">
                <div class="card-header-mahasiswa">
                    <div class="photo-placeholder">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="profil-info-header">
                        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required placeholder="Nama Staf">
                        <p class="nim-label">NIK: <?= htmlspecialchars($data['nik']); ?></p>
                    </div>
                </div>
                    <div class="profil-info-details">
                        <h3>Data Pribadi & Kontak</h3>
                        <div class="detail-group">
                            <div class="detail-item">
                                <span class="label">NIK</span>
                                <input type="text" name="nik" value="<?= htmlspecialchars($data['nik']); ?>" required>
                            </div>
                            <div class="detail-item">
                                <span class="label">Jabatan</span>
                                <input type="text" name="jabatan" value="<?= htmlspecialchars($data['jabatan']); ?>" required>
                            </div>
                            <div class="detail-item">
                                <span class="label">Program Studi</span>
                                <input type="text" name="prodi" value="<?= htmlspecialchars($data['prodi']); ?>" required>
                            </div>
                            <div class="detail-item">
                                <span class="label">Email</span>
                                <input type="email" name="email" value="<?= htmlspecialchars($data['email']); ?>" required>
                            </div>
                            <div class="detail-item">
                                <span class="label">No. HP</span>
                                <input type="tel" name="telepon" value="<?= htmlspecialchars($data['telepon']); ?>" required>
                            </div>
                        </div>
                    <div class="aksi-logout-area">
                        <button type="submit" class="btn-edit">Simpan Perubahan</button>
                        <a href="profil-staf.php"><button type="button" class="btn-logout">Batal</button></a>
                    </div>
                    </div>
                </form>
            </section>
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
