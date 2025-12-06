<?php
include "config.php";

$role     = $_POST['role'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$nama     = $_POST['nama'];
$email    = $_POST['email'];
$telepon  = $_POST['telepon'];
$prodi = $_POST['prodi'];

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

    $nik     = $_POST['nik'];
    $jabatan = $_POST['jabatan'];
    $prodi = $_POST['prodi'];

$query = mysqli_query($conn, "
    INSERT INTO users(username, password, role, nama, email, telepon, nik, prodi, jabatan)
    VALUES('$username', '$password', '$role', '$nama', '$email', '$telepon', '$nik', '$prodi', '$jabatan')
");

}


// ===============================
// REGISTER MAHASISWA
// ===============================
else if ($role == "mahasiswa") {

    $nim      = $_POST['nim'];
    $jurusan  = $_POST['jurusan'];
    $prodi    = $_POST['prodi'];
    $kelas    = $_POST['kelas'];
    $angkatan = $_POST['angkatan'];

    $query = mysqli_query($conn, "
        INSERT INTO users(
            username, password, role, nama, email, telepon,
            nim, jurusan, prodi, kelas, angkatan
        ) VALUES(
            '$username', '$password', '$role', '$nama', '$email', '$telepon',
            '$nim', '$jurusan', '$prodi', '$kelas', '$angkatan'
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
            alert('Gagal mendaftarkan akun!');
            window.location='../daftar.php';
          </script>";
}
?>
