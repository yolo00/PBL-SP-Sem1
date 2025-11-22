<?php
include "config.php";

$id = $_GET['id'];

// Update status menjadi selesai
mysqli_query($conn, "
    UPDATE surat_peringatan 
    SET status='selesai'
    WHERE id='$id'
");

echo "<script>
alert('Surat berhasil diarsipkan!');
window.location='../kelola-staf.php';
</script>";
?>
