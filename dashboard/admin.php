<?php
session_start();
include '../config/db.php';

// Validasi role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Ambil informasi akun
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Ambil data anggaran dari database
$query = $conn->query("SELECT * FROM anggaran");
$anggaran = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Header Info Akun dan Logout -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <strong>Logged in as:</strong> <?= htmlspecialchars($username); ?> 
                (<em><?= htmlspecialchars($role); ?></em>)
            </div>
            <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>

        <!-- Judul Dashboard -->
        <h1 class="text-center">Admin Dashboard</h1>

        <!-- Tabel Anggaran -->
        <div class="d-flex justify-content-between mb-3">
            <h2>Data Anggaran</h2>
            <a href="add_anggaran.php" class="btn btn-primary">Tambah Anggaran</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Jumlah Anggaran</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anggaran as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= htmlspecialchars($row['nama_kegiatan']); ?></td>
                        <td>Rp <?= number_format($row['jumlah_anggaran'], 2, ',', '.'); ?></td>
                        <td><?= $row['tanggal']; ?></td>
                        <td>
                            <a href="edit_anggaran.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_anggaran.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
