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
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Staf Akademik</title>
    <link rel="stylesheet" href="css/profil-staf.css" />
    <link rel="stylesheet" href="css/loading.css">
    <link rel="icon" type="png" href="image/dispol.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <a href="dashboard-staf.php" class="logo">
                <img src="image/dispol.png" width="65" height="65" alt="dispol logo" />
                <span class="brand">DISP<span class="brand-o">O</span>L</span>
            </a>
            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
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
            <h1><b>PROFIL STAF AKADEMIK</b></h1>
            <p class="subtitle">Data Identitas & Kontak</p>
        </div>

        <div class="profile-content-wrapper">
            <section class="profil-identitas-card">
                <div class="card-header-mahasiswa">
                    <?php
                // Gunakan jenis_kelamin yang tersimpan di database (dipilih saat daftar akun)
                $gender = $data['jenis_kelamin'] ?? 'L';

                // Gunakan fa-user-tie untuk keduanya agar "berdasi"
                // Pembeda hanya warna (Pink vs Biru)
                $iconClass = 'fa-user-tie'; 
                $bgClass = ($gender == 'P') ? 'bg-pink' : 'bg-blue';
                ?>
                    <div class="photo-placeholder <?= $bgClass ?>" style="position: relative;">
                        <i class="fas <?= $iconClass ?>"></i>
                    </div>
                    <div class="profil-info-header">
                        <h2><?= $data['nama']; ?></h2>
                        <p class="nim-label">NIK: <?= $data['nik']; ?></p>
                    </div>
                </div>



                <style>
                .bg-pink {
                    background: #ffc2d1 !important;
                    color: #d63384 !important;
                }

                .bg-blue {
                    background: #e0e7ff !important;
                    color: #002b6b !important;
                }
                </style>



                <div class="profil-info-details">
                    <h3>Informasi Staf</h3>
                    <div class="detail-group">
                        <div class="detail-item">
                            <span class="label">Jabatan</span>
                            <span class="value"><?= $data['jabatan']; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Program Studi</span>
                            <span class="value"><?= $data['prodi']; ?></span>
                        </div>
                    </div>

                    <h3 style="margin-top: 30px;">Informasi Pribadi & Kontak</h3>
                    <div class="detail-group">
                        <div class="detail-item">
                            <span class="label">Email</span>
                            <span class="value"><?= $data['email']; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Telepon</span>
                            <span class="value"><?= $data['telepon']; ?></span>
                        </div>
                    </div>
                    
                    <!-- Tombol Edit -->
                    <div style="display: flex; align-items: flex-start; justify-content: flex-start; padding-top: 20px; margin-bottom: 30px;">
                         <button onclick="openEditModal()" style="background: transparent; border: 2px solid #0d00ff; color: #0d00ff; padding: 10px 30px; border-radius: 50px; cursor: pointer; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; text-decoration: none;">
                            <i class="fas fa-edit"></i> Edit Profil
                        </button>
                    </div>
                </div>
            </section>
        </div>

        <!-- MODAL EDIT PROFIL -->
        <div id="editModal" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Edit Kontak</h3>
                    <span class="close-btn" onclick="closeEditModal()">&times;</span>
                </div>
                <form action="backend/update-profil.php" method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= $data['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="telepon" value="<?= $data['telepon'] ?>" required>
                    </div>
                    <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                </form>
            </div>
        </div>

        <style>
            .modal-overlay {
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(0,0,0,0.5); z-index: 1000;
                display: flex; justify-content: center; align-items: center;
            }
            .modal-content {
                background: white; padding: 25px; border-radius: 10px;
                width: 90%; max-width: 400px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            }
            .modal-header {
                display: flex; justify-content: space-between; align-items: center;
                margin-bottom: 20px;
            }
            .close-btn { font-size: 24px; cursor: pointer; }
            .form-group { margin-bottom: 15px; text-align: left; }
            .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
            .form-group input { 
                width: 100%; padding: 10px; border: 1px solid #ddd; 
                border-radius: 5px; font-size: 14px;
            }
            .btn-simpan {
                width: 100%; padding: 10px; background: #0d00ff; color: white;
                border: none; border-radius: 5px; cursor: pointer; font-size: 16px;
            }
            .btn-simpan:hover { background: #0000cc; }
        </style>

        <script>
            function openEditModal() { document.getElementById('editModal').style.display = 'flex'; }
            function closeEditModal() { document.getElementById('editModal').style.display = 'none'; }
            
            // Tutup modal jika klik di luar area konten
            window.onclick = function(event) {
                if (event.target == document.getElementById('editModal')) {
                    closeEditModal();
                }
            }
        </script>

        <div class="aksi-logout-area">
            <button class="btn-logout" onclick="confirmLogout()">Keluar</button>
        </div>
    </main>

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

    // Logout confirmation
    function confirmLogout() {
        if (confirm('Yakin ingin keluar dari akun ini?')) {
            window.location.href = 'backend/logout.php';
        }
    }
    </script>

    <script src="js/loading.js"></script>
</body>

</html>