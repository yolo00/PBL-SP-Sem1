<?php
// Cek jika session mati tapi ada cookie untuk restore
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    // 1. Ambil cookie form: id:token
    $cookie_data = explode(':', $_COOKIE['remember_me']);
    
    if (count($cookie_data) === 2) {
        $id_cookie = mysqli_real_escape_string($conn, $cookie_data[0]);
        $token_cookie = mysqli_real_escape_string($conn, $cookie_data[1]);

        // 2. Cari user dengan ID dan Token tersebut yang belum expired
        $now = date('Y-m-d H:i:s');
        $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id_cookie' AND remember_token = '$token_cookie' AND token_expiry > '$now'");
        
        if ($query && mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            // 3. Restore Session jika valid
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