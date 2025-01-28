<?php
session_start();
include '../config/db.php';

// Validasi role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $jumlah_anggaran = $_POST['jumlah_anggaran'];
    $tanggal = $_POST['tanggal'];

    $stmt = $conn->prepare("INSERT INTO anggaran (nama_kegiatan, jumlah_anggaran, tanggal) VALUES (:nama_kegiatan, :jumlah_anggaran, :tanggal)");
    $stmt->bindParam(':nama_kegiatan', $nama_kegiatan);
    $stmt->bindParam(':jumlah_anggaran', $jumlah_anggaran);
    $stmt->bindParam(':tanggal', $tanggal);

    if ($stmt->execute()) {
        header('Location: admin.php');
    } else {
        echo "Gagal menambah data anggaran.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Anggaran</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_anggaran" class="form-label">Jumlah Anggaran</label>
                <input type="number" name="jumlah_anggaran" id="jumlah_anggaran" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="admin.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
