<?php
session_start();
include "backend/config.php";

// Cek apakah user sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}

// Proses update profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $prodi_mahasiswa = mysqli_real_escape_string($conn, $_POST['prodi_mahasiswa']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $angkatan = mysqli_real_escape_string($conn, $_POST['angkatan']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);

    $update_query = "UPDATE users SET nama='$nama', prodi_mahasiswa='$prodi_mahasiswa', jurusan='$jurusan', kelas='$kelas', angkatan='$angkatan', email='$email', telepon='$telepon' WHERE id='{$_SESSION['user_id']}'";
    if (mysqli_query($conn, $update_query)) {
        // Update session
        $_SESSION['nama'] = $nama;
        $_SESSION['prodi_mahasiswa'] = $prodi_mahasiswa;
        $_SESSION['jurusan'] = $jurusan;
        $_SESSION['kelas'] = $kelas;
        $_SESSION['angkatan'] = $angkatan;
        $_SESSION['email'] = $email;
        $_SESSION['telepon'] = $telepon;
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='profil-mahasiswa.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui profil!');</script>";
    }
}
?>
<!--Muhammad Ivan Febrian-->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profil Mahasiswa</title>
  <link rel="stylesheet" href="css/profil-mahasiswa.css" />
  <link rel="icon" type="image/png" href="image/dispol.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <!-- Navbar -->
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
    <a href="dashboard-mahasiswa.php" class="menu-item">Beranda</a>
    <a href="profil-mahasiswa.php" class="menu-item active">Profil</a>
  </nav>
</aside>

<main class="profil-container-mahasiswa">
    <div class="header-section">
        <h1><b>EDIT PROFIL MAHASISWA</b></h1>
        <p class="subtitle">Perbarui Data Akademik & Informasi Pribadi</p>
    </div>

    <div class="profile-content-wrapper">
        <section class="profil-identitas-card">
            <div class="card-header-mahasiswa">
                <div class="photo-placeholder">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="profil-info-header">
                    <input type="text" name="nama" value="<?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : ''; ?>" required placeholder="Nama Mahasiswa">
                    <p class="nim-label">NIM: <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '3312501048'; ?></p>
                </div>
            </div>

            <form method="POST" action="">
                <div class="profil-info-details">
                    <h3>Data Pribadi & Kontak</h3>
                    <div class="detail-group">
                        <div class="detail-item">
                            <span class="label">Prodi</span>
                            <input type="text" name="prodi_mahasiswa" value="<?php echo isset($_SESSION['prodi_mahasiswa']) ? htmlspecialchars($_SESSION['prodi_mahasiswa']) : ''; ?>" required>
                        </div>
                        <div class="detail-item">
                            <span class="label">Jurusan</span>
                            <input type="text" name="jurusan" value="<?php echo isset($_SESSION['jurusan']) ? htmlspecialchars($_SESSION['jurusan']) : ''; ?>" required>
                        </div>
                        <div class="detail-item">
                            <span class="label">Kelas</span>
                            <input type="text" name="kelas" value="<?php echo isset($_SESSION['kelas']) ? htmlspecialchars($_SESSION['kelas']) : ''; ?>" required>
                        </div>
                        <div class="detail-item">
                            <span class="label">Angkatan</span>
                            <input type="text" name="angkatan" value="<?php echo isset($_SESSION['angkatan']) ? htmlspecialchars($_SESSION['angkatan']) : ''; ?>" required>
                        </div>
                        <div class="detail-item">
                            <span class="label">Email</span>
                            <input type="email" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>
                        </div>
                        <div class="detail-item">
                            <span class="label">No. HP</span>
                            <input type="tel" name="telepon" value="<?php echo isset($_SESSION['telepon']) ? htmlspecialchars($_SESSION['telepon']) : ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="aksi-logout-area">
                    <button type="submit" class="btn-logout">Simpan Perubahan</button>
                    <a href="profil-mahasiswa.php"><button type="button" class="btn-logout">Batal</button></a>
                </div>
            </form>
        </section>
    </div>
</main>
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
              <li><a href="profil-mahasiswa.php">Kelola</a></li>
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
  <script src="js/profil-mahasiswa.js"></script>
</body>
</html>
