<?php
include "config.php";

// Ambil data POST
$nama      = $_POST['nama'];
$nim       = $_POST['nim'];
$jurusan   = $_POST['jurusan'];
$prodi     = $_POST['prodi'];
$kelas     = $_POST['kelas'];
$tingkat   = $_POST['tingkat'];
$tanggal   = $_POST['tanggal'];
$sampai    = $_POST['sampai'];
$perihal   = $_POST['perihal'];
$deskripsi = $_POST['deskripsi'];

// Upload file jika ada
$fileName = null;
if (!empty($_FILES['file']['name'])) {
    $fileName = time() . "_" . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/" . $fileName);
}

// Simpan ke database
$query = mysqli_query($conn,
"INSERT INTO surat_peringatan
(nama, nim, jurusan, prodi, kelas, tingkat, tanggal, sampai, perihal, deskripsi, file)
VALUES
('$nama', '$nim', '$jurusan', '$prodi', '$kelas', '$tingkat', '$tanggal', '$sampai', '$perihal', '$deskripsi', '$fileName')
");

echo "<script>alert('Surat berhasil ditambahkan!'); window.location='../kelola-staf.php';</script>";
?>