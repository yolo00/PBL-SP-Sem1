<?php
// Cek jika session mati tapi ada cookie untuk restore
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id']) && isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id_cookie = $_COOKIE['id'];
    $key_cookie = $_COOKIE['key'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id_cookie'");
    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        // Verifikasi hash
        if ($key_cookie === hash('sha256', $row['username'])) {
            // Restore Session
            $_SESSION['user_id']  = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama']     = $row['nama'];
            $_SESSION['role']     = $row['role'];
            $_SESSION['email']    = $row['email'];
            $_SESSION['telepon']  = $row['telepon'];
            $_SESSION['jurusan']  = $row['jurusan'];
            $_SESSION['prodi']    = $row['prodi'];
            $_SESSION['kelas']    = $row['kelas'];
            $_SESSION['angkatan'] = $row['angkatan'];
            $_SESSION['nim']      = $row['nim'];
            $_SESSION['nik']      = $row['nik'];
            $_SESSION['jabatan']  = $row['jabatan'];
            $_SESSION['jenis_kelamin'] = $row['jenis_kelamin'];
        }
    }
}
?>