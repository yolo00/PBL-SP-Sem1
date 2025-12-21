<?php
session_start();
// Aktifkan error reporting untuk debugging jika terjadi white screen
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config.php";

$email = mysqli_real_escape_string($conn, $_POST['email']);

// 1. Cek Email Terdaftar
$check = mysqli_query($conn, "SELECT id, nama FROM users WHERE email = '$email'");
if (mysqli_num_rows($check) == 0) {
    echo "<script>alert('Email tidak terdaftar!'); window.location='../lupa-password.php';</script>";
    exit;
}

$userData = mysqli_fetch_assoc($check);
$userId = $userData['id'];

// 2. Generate OTP & Token
$otp = rand(100000, 999999);
$token = bin2hex(random_bytes(32)); // Token unik untuk keamanan tambahan
$expires = date('Y-m-d H:i:s', time() + (60 * 15)); // Berlaku 15 menit

// 3. Simpan ke Password Resets
// Hapus request lama yang belum dipakai agar bersih (opsional, tapi baik)
mysqli_query($conn, "DELETE FROM password_resets WHERE email = '$email' AND used = 0");

$insert = mysqli_query($conn, "INSERT INTO password_resets (user_id, email, token, otp_code, expires_at) VALUES ('$userId', '$email', '$token', '$otp', '$expires')");

if ($insert) {
    // 4. Simulasi Kirim Email (Tampilkan di Alert untuk Demo)
    $_SESSION['reset_email'] = $email;
    
// Pesan simulasi (Gunakan \\n agar di JavaScript terbaca sebagai satu baris dengan escape char)
    $pesan = "DEMO MODE: Kode OTP Anda adalah " . $otp . ".\\nSilakan masukkan kode ini di halaman selanjutnya.";
    
    echo "<script>
            alert('$pesan');
            window.location='../input-otp.php';
          </script>";
} else {
    echo "<script>alert('Terjadi kesalahan sistem.'); window.location='../lupa-password.php';</script>";
}
?>
