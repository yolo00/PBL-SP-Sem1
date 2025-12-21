<?php
session_start();
include "config.php";

$pass = $_POST['password'];
$conf = $_POST['password_confirm'];
$token = $_SESSION['reset_token'];
$email = $_SESSION['reset_email'];

// Validasi
if ($pass !== $conf) {
    echo "<script>alert('Konfirmasi password tidak cocok!'); window.location='../reset-password.php';</script>";
    exit;
}

if (strlen($pass) < 6) {
    echo "<script>alert('Password minimal 6 karakter!'); window.location='../reset-password.php';</script>";
    exit;
}

// Update Password
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

$update = mysqli_query($conn, "UPDATE users SET password = '$hashed_password' WHERE email = '$email'");

if ($update) {
    // Tandai token sudah dipakai
    mysqli_query($conn, "UPDATE password_resets SET used = 1 WHERE token = '$token'");
    
    // Hapus sesi reset
    unset($_SESSION['reset_token']);
    unset($_SESSION['reset_email']);

    echo "<script>alert('Password berhasil diubah! Silakan login dengan password baru.'); window.location='../login.php';</script>";
} else {
    echo "<script>alert('Gagal mengubah password. Coba lagi.'); window.location='../reset-password.php';</script>";
}
?>
