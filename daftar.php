<?php include "backend/config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun DISPOL</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/loading.css">
    <link rel="icon" type="image/png" href="image/dispol.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <form action="backend/register-process.php" method="POST">
        <div style="text-align: left; width: 100%; margin-bottom: 10px;">
            <a href="landing-page.php" style="text-decoration: none; color: #333; font-size: 1.5rem;" title="Kembali">
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>

        <img src="image/dispol.png" class="logo">
        <h2 style="text-align:center;">Buat Akun DISPOL</h2>

        <!-- Pilih Role -->
        <label for="role">Pilih Pengguna</label>
        <select name="role" id="role" class="jenis-user" required>
            <option value="">Pilih Jenis Pengguna</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="staf">Staf Akademik</option>
        </select>

        <!-- ============================================================
         FORM STAF
        ============================================================ -->
        <div id="formStaf" style="display:none">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" placeholder="Contoh: Staf Akademik">

            <label for="prodi_staf">Program Studi</label>
            <select name="prodi_staf" id="prodi_staf">
                <option value="">Pilih Program Studi</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Teknologi Rekayasa Perangkat Lunak">Teknologi Rekayasa Perangkat Lunak</option>
                <option value="Teknologi Geomatika">Teknologi Geomatika</option>
                <option value="Rekayasa Keamanan Siber">Rekayasa Keamanan Siber</option>
                <option value="Teknologi Rekayasa Multimedia">Teknologi Rekayasa Multimedia</option>
                <option value="Animasi">Animasi</option>
                <option value="Teknologi Permainan">Teknologi Permainan</option>
            </select>
        </div>

        <!-- ============================================================
         FORM MAHASISWA
        ============================================================ -->
        <div id="formMahasiswa" style="display:none">
            <label for="prodi_mahasiswa">Program Studi</label>
            <select name="prodi_mahasiswa" id="prodi_mahasiswa">
                <option value="">Pilih Program Studi</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Teknologi Rekayasa Perangkat Lunak">Teknologi Rekayasa Perangkat Lunak</option>
                <option value="Teknologi Geomatika">Teknologi Geomatika</option>
                <option value="Rekayasa Keamanan Siber">Rekayasa Keamanan Siber</option>
                <option value="Teknologi Rekayasa Multimedia">Teknologi Rekayasa Multimedia</option>
                <option value="Animasi">Animasi</option>
                <option value="Teknologi Permainan">Teknologi Permainan</option>
            </select>

            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas">
                <option value="">Pilih Kelas</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
            </select>

            <label for="angkatan">Angkatan</label>
            <input type="number" name="angkatan" placeholder="Contoh: 2025">
        </div>

        <!-- ============================================================
         FORM UTAMA
        ============================================================ -->
        <label for="nama">Nama Lengkap:</label>
        <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <div style="display: flex; gap: 20px; margin-bottom: 15px; margin-top: 5px;">
            <label style="display: flex; align-items: center; gap: 8px; font-weight: 500; cursor: pointer;">
                <input type="radio" name="jenis_kelamin" value="L" required style="width: auto; margin: 0;"> Laki-laki
            </label>
            <label style="display: flex; align-items: center; gap: 8px; font-weight: 500; cursor: pointer;">
                <input type="radio" name="jenis_kelamin" value="P" required style="width: auto; margin: 0;"> Perempuan
            </label>
        </div>

        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Masukkan email" required>

        <label for="telepon">No. Telepon:</label>
        <input type="text" name="telepon" placeholder="Masukkan nomor HP" required>

        <label for="username">NIK/NIM untuk Login:</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username akun" required>

        <label for="password">Kata Sandi:</label>
        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>

        <button type="submit">Daftar</button>

        <p class="lupa-sandi">
            Sudah punya akun? <a href="login.php">Masuk</a>
        </p>

    </form>

    <!-- ============================================================
     SCRIPT: TAMPILKAN FORM SESUAI ROLE
    ============================================================ -->
    <script>
    const role = document.getElementById("role");
    const formStaf = document.getElementById("formStaf");
    const formMahasiswa = document.getElementById("formMahasiswa");

    role.addEventListener("change", function() {
        if (this.value === "staf") {
            formStaf.style.display = "block";
            formMahasiswa.style.display = "none";

            // Set required untuk form staf
            document.querySelector('[name="jabatan"]').required = true;
            document.querySelector('[name="prodi_staf"]').required = true;

            // Remove required dari form mahasiswa
            document.querySelector('[name="prodi_mahasiswa"]').required = false;
            document.querySelector('[name="kelas"]').required = false;
            document.querySelector('[name="angkatan"]').required = false;

        } else if (this.value === "mahasiswa") {
            formStaf.style.display = "none";
            formMahasiswa.style.display = "block";

            // Set required untuk form mahasiswa
            document.querySelector('[name="prodi_mahasiswa"]').required = true;
            document.querySelector('[name="kelas"]').required = true;
            document.querySelector('[name="angkatan"]').required = true;

            // Remove required dari form staf
            document.querySelector('[name="jabatan"]').required = false;
            document.querySelector('[name="prodi_staf"]').required = false;

        } else {
            formStaf.style.display = "none";
            formMahasiswa.style.display = "none";
        }
    });
    </script>

    <script src="js/loading.js"></script>
</body>

</html>