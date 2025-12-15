<?php
session_start();
include "backend/config.php";

// Cegah browser menampilkan cache setelah logout
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Cek login dan role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staf') {
  header("Location: login.php");
  exit;
}

include "backend/auto-arsip.php";

$query = mysqli_query($conn, "
  SELECT * FROM surat_peringatan
  WHERE status='aktif'
  ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Surat - DISPOL</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/kelola-staff.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <!-- Logo -->
            <a href="dashboard-staf.php" class="logo">
                <img src="image/dispol.png" width="65" height="65" alt="Logo DISPOL">
                <span class="brand">DISP<span class="brand-o">O</span>L</span>
            </a>

            <!-- Hamburger Menu -->
            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- Nav Links -->
            <ul class="nav-links" id="navMenu">
                <li><a href="dashboard-staf.php">Beranda</a></li>
                <li><a href="kelola-staf.php" class="active">Kelola</a></li>
                <li><a href="arsip-staf.php">Arsip</a></li>
                <li><a href="profil-staf.php">Profil</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Container -->
    <div class="page-container">
        <main class="content-wrap">
            <h1><b>KELOLA SURAT PERINGATAN</b></h1>

            <!-- Table Container -->
            <section class="table-container">

                <!-- Filter Bar -->
                <div class="filter-bar">
                    <!-- Search -->
                    <div class="search-wrapper">
                        <span class="search-icon"><i class="fas fa-search"></i></span>
                        <input type="text" placeholder="Cari nama, NIM, atau prodi..." class="search-input"
                            id="filterSearch" aria-label="Cari surat">
                    </div>

                    <!-- Filter Tingkat -->
                    <select id="filterTingkat" aria-label="Filter tingkat peringatan">
                        <option value="">Semua Tingkat</option>
                        <option value="sp i">SP I</option>
                        <option value="sp ii">SP II</option>
                        <option value="sp iii">SP III</option>
                    </select>


                    <!-- Tombol Tambah -->
                    <button class="btn-tambah" onclick="window.location.href='tambah-surat.php'">
                        <i class="fas fa-plus"></i> Tambah Surat
                    </button>
                </div>

                <!-- Table Wrapper with Horizontal Scroll -->
                <div class="table-wrapper">
                    <table class="main-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Prodi</th>
                                <th>SP</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (mysqli_num_rows($query) == 0): ?>
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <p><i class="fas fa-clipboard-list" style="font-size: 2rem; margin-bottom: 15px; color: #ccc;"></i><br>Belum ada surat peringatan</p>
                                    <small>Klik tombol "Tambah Surat" untuk membuat surat baru</small>
                                </td>
                            </tr>
                            <?php else: ?>
                            <?php while($row = mysqli_fetch_assoc($query)): ?>
                            <tr data-nama="<?= strtolower($row['nama']) ?>" data-nim="<?= strtolower($row['nim']) ?>"
                                data-prodi="<?= strtolower($row['prodi']) ?>"
                                data-tingkat="<?= strtolower($row['tingkat']) ?>"
                                data-status="<?= strtolower($row['status']) ?>">
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['nim']) ?></td>
                                <td><?= htmlspecialchars($row['prodi']) ?></td>
                                <td><?= htmlspecialchars($row['tingkat']) ?></td>
                                <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                                <td>
                                    <span class="badge badge-<?= strtolower($row['status']) ?>">
                                        <?= htmlspecialchars($row['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="edit_surat.php?id=<?= $row['id'] ?>" title="Edit"
                                        aria-label="Edit surat <?= htmlspecialchars($row['nama']) ?>"><i class="fas fa-edit"></i></a>
                                    <a href="backend/arsip-manual.php?id=<?= $row['id'] ?>" title="Arsipkan"
                                        aria-label="Arsipkan surat <?= htmlspecialchars($row['nama']) ?>"
                                        onclick="return confirm('Arsipkan surat ini?')"><i class="fas fa-box-archive"></i></a>
                                    <a href="backend/surat-delete.php?id=<?= $row['id'] ?>" title="Hapus"
                                        aria-label="Hapus surat <?= htmlspecialchars($row['nama']) ?>"
                                        onclick="return confirm('Yakin ingin menghapus surat ini?')"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php endwhile ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>

                <!-- Scroll Hint (Mobile) -->
                <div class="scroll-hint">
                    ← Geser ke samping untuk melihat selengkapnya →
                </div>

            </section>

        </main>

        <!-- Footer -->
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
                        <li><a href="https://www.instagram.com/polibatamofficial?igsh=MXNidmNrMDJobGY0Zw==" aria-label="Instagram"><img src="image/icon-instagram.png" alt="Instagram"></a>
                        </li>
                        <li><a href="https://www.youtube.com/@polibatamofficial" aria-label="YouTube"><img src="image/icon-youtube.png" alt="YouTube"></a></li>
                        <li><a href="https://www.polibatam.ac.id" aria-label="Website"><img src="image/icon-website.png" alt="Website"></a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 DISPOL | All Rights Reserved</p>
            </div>
        </footer>
    </div>

    <!-- JavaScript -->
    <script src="js/filter.js"></script>

    <!-- Navbar Toggle Script -->
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
            menuToggle.classList.toggle('active');
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