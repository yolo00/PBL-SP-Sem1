<!-- dibuat oleh: Nur Iliyanie -->
<?php
include "backend/config.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM surat_peringatan WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit Surat</title>
  <<<<<<< HEAD
    <link rel="stylesheet" href="css/tambah-surat.css">
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link rel="stylesheet" href="css/edit_surat.css">
    >>>>>>> 89ce14c3b7cdde4d404c364999c975e01cb901aa
</head>

<body>

  <nav class="navbar">
    <div class="container">
      <a class="logo">
        <img src="image/dispol.png" width="65" height="65" alt="dispol logo">
        <span class="brand">DISP<span class="brand-o">O</span>L</span></a>
      <ul class="nav-links">
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
              <option value="Teknik Informatika" <?= $data['jurusan'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
            </select>
          </div>

          <div>
            <label>Prodi</label>
            <select name="prodi" id="prodiInput" required>
              <option value="Teknik Informatika" <?= $data['prodi'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
              <option value="Teknologi Rekayasa Perangkat Lunak" <?= $data['prodi'] == 'Teknologi Rekayasa Perangkat Lunak' ? 'selected' : '' ?>>Teknologi Rekayasa Perangkat Lunak</option>
              <option value="Teknologi Geomatika" <?= $data['prodi'] == 'Teknologi Geomatika' ? 'selected' : '' ?>>Teknologi Geomatika</option>
              <option value="Rekayasa Keamanan Siber" <?= $data['prodi'] == 'Rekayasa Keamanan Siber' ? 'selected' : '' ?>>Rekayasa Keamanan Siber</option>
              <option value="Teknologi Rekayasa Multimedia" <?= $data['prodi'] == 'Teknologi Rekayasa Multimedia' ? 'selected' : '' ?>>Teknologi Rekayasa Multimedia</option>
              <option value="Animasi" <?= $data['prodi'] == 'Animasi' ? 'selected' : '' ?>>Animasi</option>
              <option value="Teknologi Permainan" <?= $data['prodi'] == 'Teknologi Permainan' ? 'selected' : '' ?>>Teknologi Permainan</option>
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
              <option value="Pagi" <?= $data['sesi_kelas'] == 'Pagi' ? 'selected' : '' ?>>Pagi</option>
              <option value="Malam" <?= $data['sesi_kelas'] == 'Malam' ? 'selected' : '' ?>>Malam</option>
            </select>
          </div>

          <div>
            <label>Status Surat</label>
            <select name="status" required>
              <option value="Aktif" <?= $data['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
              <option value="Selesai" <?= $data['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
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
          <button type="button" class="btn-batal" onclick="window.location.href='kelola-staf.php'">Batal</button>
          <button type="submit" class="btn-kirim">Simpan</button>
        </div>

      </form>
    </section>
  </main>

</body>

</html>