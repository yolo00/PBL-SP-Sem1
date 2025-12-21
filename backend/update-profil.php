<?php
session_start();
include "config.php";

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_SESSION['user_id'];
$email = mysqli_real_escape_string($conn, $_POST['email']);
$telepon = mysqli_real_escape_string($conn, $_POST['telepon']);

// Validasi sederhana
if (empty($email) || empty($telepon)) {
    echo "<script>alert('Email dan Nomor Telepon tidak boleh kosong!'); window.history.back();</script>";
    exit;
}

// ============================================
// VALIDASI DUPLIKASI DATA (Cek User Lain)
// ============================================
$check_query = "SELECT id, email, telepon FROM users 
                WHERE (email = '$email' OR telepon = '$telepon') 
                AND id != '$id'";
$check = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check) > 0) {
    $existing = mysqli_fetch_assoc($check);
    if ($existing['email'] == $email) {
        $errorMsg = "Email ini sudah digunakan oleh akun lain!";
    } else {
        $errorMsg = "Nomor Telepon ini sudah digunakan oleh akun lain!";
    }
    
    echo "<script>
            alert('$errorMsg');
            window.history.back();
          </script>";
    exit;
}

// Update Database
$query = "UPDATE users SET email = '$email', telepon = '$telepon' WHERE id = '$id'";
$update = mysqli_query($conn, $query);

if ($update) {
    // Update Session Data agar langsung berubah tanpa logout
    $_SESSION['email'] = $email;
    $_SESSION['telepon'] = $telepon;

    echo "<script>
            alert('Data profil berhasil diperbarui!');
            window.location='" . $_SERVER['HTTP_REFERER'] . "';
          </script>";
} else {
    echo "<script>
            alert('Gagal memperbarui data: " . mysqli_error($conn) . "');
            window.history.back();
          </script>";
}
?>
