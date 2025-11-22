<?php
$host = "localhost";     // Nama host
$user = "root";          // Username phpMyAdmin
$pass = "";              // Password phpMyAdmin
$db   = "dispol";     // Nama database yang sudah kamu buat

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
