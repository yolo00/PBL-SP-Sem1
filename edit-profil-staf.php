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

    <main class="profil-container-modern">
        <div class="header-section">
            <h1><b>EDIT PROFIL STAF AKADEMIK</b></h1>
        </div>

        <section class="profile-card-modern">
            <form method="POST" action="">
                <div class="card-left">
                    <div class="photo-placeholder">
                        <i class="fas fa-user fa-3x"></i>
                    </div>

                    <!-- Nama Staf -->
                    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>
                    <p class="staff-role">
                        Staf Akademik
                    </p>
                </div>

                <div class="card-right">
                    <h3>Detail Informasi</h3>
                    <div class="detail-group">
                        <p><span class="label">NIK</span><input type="text" name="nik" value="<?= htmlspecialchars($data['nik']); ?>" required></p>
                        <p><span class="label">Jabatan</span><input type="text" name="jabatan" value="<?= htmlspecialchars($data['jabatan']); ?>" required></p>
                        <p><span class="label">Program Studi</span><input type="text" name="prodi" value="<?= htmlspecialchars($data['prodi']); ?>" required></p>
                    </div>

                    <h3>Kontak</h3>
                    <div class="detail-group">
                        <p><span class="label">Email&nbsp;&nbsp;</span><input type="email" name="email" value="<?= htmlspecialchars($data['email']); ?>" required></p>
                        <p><span class="label">No. Telepon</span><input type="text" name="telepon" value="<?= htmlspecialchars($data['telepon']); ?>" required></p>
                    </div>
                </div>
                <div class="aksi-logout-area">
                    <button type="submit" class="btn-logout">Simpan Perubahan</button>
                    <a href="profil-staf.php"><button type="button" class="btn-logout">Batal</button></a>
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
                    <li><a href="https://www.facebook.com/share/1NGcdBa57o/https://www.facebook.com/share/1NGcdBa57o/"><img src="image/icon-facebook.png" alt="Facebook"></a></li>
                    <li><a href="#"><img src="image/icon-twitter.png" alt="Twitter"></a></li>
                    <li><a href="https://www.instagram.com/polibatamofficial?igsh=MXNidmNrMDJobGY0Zw=="><img src="image/icon-instagram.png" alt="Instagram"></a></li>
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
