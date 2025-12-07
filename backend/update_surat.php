<?php
include "config.php";

$id         = mysqli_real_escape_string($conn, $_POST['id']);
$nama       = mysqli_real_escape_string($conn, $_POST['nama']);
$nim        = mysqli_real_escape_string($conn, $_POST['nim']);
$jurusan    = mysqli_real_escape_string($conn, $_POST['jurusan']);
$prodi      = mysqli_real_escape_string($conn, $_POST['prodi']);
$kelas      = mysqli_real_escape_string($conn, $_POST['kelas']);
$tingkat    = mysqli_real_escape_string($conn, $_POST['tingkat']);
$tanggal    = mysqli_real_escape_string($conn, $_POST['tanggal']);
$sampai     = mysqli_real_escape_string($conn, $_POST['sampai']);
$status     = mysqli_real_escape_string($conn, $_POST['status']);
$perihal    = mysqli_real_escape_string($conn, $_POST['perihal']);
$deskripsi  = mysqli_real_escape_string($conn, $_POST['deskripsi']);
$semester   = mysqli_real_escape_string($conn, $_POST['semester']);
$sesi_kelas = mysqli_real_escape_string($conn, $_POST['sesi_kelas']);

// Cek apakah ada file baru di-upload
$newFileName = null;
$updateFileQueryPart = "";

if (!empty($_FILES['file']['name'])) {

    if (!is_dir("../uploads")) {
        mkdir("../uploads");
    }

    $originalName = $_FILES['file']['name'];
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
    $cleanName = time() . "_" . uniqid() . "." . $ext;

    if (move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/" . $cleanName)) {
        $newFileName = mysqli_real_escape_string($conn, $cleanName);
        $updateFileQueryPart = ", file='$newFileName'";
    }
} 

$updateQuery = "
    UPDATE surat_peringatan SET
    nama='$nama',
    nim='$nim',
    jurusan='$jurusan',
    prodi='$prodi',
    kelas='$kelas',
    semester='$semester',
    sesi_kelas='$sesi_kelas',
    tingkat='$tingkat',
    tanggal='$tanggal',
    sampai='$sampai',
    perihal='$perihal',
    deskripsi='$deskripsi',
    status='$status'
    $updateFileQueryPart
    WHERE id='$id'
";

// Eksekusi
$result = mysqli_query($conn, $updateQuery);

// Cek kalau gagal
if(!$result){
    die("Query Error: " . mysqli_error($conn));
}

echo "<script>alert('Surat berhasil diperbarui!'); window.location='../kelola-staf.php';</script>";
?>
