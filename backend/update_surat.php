<?php
include "config.php";

$id         = $_POST['id'];
$nama       = $_POST['nama'];
$nim        = $_POST['nim'];
$jurusan    = $_POST['jurusan'];
$prodi      = $_POST['prodi'];
$kelas      = $_POST['kelas'];
$tingkat    = $_POST['tingkat'];
$tanggal    = $_POST['tanggal'];
$sampai     = $_POST['sampai'];
$status     = $_POST['status'];
$perihal    = $_POST['perihal'];
$deskripsi  = $_POST['deskripsi'];
$semester   = $_POST['semester'];
$sesi_kelas = $_POST['sesi_kelas'];

// Cek apakah ada file baru di-upload
$newFileName = null;

if (!empty($_FILES['file']['name'])) {

    if (!is_dir("../uploads")) {
        mkdir("../uploads");
    }

    $newFileName = time() . "_" . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/" . $newFileName);

    $updateQuery = "
        UPDATE surat_peringatan SET
        nama='$nama',
        nim='$nim',
        jurusan='$jurusan',
        prodi='$prodi',
        kelas='$kelas',
        tingkat='$tingkat',
        tanggal='$tanggal',
        sampai='$sampai',
        perihal='$perihal',
        deskripsi='$deskripsi',
        file='$newFileName',
        status='$status',
        semester='$semester',
        sesi_kelas='$sesi_kelas'
        WHERE id='$id'
    ";
} 
else {

    // Jika file TIDAK diganti
    $updateQuery = "
        UPDATE surat_peringatan SET
        nama='$nama',
        nim='$nim',
        jurusan='$jurusan',
        prodi='$prodi',
        kelas='$kelas',
        tingkat='$tingkat',
        tanggal='$tanggal',
        sampai='$sampai',
        status='$status',
        perihal='$perihal',
        deskripsi='$deskripsi',
        semester='$semester',
        sesi_kelas='$sesi_kelas'
        WHERE id='$id'
    ";
}

// Eksekusi
$result = mysqli_query($conn, $updateQuery);

// Cek kalau gagal
if(!$result){
    die("Query Error: " . mysqli_error($conn));
}

echo "<script>alert('Surat berhasil diperbarui!'); window.location='../kelola-staf.php';</script>";
?>
