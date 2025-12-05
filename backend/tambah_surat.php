<?php
include "config.php";

// Ambil data dari form dan amankan dari SQL Injection
$nim        = mysqli_real_escape_string($conn, $_POST['nim']);
$nama       = mysqli_real_escape_string($conn, $_POST['nama']);
$jurusan    = mysqli_real_escape_string($conn, $_POST['jurusan']);
$prodi      = mysqli_real_escape_string($conn, $_POST['prodi']);
$kelas      = mysqli_real_escape_string($conn, $_POST['kelas']);
$semester   = mysqli_real_escape_string($conn, $_POST['semester']);
$sesi_kelas = mysqli_real_escape_string($conn, $_POST['sesi_kelas']);

$tingkat    = mysqli_real_escape_string($conn, $_POST['tingkat']);
$tanggal    = mysqli_real_escape_string($conn, $_POST['tanggal']);
$sampai     = mysqli_real_escape_string($conn, $_POST['sampai']);
$perihal    = mysqli_real_escape_string($conn, $_POST['perihal']);
$deskripsi  = mysqli_real_escape_string($conn, $_POST['deskripsi']);

// ===============================
// HANDLE UPLOAD FILE
// ===============================
$fileName = null;

if (!empty($_FILES['file']['name'])) {
    // Pastikan folder upload tersedia
    if (!is_dir("../uploads")) {
        mkdir("../uploads");
    }

    $originalName = $_FILES['file']['name'];
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
    $cleanName = time() . "_" . uniqid() . "." . $ext; // Generate unique safe filename
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/" . $cleanName)) {
        $fileName = mysqli_real_escape_string($conn, $cleanName);
    }
}

// ===============================
// INSERT KE TABEL SURAT PERINGATAN
// ===============================
// Kita gunakan data dari form langsung agar sesuai inputan staf
// Default status kita set 'aktif' agar muncul di kelola-staf
// NOTE: Kolom 'semester' dan 'sesi_kelas' dihapus sementara karena belum ada di database.
// Silakan jalankan SETUP_DATABASE.sql jika ingin mengaktifkan fitur tersebut.
$query = mysqli_query($conn, "
    INSERT INTO surat_peringatan(
        nama, nim, jurusan, prodi, kelas,
        tingkat, tanggal, sampai, perihal, deskripsi, file, status
    ) VALUES(
        '$nama', '$nim', '$jurusan', '$prodi', '$kelas',
        '$tingkat', '$tanggal', '$sampai', '$perihal', '$deskripsi', '$fileName', 'aktif'
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
