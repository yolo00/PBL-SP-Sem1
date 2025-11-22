<?php
include "config.php";

$id = $_GET['id'];

// Update kolom status menjadi Arsip
mysqli_query($conn, 
"UPDATE surat_peringatan SET status='Arsip' WHERE id='$id'");

echo "<script>alert('Surat berhasil diarsipkan!'); window.location='../kelola-staf.php';</script>";
?>
