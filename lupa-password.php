<?php include "backend/config.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi | DISPOL</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <form action="backend/otp-request.php" method="POST">
        <div style="text-align: left; width: 100%; margin-bottom: 10px;">
            <a href="login.php" style="text-decoration: none; color: #333; font-size: 1.5rem;" title="Kembali">
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>

        <img src="image/dispol.png" class="logo" alt="Logo DISPOL">
        <h2 style="text-align: center;">Atur Ulang Kata Sandi</h2>
        <p style="text-align: center; font-size: 14px; margin-bottom: 20px; color: #555;">
            Masukkan email yang terdaftar pada akun Anda. Kami akan mengirimkan kode verifikasi (OTP).
        </p>

        <label for="email">Email Terdaftar:</label>
        <input type="email" id="email" name="email" placeholder="contoh@email.com" required>

        <button type="submit">Kirim Kode OTP</button>
    </form>

</body>
</html>
