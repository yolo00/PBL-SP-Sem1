<!--Nama file: dashboard-staf.html-->
<!--Dibuat oleh: Muhammad Faturrahman-->

<?php
session_start();
include "backend/config.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staf') {
    header("Location: login.php");
    exit;
}

// Ambil data user yang sedang login
$data = $_SESSION;


// Ambil semua surat peringatan
$querySurat = mysqli_query($conn, "
    SELECT * FROM surat_peringatan
    WHERE status='aktif'
    ORDER BY id DESC
");

?>

<?php
include "backend/auto-arsip.php";
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Staf</title>
    <link rel="stylesheet" href="css/dashboard-staf.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
                <li><a href="dashboard-staf.php" class="active"><p>Beranda</p></a></li>
                <li><a href="kelola-staf.php">Kelola</li>
                <li><a href="arsip-staf.php">Arsip</li>
                <li><a href="profil-staf.php">Profil</a></li>
            </ul>
        </div>
    </nav>
    <section id="home" class="hero">
        <div data-aos="fade-up">
            <h1>Selamat Datang di Layanan Surat Peringatan Mahasiswa Polibatam</h1>
        </div>
    </section>

    <div class="welcome">
  <h1>
    Halo, Selamat datang 
    <span><?= $data['nama'] ?></span> 👋
  </h1>

  <h2><?= $data['username'] ?></h2>
</div>

    <div class="new">
      <h1>Lihat Surat Peringatan</h1>
      <p id="noSuratMsg" class="no-surat-msg" style="display:none;">Tidak ada surat peringatan terbaru</p>
    </div>
    <div class="card-container">
      <?php
        if (mysqli_num_rows($querySurat) == 0) {
          echo "<p style='text-align:center;color:gray;'>Belum ada surat peringatan</p>";
        } else {
        while ($row = mysqli_fetch_assoc($querySurat)) {

        // Tentukan warna label SP
        $labelClass = "sp1";
        if ($row['tingkat'] == "SP II") $labelClass = "sp2";
        if ($row['tingkat'] == "SP III") $labelClass = "sp3";
      ?>
    
      <div class="card" data-aos="fade-up">
        <div class="sp-label <?= $labelClass ?>"><?= $row['tingkat'] ?></div>
        <div class="photo"></div>

        <p>
            <strong><?= $row['nama'] ?></strong><br>
            <?= $row['nim'] ?><br>
            <?= $row['prodi'] ?><br>
            <?= $row['tanggal'] ?><br>
            <?= $row['status'] ?? 'Aktif' ?>
        </p>

        <a href="detail-surat.php?id=<?= $row['id'] ?>" class="detail">
            Rincian
        </a>
      </div>

      <?php
          }
      }
      ?>
    </div>

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
        <li><a href="dashboard-staf.html">Beranda</a></li>
        <li><a href="kelola-staf.html">Kelola</a></li>
        <li><a href="arsip-staf.html">Arsip</a></li>
        <li><a href="profil-staf.html">Profil</a></li>
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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    once:true,
    duration:1000,
  });
</script>
</body>

</html>