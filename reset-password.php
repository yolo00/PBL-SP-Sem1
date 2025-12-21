<?php session_start(); ?>
<?php if(empty($_SESSION['reset_token'])) { header("Location: login.php"); exit; } ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kata Sandi Baru | DISPOL</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/png" href="image/dispol.png">
</head>
<body>

    <form action="backend/reset-password-process.php" method="POST">
        <img src="image/dispol.png" class="logo" alt="Logo DISPOL">
        <h2 style="text-align: center;">Buat Kata Sandi Baru</h2>
        
        <label for="password">Kata Sandi Baru:</label>
        <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>

        <label for="password_confirm">Konfirmasi Kata Sandi:</label>
        <input type="password" id="password_confirm" name="password_confirm" placeholder="Ulangi kata sandi" required>

        <button type="submit">Simpan Kata Sandi</button>
    </form>

</body>
</html>
