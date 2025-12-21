<?php session_start(); ?>
<?php if(empty($_SESSION['reset_email'])) { header("Location: lupa-password.php"); exit; } ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode verifikasi | DISPOL</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <form action="backend/otp-verify.php" method="POST">
        <div style="text-align: left; width: 100%; margin-bottom: 10px;">
            <a href="lupa-password.php" style="text-decoration: none; color: #333; font-size: 1.5rem;" title="Kembali">
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>

        <img src="image/dispol.png" class="logo" alt="Logo DISPOL">
        <h2 style="text-align: center;">Verifikasi Kode OTP</h2>
        <p style="text-align: center; font-size: 14px; margin-bottom: 20px; color: #555;">
            Masukkan 6 digit kode yang telah dikirim ke email <b><?= htmlspecialchars($_SESSION['reset_email']); ?></b>
        </p>

        <label for="otp">Kode OTP:</label>
        <input type="number" id="otp" name="otp" placeholder="123456" required style="letter-spacing: 5px; text-align: center; font-size: 1.2rem;">

        <button type="submit">Verifikasi</button>
    </form>

</body>
</html>
