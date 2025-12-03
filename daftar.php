<?php include "backend/config.php"; ?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun DISPOL</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<form action="backend/register-process.php" method="POST">

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
    
    <label for="id">ID Staf (boleh dikosongkan)</label>
    <input type="number" name="id" placeholder="Masukkan ID staf">

    <label for="nik">NIK Staf</label>
    <input type="text" name="nik" placeholder="Masukkan NIK Staf">

    <label for="jabatan">Jabatan</label>
    <input type="text" name="jabatan" placeholder="Contoh: Staf Akademik">

    <label for="prodi">Program Studi</label>
    <input type="text" name="prodi" placeholder="Masukkan prodi">
</div>

<!-- ============================================================
     FORM MAHASISWA
============================================================ -->
<div id="formMahasiswa" style="display:none">
    <label for="nim">NIM</label>
    <input type="text" name="nim" placeholder="Masukkan NIM">

    <label for="jurusan">Jurusan</label>
    <input type="text" name="jurusan" placeholder="Masukkan jurusan">

    <label for="prodi">Program Studi</label>
    <input type="text" name="prodi" placeholder="Masukkan prodi">

    <label for="kelas">Kelas</label>
    <input type="text" name="kelas" placeholder="Masukkan kelas">

    <label for="angkatan">Angkatan</label>
    <input type="number" name="angkatan" placeholder="Contoh: 2025">
</div>


<!-- ============================================================
     FORM UTAMA
============================================================ -->
<label for="nama">Nama Lengkap:</label>
<input type="text" name="nama" placeholder="Masukkan nama lengkap" required>

<label for="email">Email:</label>
<input type="email" name="email" placeholder="Masukkan email">

<label for="telepon">No. Telepon:</label>
<input type="text" name="telepon" placeholder="Masukkan nomor HP">


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

role.addEventListener("change", function(){
    if(this.value === "staf"){
        formStaf.style.display = "block";
        formMahasiswa.style.display = "none";
    } else if(this.value === "mahasiswa"){
        formStaf.style.display = "none";
        formMahasiswa.style.display = "block";
    } else {
        formStaf.style.display = "none";
        formMahasiswa.style.display = "none";
    }
});
</script>

</body>
</html>
