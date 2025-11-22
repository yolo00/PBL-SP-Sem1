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
$_SESSION['email']    = $data['email'];
$_SESSION['telepon']  = $data['telepon'];
$_SESSION['jurusan']  = $data['jurusan'];
$_SESSION['prodi']    = $data['prodi'];
$_SESSION['kelas']    = $data['kelas'];
$_SESSION['angkatan'] = $data['angkatan'];
$_SESSION['nik']      = $data['nik'];
$_SESSION['jabatan']  = $data['jabatan'];

// Arahkan ke dashboard
if ($data['role'] == 'staf') {
    header("Location: ../dashboard-staf.php");
} else if ($data['role'] == 'mahasiswa') {
    header("Location: ../dashboard-mahasiswa.php");
} else {
    echo "<script>alert('Role tidak dikenal!'); window.location='../login.php';</script>";
}
?>
