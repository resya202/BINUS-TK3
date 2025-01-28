<?php
session_start();
include '../config/db.php';

// Validasi role petugas
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    header('Location: ../login.php');
    exit;
}

// Ambil informasi akun
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Ambil data laporan dengan join ke tabel pengguna (users) dan anggaran
$query = $conn->query("
    SELECT laporan.id, laporan.deskripsi, laporan.status, laporan.tanggal_laporan, 
           users.username AS masyarakat_nama, anggaran.nama_kegiatan AS anggaran_nama
    FROM laporan
    JOIN users ON laporan.masyarakat_id = users.id
    JOIN anggaran ON laporan.anggaran_id = anggaran.id
    ORDER BY laporan.tanggal_laporan DESC
");
$laporan = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas</title>
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
        <h1 class="text-center">Dashboard Petugas</h1>

        <!-- Daftar Laporan -->
        <div class="my-4">
            <h2>Daftar Laporan Masyarakat</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Masyarakat</th>
                        <th>Anggaran Terkait</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporan as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($row['masyarakat_nama']); ?></td>
                            <td><?= htmlspecialchars($row['anggaran_nama']); ?></td>
                            <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                            <td><?= ucfirst($row['status']); ?></td>
                            <td><?= $row['tanggal_laporan']; ?></td>
                            <td>
                                <?php if ($row['status'] === 'pending'): ?>
                                    <a href="proses_laporan.php?id=<?= $row['id']; ?>&status=diterima" class="btn btn-success btn-sm">Terima</a>
                                    <a href="proses_laporan.php?id=<?= $row['id']; ?>&status=ditolak" class="btn btn-danger btn-sm">Tolak</a>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Diproses</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
