<!--Michael Sando Turnip-->

<?php
session_start();
require_once __DIR__ . '/backend/check-session.php';

// Ambil config
$configPath = __DIR__ . '/backend/config.php';
if (!file_exists($configPath)) {
  die("Config not found at: $configPath");
}
require_once $configPath;

// Cache login
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'mahasiswa') {
  echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
  exit;
}
// Ambil NIM mahasiswa dari session
$nim = $_SESSION['nim'];

// Ambil semua surat milik mahasiswa
$spQuery = mysqli_query($conn, "
    SELECT * FROM surat_peringatan 
    WHERE nim = '$nim'
    ORDER BY tanggal DESC
");
?>

<!--Michael Sando Turnip-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard-mahasiswa.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!--CSS-->
    <link rel="icon" type="image/png" href="image/dispol.png">
    <title>Beranda Mahasiswa</title>
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <a href="dashboard-mahasiswa.php" class="logo">
                <img src="image/dispol.png" width="65" height="65" alt="Logo DISPOL">
                <span class="brand">DISP<span class="brand-o">O</span>L</span>
            </a>

            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="nav-links" id="navMenu">
                <li><a href="dashboard-mahasiswa.php" class="active">Beranda</a></li>
                <li><a href="profil-mahasiswa.php">Profil</a></li>
            </ul>
        </div>
    </nav>

    <section id="home" class="hero">
        <div class="container">
            <h1>Halo 👋, Selamat datang
                <span><?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Nama Mahasiswa'; ?></span>
            </h1>
            <h2><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '33125XXXXX'; ?>
            </h2>
        </div>
    </section>

    <!-- Tabel Section -->
    <section id="list" class="container">
        <div class="container2">
            <div class="tabelsp">
                <table>
                    <thead>
                        <tr>
                            <th>Perihal</th>
                            <th>Tingkat SP</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($spQuery) > 0) : ?>
                        <?php while ($sp = mysqli_fetch_assoc($spQuery)) : ?>
                        <tr onclick="window.location='lihat-sp-mh.php?id=<?= $sp['id'] ?>'" class="clickable-row">
                            <td><?= htmlspecialchars($sp['perihal']) ?></td>
                            <td><?= htmlspecialchars($sp['tingkat']) ?></td>
                            <td><?= date('d/m/Y', strtotime($sp['tanggal'])) ?></td>
                            <td><?= htmlspecialchars($sp['status']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 40px; color: #666; font-style: italic;">
                                Anda belum menerima surat peringatan aktif.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
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
                    <li><a href="dashboard-mahasiswa.php">Beranda</a></li>
                    <li><a href="profil-mahasiswa.php">Profil</a></li>
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