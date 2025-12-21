<?php
session_start();
include "config.php";

$otp = mysqli_real_escape_string($conn, $_POST['otp']);
$email = $_SESSION['reset_email'];

// 1. Cek Validitas OTP
$now = date('Y-m-d H:i:s');
$check = mysqli_query($conn, "SELECT * FROM password_resets WHERE email = '$email' AND otp_code = '$otp' AND used = 0 AND expires_at > '$now'");

if (mysqli_num_rows($check) > 0) {
    $data = mysqli_fetch_assoc($check);
    
    // Simpan token reset di session untuk izin akses halaman ganti password
    $_SESSION['reset_token'] = $data['token'];
    
    // Redirect ke halaman password baru
    header("Location: ../reset-password.php");
} else {
    echo "<script>alert('Kode OTP salah atau sudah kadaluarsa!'); window.location='../input-otp.php';</script>";
}
?>
