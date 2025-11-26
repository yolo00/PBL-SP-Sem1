<!--Dibuat oleh Michael Sando Turnip ril-->

<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$configPath = __DIR__ . '/config.php';
if (!file_exists($configPath)) {
    http_response_code(500);
    echo json_encode(['error' => "Config file not found: $configPath"]);
    exit;
}
require_once $configPath;

if (!isset($_SESSION['nim'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Tidak terautentikasi']);
    exit;
}
$nim = $_SESSION['nim'];

// Ambil juga deskripsi dan sampai
$sql = "SELECT id, perihal, deskripsi, sampai, tanggal, status, file
        FROM surat_peringatan
        WHERE nim = ?
        ORDER BY tanggal DESC";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
    exit;
}
$stmt->bind_param("s", $nim);
if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(['error' => 'Execute failed: ' . $stmt->error]);
    $stmt->close();
    exit;
}

$data = [];
if (method_exists($stmt, 'get_result')) {
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        // Deteksi tingkat SP: cari "SP I", "SP II", "SP III", atau angka romawi/arab
        $combined = ($row['perihal'] ?? '') . ' ' . ($row['deskripsi'] ?? '');
        $tingkat = null;
        if (preg_match('/\bSP[\s\-]*I{1,3}\b/i', $combined, $m)) {
            $tingkat = strtoupper($m[0]); // "SP I" atau "SP II"
        } elseif (preg_match('/\bSP[\s\-]*[1-3]\b/i', $combined, $m)) {
            $tingkat = strtoupper($m[0]);
        }

        // fallback: jika tidak terdeteksi, pakai kolom 'sampai' (mungkin tanggal)
        if (!$tingkat) {
            $sampai = $row['sampai'] ?? null;
            if ($sampai) {
                // coba format tanggal jika berbentuk YYYY-MM-DD
                $dt = date_create($sampai);
                $tingkat = $dt ? date_format($dt, 'Y-m-d') : $sampai;
            } else {
                $tingkat = '-';
            }
        }

        $data[] = [
            'id'      => $row['id'],
            'perihal' => $row['perihal'],
            'tingkat' => $tingkat,
            'tanggal' => $row['tanggal'],
            'status'  => $row['status'],
            'file'    => '/backend/download_sp.php?id=' . urlencode($row['id'])
        ];
    }
} else {
    // fallback bind_result
    $stmt->bind_result($id, $perihal, $deskripsi, $sampai, $tanggal, $status, $fileCol);
    while ($stmt->fetch()) {
        $combined = ($perihal ?? '') . ' ' . ($deskripsi ?? '');
        $tingkat = null;
        if (preg_match('/\bSP[\s\-]*I{1,3}\b/i', $combined, $m)) {
            $tingkat = strtoupper($m[0]);
        } elseif (preg_match('/\bSP[\s\-]*[1-3]\b/i', $combined, $m)) {
            $tingkat = strtoupper($m[0]);
        }
        if (!$tingkat) {
            if ($sampai) {
                $dt = date_create($sampai);
                $tingkat = $dt ? date_format($dt, 'Y-m-d') : $sampai;
            } else {
                $tingkat = '-';
            }
        }

        $data[] = [
            'id'      => $id,
            'perihal' => $perihal,
            'tingkat' => $tingkat,
            'tanggal' => $tanggal,
            'status'  => $status,
            'file'    => '/backend/download_sp.php?id=' . urlencode($id)
        ];
    }
}

$stmt->close();
echo json_encode($data);
?>