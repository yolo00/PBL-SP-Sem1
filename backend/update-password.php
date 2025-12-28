<?php
session_start();
include "config.php";

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Validasi request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$old_password = $_POST['old_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Tentukan halaman redirect berdasarkan role
$redirect_page = ($role == 'staf') ? '../profil-staf.php' : '../profil-mahasiswa.php';

// Validasi input
if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
    echo "<script>alert('Semua field harus diisi!'); window.location='$redirect_page';</script>";
    exit;
}

if ($new_password !== $confirm_password) {
    echo "<script>alert('Konfirmasi kata sandi baru tidak cocok!'); window.location='$redirect_page';</script>";
    exit;
}

if (strlen($new_password) < 6) {
    echo "<script>alert('Kata sandi baru minimal 6 karakter!'); window.location='$redirect_page';</script>";
    exit;
}

// Ambil password lama dari database
$query = mysqli_query($conn, "SELECT password FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($query);

if (!$user) {
    echo "<script>alert('User tidak ditemukan!'); window.location='$redirect_page';</script>";
    exit;
}

// Verifikasi password lama
// Cek apakah password di-hash dengan password_hash() atau MD5
$stored_password = $user['password'];
$password_verified = false;

// Coba verifikasi dengan password_verify (bcrypt)
if (password_verify($old_password, $stored_password)) {
    $password_verified = true;
}
// Jika tidak, coba dengan MD5 (untuk kompatibilitas dengan sistem lama)
elseif (md5($old_password) === $stored_password) {
    $password_verified = true;
}
// Atau plaintext (tidak direkomendasikan, hanya untuk development)
elseif ($old_password === $stored_password) {
    $password_verified = true;
}

if (!$password_verified) {
    echo "<script>alert('Kata sandi lama salah!'); window.location='$redirect_page';</script>";
    exit;
}

// Hash password baru dengan bcrypt
$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

// Update password di database
$update_query = "UPDATE users SET password = '$hashed_password' WHERE id = '$user_id'";
$result = mysqli_query($conn, $update_query);

if ($result) {
    // Hapus semua session
    $_SESSION = array();
    
    // Hapus session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Hapus cookies yang tersimpan
    setcookie('user_id', '', time() - 3600, '/');
    setcookie('role', '', time() - 3600, '/');
    setcookie('nama', '', time() - 3600, '/');
    setcookie('nim', '', time() - 3600, '/');
    setcookie('nik', '', time() - 3600, '/');
    setcookie('prodi', '', time() - 3600, '/');
    setcookie('kelas', '', time() - 3600, '/');
    setcookie('angkatan', '', time() - 3600, '/');
    setcookie('jenis_kelamin', '', time() - 3600, '/');
    setcookie('remember_token', '', time() - 3600, '/');
    
    // Destroy session
    session_destroy();
    
    // Redirect ke halaman login dengan pesan sukses
    echo "<script>alert('Kata sandi berhasil diubah! Silakan login kembali dengan kata sandi baru.'); window.location='../login.php';</script>";
} else {
    echo "<script>alert('Gagal mengubah kata sandi. Silakan coba lagi.'); window.location='$redirect_page';</script>";
}
?>
