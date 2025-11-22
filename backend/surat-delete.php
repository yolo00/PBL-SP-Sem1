<?php
include "config.php";

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID surat tidak ditemukan!');
            window.location='../kelola-staf.php';
          </script>";
    exit;
}

$id = $_GET['id'];

// Ambil data dulu untuk cek apakah ada file surat
$q = mysqli_query($conn, "SELECT file FROM surat_peringatan WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

// Hapus file jika ada
if (!empty($data['file']) && file_exists("../uploads/" . $data['file'])) {
    unlink("../uploads/" . $data['file']);
}

// Hapus data dari database
mysqli_query($conn, "DELETE FROM surat_peringatan WHERE id='$id'");

echo "<script>
        alert('Surat berhasil dihapus');
        window.location='../kelola-staf.php';
      </script>";
?>
