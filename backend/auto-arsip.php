<?php
include "config.php";

// Update status otomatis
mysqli_query($conn, "
    UPDATE surat_peringatan 
    SET status='selesai' 
    WHERE sampai < CURDATE() AND status='aktif'
");
?>
