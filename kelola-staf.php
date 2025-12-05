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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola</title>
  <link rel="stylesheet" href="css/kelola-staff.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="image/dispol.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
  <nav class="navbar">
    <div class="container">
      <a class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
        <span class="brand">DISP<span class="brand-o">O</span>L</span>
      </a>
      <ul class="nav-links">
        <li><a href="dashboard-staf.php">Beranda</a></li>
        <li><a href="kelola-staf.php" class="active">Kelola</li>
        <li><a href="arsip-staf.php">Arsip</li>
        <li><a href="profil-staf.php">Profil</a></li>
      </ul>
    </div>
  </nav>
  <div class="page-container">
    <main class="content-wrap">
      <div class="judul-kembali">
        <a href="dashboard-staf.php"></a>
        <h1><b>KELOLA SURAT PERINGATAN</b></h1>
      </div>
      <section class="table-container">

        <div class="filter-bar">
          <div class="search-wrapper">
            <span class="search-icon">🔍</span>
            <input type="text" placeholder="Cari" class="search-input" id="filterSearch">
          </div>

          <select id="filterTingkat">
            <option value="">Semua tingkat peringatan</option>
            <option value="sp i">SP I</option>
            <option value="sp ii">SP II</option>
            <option value="sp iii">SP III</option>
          </select>

          <select id="filterStatus">
            <option value="">Status</option>
            <option value="aktif">Aktif</option>
            <option value="selesai">Selesai</option>
          </select>

          <button class="btn-tambah" onclick="window.location.href='tambah-surat.php'">Tambah</button>
        </div>


        <!-- TABEL TUNGGAL (Header sticky + scroll body) -->
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
                <?php while($row = mysqli_fetch_assoc($query)): ?>
                <tr
                    data-nama="<?= strtolower($row['nama']) ?>"
                    data-nim="<?= strtolower($row['nim']) ?>"
                    data-prodi="<?= strtolower($row['prodi']) ?>"
                    data-tingkat="<?= strtolower($row['tingkat']) ?>"
                    data-status="<?= strtolower($row['status']) ?>"
                >
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['nim'] ?></td>
                    <td><?= $row['prodi'] ?></td>
                    <td><?= $row['tingkat'] ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <a href="edit_surat.php?id=<?= $row['id'] ?>">✏️</a>
                        <a href="backend/arsip-manual.php?id=<?= $row['id'] ?>">📁</a>
                        <a href="backend/surat-delete.php?id=<?= $row['id'] ?>">🗑️</a>
                    </td>
                </tr>
              <?php endwhile ?>
            </tbody>
          </table>
        </div>

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
  </div>
  <script src="js/filter.js"></script>
</body>

</html>