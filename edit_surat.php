<!-- dibuat oleh: Nur Iliyanie -->
<?php
include "backend/config.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM surat_peringatan WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat | DISPOL</title>
    <link rel="stylesheet" href="css/edit_surat.css">
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <a href="dashboard-staf.php" class="logo">
                <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
                <span class="brand">DISP<span class="brand-o">O</span>L</span></a>

            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="nav-links" id="navMenu">
                <li><a href="dashboard-staf.php">Beranda</a></li>
                <li><a href="kelola-staf.php" class="active">Kelola</a></li>
                <li><a href="arsip-staf.php">Arsip</a></li>
                <li><a href="profil-staf.php">Profil</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="title-bar">
            <h1><b>EDIT SURAT PERINGATAN</b></h1>
        </div>

        <section class="form-container">
            <h2>Ubah Data Surat Peringatan</h2>

            <form action="backend/update_surat.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $data['id'] ?>">

                <div class="form-grid">

                    <div>
                        <label>Tingkat Peringatan</label>
                        <select name="tingkat" required>
                            <option value="SP I" <?= $data['tingkat'] == 'SP I' ? 'selected' : '' ?>>SP I</option>
                            <option value="SP II" <?= $data['tingkat'] == 'SP II' ? 'selected' : '' ?>>SP II</option>
                            <option value="SP III" <?= $data['tingkat'] == 'SP III' ? 'selected' : '' ?>>SP III</option>
                        </select>
                    </div>

                    <div>
                        <label>Tanggal Dikeluarkan</label>
                        <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required>
                    </div>

                    <div>
                        <label>Sampai Dengan Tanggal</label>
                        <input type="date" name="sampai" value="<?= $data['sampai'] ?>" required>
                    </div>

                </div>

                <div class="form-grid">

                    <div>
                        <label>Nama</label>
                        <input type="text" name="nama" value="<?= $data['nama'] ?>" required>
                    </div>

                    <div>
                        <label>NIM</label>
                        <input type="text" name="nim" value="<?= $data['nim'] ?>" required>
                    </div>

                    <div>
                        <label>Jurusan</label>
                        <select name="jurusan" id="jurusanInput" required>
                            <option value="Teknik Informatika"
                                <?= $data['jurusan'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika
                            </option>
                        </select>
                    </div>

                    <div>
                        <label>Prodi</label>
                        <select name="prodi" id="prodiInput" required>
                            <option value="Teknik Informatika"
                                <?= $data['prodi'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika
                            </option>
                            <option value="Teknologi Rekayasa Perangkat Lunak"
                                <?= $data['prodi'] == 'Teknologi Rekayasa Perangkat Lunak' ? 'selected' : '' ?>>
                                Teknologi Rekayasa Perangkat Lunak</option>
                            <option value="Teknologi Geomatika"
                                <?= $data['prodi'] == 'Teknologi Geomatika' ? 'selected' : '' ?>>Teknologi Geomatika
                            </option>
                            <option value="Rekayasa Keamanan Siber"
                                <?= $data['prodi'] == 'Rekayasa Keamanan Siber' ? 'selected' : '' ?>>Rekayasa Keamanan
                                Siber</option>
                            <option value="Teknologi Rekayasa Multimedia"
                                <?= $data['prodi'] == 'Teknologi Rekayasa Multimedia' ? 'selected' : '' ?>>Teknologi
                                Rekayasa Multimedia</option>
                            <option value="Animasi" <?= $data['prodi'] == 'Animasi' ? 'selected' : '' ?>>Animasi
                            </option>
                            <option value="Teknologi Permainan"
                                <?= $data['prodi'] == 'Teknologi Permainan' ? 'selected' : '' ?>>Teknologi Permainan
                            </option>
                        </select>
                    </div>

                    <div>
                        <label>Kelas</label>
                        <select name="kelas" required>
                            <option value="A" <?= $data['kelas'] == 'A' ? 'selected' : '' ?>>A</option>
                            <option value="B" <?= $data['kelas'] == 'B' ? 'selected' : '' ?>>B</option>
                            <option value="C" <?= $data['kelas'] == 'C' ? 'selected' : '' ?>>C</option>
                            <option value="D" <?= $data['kelas'] == 'D' ? 'selected' : '' ?>>D</option>
                            <option value="E" <?= $data['kelas'] == 'E' ? 'selected' : '' ?>>E</option>
                        </select>
                    </div>

                    <div>
                        <label>Semester</label>
                        <select name="semester" required>
                            <option value="">Pilih Semester</option>
                            <option value="1" <?= $data['semester'] == '1' ? 'selected' : '' ?>>Semester 1</option>
                            <option value="2" <?= $data['semester'] == '2' ? 'selected' : '' ?>>Semester 2</option>
                            <option value="3" <?= $data['semester'] == '3' ? 'selected' : '' ?>>Semester 3</option>
                            <option value="4" <?= $data['semester'] == '4' ? 'selected' : '' ?>>Semester 4</option>
                            <option value="5" <?= $data['semester'] == '5' ? 'selected' : '' ?>>Semester 5</option>
                            <option value="6" <?= $data['semester'] == '6' ? 'selected' : '' ?>>Semester 6</option>
                            <option value="7" <?= $data['semester'] == '7' ? 'selected' : '' ?>>Semester 7</option>
                            <option value="8" <?= $data['semester'] == '8' ? 'selected' : '' ?>>Semester 8</option>
                        </select>
                    </div>

                    <div>
                        <label>Sesi Kelas</label>
                        <select name="sesi_kelas" required>
                            <option value="">Pilih Sesi Kelas</option>
                            <option value="Pagi" <?= $data['sesi_kelas'] == 'Pagi' ? 'selected' : '' ?>>Pagi</option>
                            <option value="Malam" <?= $data['sesi_kelas'] == 'Malam' ? 'selected' : '' ?>>Malam</option>
                        </select>
                    </div>

                    <div>
                        <label>Status Surat</label>
                        <select name="status" required>
                            <option value="Aktif" <?= $data['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="Selesai" <?= $data['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai
                            </option>
                        </select>
                    </div>

                </div>

                <div>
                    <label>Perihal</label>
                    <input type="text" name="perihal" value="<?= $data['perihal'] ?>">
                </div>

                <div>
                    <label>Deskripsi Peringatan</label>
                    <input type="text" name="deskripsi" value="<?= $data['deskripsi'] ?>">
                </div>

                <div class="form-grid">
                    <div>
                        <label>Unggah File Surat (opsional)</label>
                        <input type="file" name="file">
                        <small>File saat ini: <?= $data['file'] ?></small>
                    </div>
                </div>

                <div class="form-buttons">
                    <button type="button" class="btn-batal"
                        onclick="window.location.href='kelola-staf.php'">Batal</button>
                    <button type="submit" class="btn-kirim">Simpan</button>
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

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        once: true,
        duration: 1000
    });
    </script>
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
            menuToggle.classList.add('active');
            overlay.style.opacity = '1';
            overlay.style.visibility = 'visible';
            body.style.overflow = 'hidden';
            menuToggle.setAttribute('aria-expanded', 'true');
        }

        function closeMenu() {
            navMenu.classList.remove('show');
            menuToggle.classList.remove('active');
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