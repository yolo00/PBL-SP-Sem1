<?php
include "config.php";

// Ambil NIM dari input form
$nim = $_POST['nim'];

// ===============================
// CEK APAKAH NIM TERDAFTAR DI USERS
// ===============================
$cekMhs = mysqli_query($conn, "SELECT * FROM users WHERE nim='$nim' AND role='mahasiswa'");

if (mysqli_num_rows($cekMhs) == 0) {
    echo "<script>
            alert('Mahasiswa dengan NIM tersebut tidak ditemukan!');
            history.back();
          </script>";
    exit;
}

$mhs = mysqli_fetch_assoc($cekMhs);

// Ambil data mahasiswa dari DB (AUTO)
$nama     = $mhs['nama'];
$jurusan  = $mhs['jurusan'];
$prodi    = $mhs['prodi'];
$kelas    = $mhs['kelas'];
$angkatan = $mhs['angkatan']; // kalau nanti mau dipakai

// Ambil data SP dari form
$tingkat     = $_POST['tingkat'];
$tanggal     = $_POST['tanggal'];
$sampai      = $_POST['sampai'];
$perihal     = $_POST['perihal'];
$deskripsi   = $_POST['deskripsi'];
$semester    = $_POST['semester'];
$sesi_kelas  = $_POST['sesi_kelas'];

// ===============================
// HANDLE UPLOAD FILE
// ===============================
$fileName = null;

if (!empty($_FILES['file']['name'])) {

    // Pastikan folder upload tersedia
    if (!is_dir("../uploads")) {
        mkdir("../uploads");
    }

    $fileName = time() . "_" . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/" . $fileName);
}

// ===============================
// INSERT KE TABEL SURAT PERINGATAN
// ===============================
$query = mysqli_query($conn, "
    INSERT INTO surat_peringatan(
        nama, nim, jurusan, prodi, kelas,
        tingkat, tanggal, sampai, perihal, deskripsi, file, semester, sesi_kelas
    ) VALUES(
        '$nama', '$nim', '$jurusan', '$prodi', '$kelas',
        '$tingkat', '$tanggal', '$sampai', '$perihal', '$deskripsi', '$fileName', '$semester', '$sesi_kelas'
    )
");

if (!$query) {
    die('Query Error: ' . mysqli_error($conn));
}

// ===============================
// SUKSES
// ===============================
echo "<script>
        alert('Surat berhasil ditambahkan!');
        window.location='../kelola-staf.php';
      </script>";
?>
