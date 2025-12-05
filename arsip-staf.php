<!--Nama file: arsip-staf.php-->
<!--Dibuat oleh: Muhammad Faturrahman-->

<?php
include "backend/config.php";

$query = mysqli_query($conn, "
  SELECT * FROM surat_peringatan
  WHERE status='selesai'
  ORDER BY id DESC
");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arsip Surat Peringatan</title>
    <link rel="stylesheet" href="css/arsip-staf.css" />
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
  </head>

  <body>
    <nav class="navbar">
      <div class="container">
        <a class="logo">
          <img src="image/dispol.png" width="65" height="65" alt="dispol logo"/>
          <span class="brand">DISP<span class="brand-o">O</span>L</span>
        </a>
        <ul class="nav-links">
          <li><a href="dashboard-staf.php">Beranda</a></li>
          <li><a href="kelola-staf.php">Kelola</a></li>
          <li><a href="arsip-staf.php" class="active">Arsip</a></li>
          <li><a href="profil-staf.php">Profil</a></li>
        </ul>
      </div>
    </nav>

    <h1><b>ARSIP SURAT PERINGATAN</b></h1>

    <div class="page-container">
      <main class="content-wrap">
        <table id="arsipTable">
          <thead>
            <tr>
              <th>Nama</th>
              <th>NIM</th>
              <th>Prodi</th>
              <th>Tingkat</th>
              <th>Tanggal</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            <?php if (mysqli_num_rows($query) == 0): ?>
                <tr>
                    <td colspan="6" style="text-align:center;color:gray;">Belum ada arsip</td>
                </tr>
            <?php else: ?>
                <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <tr onclick="window.location='detail_arsip.php?id=<?= $row['id'] ?>'" class="clickable-row">
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['prodi'] ?></td>
                        <td><?= $row['tingkat'] ?></td>
                        <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php endwhile ?>
            <?php endif ?>
          </tbody>

        </table>
      </main>

      <footer class="footer">
        <div class="footer-container">
          <div class="footer-left">
            <img src="image/dispol.png" alt="Logo Dispol" width="60" />
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
            <p>Politeknik Negeri Batam<br/>Jl. Ahmad Yani, Batam Center</p>
            <ul class="social-links">
              <li><a href="#"><img src="image/icon-facebook.png" alt="Facebook"/></a></li>
              <li><a href="#"><img src="image/icon-twitter.png" alt="Twitter"/></a></li>
              <li><a href="#"><img src="image/icon-instagram.png" alt="Instagram"/></a></li>
            </ul>
          </div>

        </div>

        <div class="footer-bottom">
          <p>&copy; 2025 DISPOL | All Rights Reserved</p>
        </div>
      </footer>
    </div>

    <script src="js/arsip-staf.js"></script>
  </body>
</html>
