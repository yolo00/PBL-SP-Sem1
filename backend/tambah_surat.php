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
// VALIDASI NIM TERDAFTAR SEBAGAI MAHASISWA
// ===============================
$check = mysqli_query($conn, "SELECT * FROM users WHERE nim = '$nim' AND role = 'mahasiswa' LIMIT 1");
if (!$check || mysqli_num_rows($check) == 0) {
    echo "<script>
            alert('Gagal: NIM tidak terdaftar sebagai akun mahasiswa.');
            window.location='../tambah-surat.php';
          </script>";
    exit;
}

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
    $baseName = pathinfo($originalName, PATHINFO_FILENAME);
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
    // Sanitize filename: remove special characters, keep original name
    $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $baseName);
    $cleanName = time() . "_" . $safeName . "." . $ext; // Timestamp + original filename
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/" . $cleanName)) {
        $fileName = mysqli_real_escape_string($conn, $cleanName);
    }
}

// ===============================
// INSERT KE TABEL SURAT PERINGATAN
// ===============================
// Kita gunakan data dari form langsung agar sesuai inputan staf
// Default status kita set 'aktif' agar muncul di kelola-staf
// Insert data termasuk semester dan sesi_kelas
$query = mysqli_query($conn, "
    INSERT INTO surat_peringatan(
        nama, nim, jurusan, prodi, kelas, semester, sesi_kelas,
        tingkat, tanggal, sampai, perihal, deskripsi, file, status
    ) VALUES(
        '$nama', '$nim', '$jurusan', '$prodi', '$kelas', '$semester', '$sesi_kelas',
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
