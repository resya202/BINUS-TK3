<?php
session_start();
include '../config/db.php';

// Validasi role masyarakat
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'masyarakat') {
    header('Location: ../login.php');
    exit;
}

// Ambil detail laporan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM laporan WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "Laporan tidak ditemukan!";
        exit;
    }
} else {
    header('Location: masyarakat.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Detail Laporan</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Deskripsi</h5>
                <p><?= htmlspecialchars($data['deskripsi']); ?></p>
                <h5 class="card-title">Status</h5>
                <p><?= ucfirst($data['status']); ?></p>
                <h5 class="card-title">Tanggal Laporan</h5>
                <p><?= $data['tanggal_laporan']; ?></p>
                <a href="masyarakat.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
