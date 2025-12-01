<!-- dibuat oleh: Nur Iliyanie -->
<?php
session_start();
include "backend/config.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('Surat tidak ditemukan'); window.location='dashboard-staf.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM surat_peringatan WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan'); window.location='dashboard-staf.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Surat Peringatan | DISPOL</title>
  <link rel="stylesheet" href="css/detail-surat.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="container">
      <a class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
        <span class="brand">DISP<span class="brand-o">O</span>L</span>
      </a>
      <ul class="nav-links">
        <li><a href="dashboard-staf.php">Beranda</a></li>
        <li><a href="kelola-staf.php">Kelola</a></li>
        <li><a href="arsip-staf.php">Arsip</a></li>
        <li><a href="profil-staf.php">Profil</a></li>
      </ul>
    </div>
  </nav>

  <div class="detail-container" data-aos="fade-up">
    <div class="detail-header">
      <h2 id="namaMahasiswaHeader"><?= $data['nama'] ?></h2>
      <p>Mahasiswa Politeknik Negeri Batam</p>
    </div>
 
    <div class="rincian-surat">
      <h3>Rincian Surat Peringatan</h3>
      <div class="preview-container">

        <!-- DATA MAHASISWA -->
        <div class="preview-section">
          <h4>Data Mahasiswa</h4>

          <div class="preview-item"><label>Nama:</label> <span><?= $data['nama'] ?></span></div>
          <div class="preview-item"><label>NIM:</label> <span><?= $data['nim'] ?></span></div>
          <div class="preview-item"><label>Program Studi:</label> <span><?= $data['prodi'] ?></span></div>
          <div class="preview-item"><label>Jurusan:</label> <span><?= $data['jurusan'] ?></span></div>
          <div class="preview-item"><label>Kelas:</label> <span><?= $data['kelas'] ?></span></div>
          <div class="preview-item"><label>Semester:</label> <span>Semester <?= $data['semester'] ?></span></div>
          <div class="preview-item"><label>Sesi Kelas:</label> <span><?= $data['sesi_kelas'] ?></span></div>
          <div class="preview-item"><label>Status:</label> 
            <span><?= $data['status'] ?? 'Aktif' ?></span></div>
        </div>

        <!-- DATA SURAT -->
        <div class="preview-section">
          <h4>Data Surat Peringatan</h4>

          <div class="preview-item"><label>Tingkat SP:</label> <span><?= $data['tingkat'] ?></span></div>
          <div class="preview-item"><label>Tanggal Surat:</label> <span><?= $data['tanggal'] ?></span></div>
          <div class="preview-item"><label>Perihal:</label> <span><?= $data['perihal'] ?></span></div>
          <div class="preview-item"><label>Deskripsi:</label> <span><?= $data['deskripsi'] ?></span></div>
          <div class="preview-item">
            <label>File Surat:</label>
            <?php if ($data['file']): ?>
              <a href="uploads/<?= $data['file'] ?>" target="_blank">Lihat File</a>
            <?php else: ?>
              <span>-</span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div> 
    
    <!-- Tombol -->
    <div class="form-buttons">
      <button type="button" class="btn btn-batal" onclick="window.history.back()">Kembali</button>
      <a href="edit_surat.php?id=<?= $data['id'] ?>" class="btn btn-edit">Edit</a>
    </div>

  </div>

  <footer class="footer">
    <!-- Footer tetap sama -->
  </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ once:true, duration:1000 });
  </script>
</body>
</html>
