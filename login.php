<?php include "backend/config.php"; ?>
<!--Muhammad Ivan Febrian-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login DISPOL</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <form action="backend/login-process.php" method="POST">
        <div style="text-align: left; width: 100%; margin-bottom: 10px;">
            <a href="javascript:history.back()" style="text-decoration: none; color: #333; font-size: 1.5rem;"
                title="Kembali">
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>

        <img src="image/dispol.png" class="logo">
        <h2 style="text-align: center;">Digitalisasi Surat Peringatan Mahasiswa Polibatam</h2>
        <label for="role">Pilih Pengguna</label>
        <select id="role" name="role" class="jenis-user" required>
            <option value="">Pilih Jenis Pengguna</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="staf">Staf Akademik</option>
        </select>
        <label for="username">NIK/NIM:</label>
        <input type="text" id="username" name="username" placeholder="Masukkan NIK/NIM anda" required>
        <label for="password">Kata Sandi:</label>
        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
        <div class="remember-forgot">
            <label class="remember-me">
                <input type="checkbox" name="remember"> Ingat Saya
            </label>
        </div>

        <button type="submit" id="loginBtn">Masuk</button>
        <p class="account-check">Belum punya akun? <a href="daftar.php">Daftar</a></p>
    </form>

    <script src="js/loading.js"></script>

</body>

</html>