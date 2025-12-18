<?php
include "config.php";

$role     = $_POST['role'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$nama     = $_POST['nama'];
$email    = $_POST['email'];
$telepon  = $_POST['telepon'];
$jenis_kelamin = $_POST['jenis_kelamin'];

// ===============================
// CEK USERNAME DUPLIKAT
// ===============================
$checkUser = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($checkUser) > 0) {
    echo "<script>
            alert('Username sudah terdaftar! Silakan gunakan username lain.');
            window.location='../daftar.php';
          </script>";
    exit;
}

// ===============================
// REGISTER STAF
// ===============================
if ($role == "staf") {
    $nik     = $username; // Gunakan username sebagai NIK
    $jabatan = $_POST['jabatan'];
    $prodi   = $_POST['prodi_staf'];

    $query = mysqli_query($conn, "
        INSERT INTO users(username, password, role, nama, email, telepon, nik, jabatan, prodi, jenis_kelamin)
        VALUES('$username', '$password', '$role', '$nama', '$email', '$telepon', '$nik', '$jabatan', '$prodi', '$jenis_kelamin')
    ");
}

// ===============================
// REGISTER MAHASISWA
// ===============================
else if ($role == "mahasiswa") {
    $nim      = $username; // Gunakan username sebagai NIM
    $prodi    = $_POST['prodi_mahasiswa'];
    $kelas    = $_POST['kelas'];
    $angkatan = $_POST['angkatan'];

    $query = mysqli_query($conn, "
        INSERT INTO users(
            username, password, role, nama, email, telepon,
            nim, prodi, kelas, angkatan, jenis_kelamin
        ) VALUES(
            '$username', '$password', '$role', '$nama', '$email', '$telepon',
            '$nim', '$prodi', '$kelas', '$angkatan', '$jenis_kelamin'
        )
    ");
}

// ===============================
// CEK STATUS INSERT
// ===============================
if ($query) {
    echo "<script>
            alert('Akun berhasil dibuat!');
            window.location='../login.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal mendaftarkan akun: " . mysqli_error($conn) . "');
            window.location='../daftar.php';
          </script>";
}
?>