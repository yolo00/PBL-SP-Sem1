<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Username tidak ditemukan!'); window.location='../login.php';</script>";
    exit;
}

// Cek role yang dipilih user saat login
$chosenRole = $_POST['role'] ?? null;

if ($chosenRole !== $data['role']) {
    echo "<script>alert('Role tidak sesuai dengan akun!'); window.location='../login.php';</script>";
    exit;
}

if (!password_verify($password, $data['password'])) {
    echo "<script>alert('Password salah!'); window.location='../login.php';</script>";
    exit;
}

// Simpan data lengkap ke session
$_SESSION['user_id']  = $data['id'];
$_SESSION['username'] = $data['username'];
$_SESSION['nama']     = $data['nama'];
$_SESSION['role']     = $data['role'];
$_SESSION['jenis_kelamin'] = $data['jenis_kelamin'];
$_SESSION['email']    = $data['email'];
$_SESSION['telepon']  = $data['telepon'];
$_SESSION['jurusan']  = $data['jurusan'];
$_SESSION['prodi']    = $data['prodi'];
$_SESSION['kelas']    = $data['kelas'];
$_SESSION['angkatan'] = $data['angkatan'];
$_SESSION['nim']      = $data['nim'];
$_SESSION['nik']      = $data['nik'];
$_SESSION['jabatan']  = $data['jabatan'];



// Cek Remember Me
// Cek Remember Me
if (isset($_POST['remember'])) {
    // 1. Generate Secure Token
    $token = bin2hex(random_bytes(32)); // 64 karakter hex
    $expiry = date('Y-m-d H:i:s', time() + (86400 * 30)); // 30 hari

    // 2. Simpan token ke database user
    $uid = $data['id'];
    $updateToken = mysqli_query($conn, "UPDATE users SET remember_token='$token', token_expiry='$expiry' WHERE id='$uid'");

    if ($updateToken) {
        // 3. Set Cookie di browser (HttpOnly agar aman dari XSS)
        // Format cookie: user_id:token
        $cookieValue = $data['id'] . ':' . $token;
        setcookie('remember_me', $cookieValue, time() + (86400 * 30), "/", "", false, true);
    }
}


// Arahkan ke dashboard
if ($data['role'] == 'staf') {
    header("Location: ../dashboard-staf.php");
} else if ($data['role'] == 'mahasiswa') {
    header("Location: ../dashboard-mahasiswa.php");
} else {
    echo "<script>alert('Role tidak dikenal!'); window.location='../login.php';</script>";
}
?>
